<?php
/**
 * Created by PhpStorm.
 * User: shisiying
 * Date: 2019-03-27
 * Time: 23:49
 */

namespace KickPeach\Validate;

use KickPeach\Validate\ValidateException;

class Validate
{
    const REQUIRED = 'r'; //不为空
    const EMAIL = 'e'; //邮件
    const MOBILE = 'm';//手机号
    const URL = 'u';//网址
    const INT = 'i';//整型数字
    const FLOAT = 'f';//浮点数字
    const STRING = 's|4|6';//字符串，默认长度在4～6之间
    const NAME = 'n|4|6';//字母开头，只包含字母，数字 长度在4～16之间
    const CHINESE = 'c|4|6';//中文，默认长度在4～6之间
    const IP = 'ip';
    const MAC = 'mac';

    protected static $verfieddata = [];
    protected  static $ruleArr = [];

    public static function validated(array $data,array $rules,array $errmsg=[])
    {
        foreach($rules as $key=>$value) {
            //判断要过滤的key是否存在
            if (!isset($data[$key])) {
                throw new ValidateException('不存在该验证参数'.$key);
            }

            $filters = explode('|',$value);

            if (!empty($filters)) {

                self::$ruleArr[$key] = $filters;
                foreach ($filters as $rule_item) {
                    if (!empty($rule_item)){
                        if (in_array($rule_item,get_class_methods(Rule::class))){
                            Rule::$rule_item($data[$key],$key,$errmsg);
                        } else {
                            throw new ValidateException('不存在该验证规则'.$rule_item);
                        }
                    }
                }
            }
            self::$verfieddata[$key] = $data[$key];
        }
        return self::$verfieddata;
    }

}


