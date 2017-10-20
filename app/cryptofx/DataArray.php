<?php
namespace cryptofx;
use Log;
class DataArray{
    public static function sort($res,$sort){
        if($sort===false || count($res)==0)return $res;

        foreach($sort as $k=>$v){
            if(!isset($res[0][$k]))continue;
            usort($res,function($a,$b)use($k,$v){
                $ret = ($v=="desc")?false:true;
                // Log::debug($v." ".$a[$k]." > ".$b[$k]." = ".(($a[$k] > $b[$k])?$ret:(-$ret)));
                return ($a[$k] > $b[$k])?$ret:(!$ret);
            });
        }
        return $res;
    }
};
?>
