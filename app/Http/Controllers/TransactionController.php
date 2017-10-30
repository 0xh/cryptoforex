<?php

namespace App\Http\Controllers;

use DB;
use Log;
use App\Transaction;
use App\Withdrawal;
use App\Merchant;
use App\Deal;
use App\User;
use App\Account;
use App\Currency;
use App\Price;
use cryptofx\DataArray;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $rq, $format='json',$id=false){
        $res = Transaction::with(['account'=>function($query){return $query->with(['user','currency']);},'merchant','manager'])
            ->byId($id)
            ->byType($rq->input('type',false));
        return response()->json($res->paginate(12),200,['Content-Type' => 'application/json; charset=utf-8'],JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT);


        $selector = ($id===false)?Transaction::whereNotNull('id'):Transaction::where('id','=',$id);
        if($rq->input('type',false)!==false)$selector = $selector->where('type','=',$rq->input('type'));
        // filters {
        // }
        foreach($selector->get() as $row){
            $r = $row->toArray();
            $r['merchant'] = Merchant::find($row->merchant_id);unset($r['merchant_id']);
            $r['manager'] = User::find($row->user_id);unset($r['user_id']);
            $acc = Account::find($row->account_id);
            $r["user"] = User::find($acc->user_id);
            $r["currency"] = Currency::find($acc->currency_id);unset($r['account_id']);
            $res[] = $r;
        }
        return response()->json($res,200,['Content-Type' => 'application/json; charset=utf-8'],JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function merchants(Request $rq,$format='json'){
        return response()->json(Merchant::all(),200,['Content-Type' => 'application/json; charset=utf-8'],JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function makeTransaction($args=false){
        try{
            list($res,$amount)=[["error"=>"404","message"=>"Deposit failed."],abs(floatval($args['amount']))];
            $account = Account::findOrFail($args['account']);
            $merchant = Merchant::findOrFail($args['merchant']);
            $type = $args['type'];
            $trx = Transaction::create([
                'type'=>$type,
                'user_id'=>$args["user"]->id,
                'account_id'=>$account->id,
                'amount'=>$amount,
                'merchant_id'=>$merchant->id,
                'code'=>'200'
            ]);
            $account->amount=(in_array($type,['deposit','debit']))?$account->amount+$amount:$account->amount-$amount;
            if($account->amount<0)throw new \Exception('Not enaugh balance',1);
            $account->save();
            $res = $trx;
        }
        catch(\Exception $e){
            $res = json_decode(json_encode([
                "error"=>$e->getCode(),
                'code'=>'500',
                "message"=>$e->getMessage()
            ]));
            // $trx->update(['code'=>$code]);
        }
        return $res;
    }
    public function deposit(Request $rq,$format='json'){
        $res = $this->makeTransaction([
            'type'=>'debit',
            'user' => $rq->user(),
            'merchant'=>$rq->input('merchant_id'),
            'account'=>$rq->input('account_id'),
            'amount'=>$rq->input('amount'),
        ]);
        return response()->json($res,$res['code'],['Content-Type' => 'application/json; charset=utf-8'],JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT);
    }
    public function withdrawal(Request $rq,$format='json',$id=false){
        $res = Withdrawal::with(['account'=>function($query){return $query->with(['user','currency']);},'merchant','manager'])
            ->byId($id)
            ->byStatus($rq->input('status',false));
        return response()->json($res->paginate(12),200,['Content-Type' => 'application/json; charset=utf-8'],JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT);
    }
    public function balance(Request $rq,$format='json'){
        $res = User::with(['manager',
                'account'=>function($query){
                    return $query->with('currency')->where('type','demo');
                }
            ]);//->addSelect(DB::raw("(select sum(amount) as deal from deals where user_id=users.id)"));
        // if(false!==$rq->input('sort',false)){
        //     foreach($rq->input('sort') as $sort=>$asc) $res= $res->orderBy($sort,$asc);
        // }
        return response()->json($res->paginate(12),200,['Content-Type' => 'application/json; charset=utf-8'],JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT);
        $res = [];
        $users= User::with(['manager'])->get();
        foreach($users as $user){
            $row = $user->toArray();
            $acc = Account::where('user_id','=',$user->id)->where('type','=','demo')->first();
            $row['currency'] = ($acc!=false && !is_null($acc))?Currency::find($acc->currency_id):['code'=>'USD'];
            $row['deal'] = Deal::where('user_id','=',$user->id)->sum('amount');
            $row['profit'] = Deal::where('user_id','=',$user->id)->sum('profit');
            $row['balance'] = Account::where('user_id','=',$user->id)->where('type','=','demo')->sum('amount');
            $res[]=$row;
        }
        $res = DataArray::sort($res,$rq->input('sort',false));
        return response()->json($res,200,['Content-Type' => 'application/json; charset=utf-8'],JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT);
    }
}
