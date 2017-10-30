<?php
namespace cryptofx;
class CryptoCompareApi{
    public function toArray(){
        return json_decode($this->response,true);
    }
    public function toObject(){
        return json_decode($this->response);
    }
    public function prices($pairs,callable $f){
        //if(!is_array($urls))$urls = [$urls];
        $response=[];
        $curls = [];
        $mh = curl_multi_init();
        foreach($pairs as $id=>$pair){
            $curls[$id] = curl_init();
            $rq = $this->url."price?".http_build_query(array_merge($this->defaults["price"],$pair));
            $curlOptions = [
                CURLOPT_SSL_VERIFYPEER=>false,
                CURLOPT_HEADER=>false,
                CURLOPT_FOLLOWLOCATION=>true,
                CURLOPT_URL=> $rq,
                CURLOPT_REFERER=> $rq,
                CURLOPT_RETURNTRANSFER=>true
            ];
            curl_setopt_array($curls[$id], $curlOptions);
            curl_multi_add_handle($mh,$curls[$id]);
        }
        do{
            curl_multi_exec($mh, $running);
            curl_multi_select($mh);
        } while ($running > 0);
        foreach($curls as $id=>$curl){
            $calldata = [
                "id"=>$id,
                "request"=>$pairs[$id],
                "response" => curl_multi_getcontent($curl),
                "http_info" => curl_getinfo($curl)
            ];
            $f($calldata);
            curl_multi_remove_handle($mh, $curl);
        }
        curl_multi_close($mh);
        return $response;
    }
    public function __call($f,$args){
        return $this->_call($f,isset($args[0])?$args[0]:[]);
    }
    protected $url='https://min-api.cryptocompare.com/data/';
    protected $request = "";
    protected $response = [];
    protected function _call($f,$args){
        $this->request = $this->url.$f."?".http_build_query(array_merge($this->defaults[$f],$args));
        $this->response = $this->_fetch();
        return $this->toObject();
    }
    protected function _fetch() {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_URL, $this->request);
        curl_setopt($ch, CURLOPT_REFERER, $this->request);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
    }
    protected $defaults = [
        "histominute"=>[
            "fsym" => "BTC",
            "tsym" => "BCH",
            "limit" => 2000,
            "aggregate" => 1,
            "e" => "CCCAGG"
        ],
        "price"=>[
            "fsym" => "BTC",
            "tsyms" => "BCH"
        ]
    ];
};
?>
