<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\UserStatus;
use App\UserRights;
use App\UserMeta;
use App\Account;
use App\Currency;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'phone' => 'required|string|max:16|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data){
        if(!isset($data['rights_id']))$data['rights_id']=UserRights::where('name','=','client')->first()->id;
        if(!isset($data['status_id']))$data['status_id']=UserStatus::where('code','=','newclient')->first()->id;
        $country = (isset($data['country']))?$data['country']:false;

        $data['password'] = bcrypt($data['password']);
        $user = User::create($data);
        $currency = Currency::where('code','USD')->first();
        $accountDemo = Account::create([
            'status'=>'open',
            'currency_id'=>$currency->id,
            'user_id'=>$user->id,
            'amount'=>'10000',
            'type'=>'demo'
        ]);
        $account = Account::create([
            'status'=>'open',
            'currency_id'=>$currency->id,
            'user_id'=>$user->id,
            'amount'=>'0',
            'type'=>'real'
        ]);
        if($country!==false){
            UserMeta::create([
                'meta_name'=>'country',
                'meta_value'=>$country,
                'user_id'=>$user->id
            ]);
        }
        return $user;
    }
}
