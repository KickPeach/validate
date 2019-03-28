<?php
/**
 * Created by PhpStorm.
 * User: shisiying
 * Date: 2019-03-28
 * Time: 15:52
 */

namespace KickPeach\Validate;

use KickPeach\Validate\Error;

class Rule
{

    public static function required($str,$column,$errmsgs=[])
    {
        $str = trim($str);
        $errmsg = '';
        if (empty($str)) {
            if (!empty($errmsgs)) {
                $errmsg = Error::run($errmsgs,$column,__FUNCTION__);
            }

            $errmsg = $errmsg ?:$column.':字段不能为空';
            throw new ValidateException($errmsg);
        }
        return $str;
    }

    public static function email($email,$column,$errmsgs=[])
    {
        $errmsg = '';
        $ret = filter_var($email,FILTER_VALIDATE_EMAIL);
        if (false === $ret) {
            if (!empty($errmsgs)) {
                $errmsg = Error::run($errmsgs,$column,__FUNCTION__);
            }
            $errmsg = $errmsg ? $errmsg : $column.':错误的email格式';
            throw new ValidateException($errmsg);
        }
        return $email;
    }

    public static function url($url, $column,$errmsgs=[])
    {
        $errmsg = '';
        $ret = filter_var($url, FILTER_VALIDATE_URL);
        if (false === $ret) {
            if (!empty($errmsgs)) {
                $errmsg = Error::run($errmsgs,$column,__FUNCTION__);
            }
            $errmsg = $errmsg ? $errmsg : $column.':错误的url格式';
            throw new ValidateException($errmsg);
        }
        return $url;
    }

    public static function ip($ip,$column,$errmsgs = [])
    {
        $errmsg = '';
        $ret = filter_var($ip, FILTER_VALIDATE_IP);
        if (false === $ret) {
            if (!empty($errmsgs)) {
                $errmsg = Error::run($errmsgs,$column,__FUNCTION__);
            }
            $errmsg = $errmsg ? $errmsg : $column.':错误的ip格式';
            throw new ValidateException($errmsg);
        }
        return $ret;
    }

    /**
     * @param $alpha
     * @param $column
     * @param array $errmsgs
     * @return mixed
     * @author sevenshi
     * @date 2019-03-28 23:01
     *检查给定的参数是否是字母
     */
    public static function alpha($alpha,  $column, $errmsgs = [])
    {
        $errmsg = '';

        if (is_string($alpha) && preg_match('/^[a-zA-Z]+$/', $alpha)!=0) {
            if (!empty($errmsgs)) {
                $errmsg = Error::run($errmsgs,$column,__FUNCTION__);
            }
            $errmsg = $errmsg ? $errmsg : $column.':错误的字母格式';
            throw new ValidateException($errmsg);        }
        return $alpha;

    }

    /**
     * @param $bool
     * @param $column
     * @param array $errmsgs
     * @return mixed
     * @author sevenshi
     * @date 2019-03-28 23:04
     *给定参数是否为布尔值
     */
    public static function bool($bool,  $column, $errmsgs = [])
    {
        $errmsg = '';

        if ($bool === 1 || $bool === true || $bool === 0 || $bool === false) {
            if (!empty($errmsgs)) {
                $errmsg = Error::run($errmsgs,$column,__FUNCTION__);
            }
            $errmsg = $errmsg ? $errmsg : $column.':错误的布尔格式';
            throw new ValidateException($errmsg);        }
        return $bool;

    }


    public static function decimal($decimal,  $column, $errmsgs = [],$arg=2)
    {
        $errmsg = '';
        $isdecimal = false;

        if (is_null($decimal)) {
            if (filter_var($decimal, FILTER_VALIDATE_FLOAT)){
                $isdecimal = true;
            }
        } elseif (intval($decimal) === 0) {
            // 容错处理 如果小数点后设置0位 则验整数
            if (filter_var($data, FILTER_VALIDATE_INT)){
                $isdecimal = true;
            }
        } else {
            $regex = '/^(0|[1-9]+[0-9]*)(.[0-9]{1,' . $arg . '})?$/';
            if (preg_match($regex, $data)!=0){
                $isdecimal = true;
            }
        }
        if (!$isdecimal) {
            if (!empty($errmsgs)) {
                $errmsg = Error::run($errmsgs,$column,__FUNCTION__);
            }
            $errmsg = $errmsg ? $errmsg : $column.':不合法的小数';
            throw new ValidateException($errmsg);
        }
        return $decimal;
    }



}