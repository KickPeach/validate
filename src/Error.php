<?php
/**
 * Created by PhpStorm.
 * User: shisiying
 * Date: 2019-03-28
 * Time: 15:52
 */

namespace KickPeach\Validate;


class Error
{
    public static function run($errmsgs,$column,$filter_func)
    {
        $errmsg = '';
        foreach ($errmsgs as $err_key => $err_msg) {
            $segments = explode('.', $err_key);
            if ($segments[0]==$column && $segments[1]==$filter_func){
                if (count($segments)>2){
                    throw new ValidateException('自定义错误信息数组中'.$column.'键值不对');
                }
                if (isset($errmsgs[$err_key]) && !empty($errmsgs[$err_key])){
                    $errmsg = $errmsgs[$err_key];
                    break;
                }
            }
        }
        return $errmsg;
    }

}