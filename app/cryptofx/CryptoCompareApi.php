<?php
namespace cryptofx;
class CryptoCompareApi{
    public function toArray(){
        return json_decode($this->response,true);
    }
    public function toObject(){
        return json_decode($this->response);
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
