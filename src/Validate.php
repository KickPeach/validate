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

    protected static $verfieddata = [];
    protected  static $ruleArr = [];

    /**
     * @param array $data 需要验证的数据
     * @param array $rules 验证规则
     * @param array $errmsg 自定义报错信息
     * @return array
     * @author sevenshi
     * @date 2019-03-29 10:58
     */
    public static function validated(array $data,array $rules,array $errmsg=[])
    {
        foreach($rules as $key=>$value) {

            if (!isset($data[$key])) {
                throw new ValidateException('不存在该验证参数'.$key);
            }

            $filters = explode('|',$value);

            if (!empty($filters)) {
                self::$ruleArr[$key] = $filters;
                foreach ($filters as $rule_item) {
                    if (!empty($rule_item)){
                        $rule_argc_arr  = explode(':',$rule_item);
                        if (count($rule_argc_arr)==2){

                            if (in_array($rule_argc_arr[0],get_class_methods(Rule::class))){
                                $argc_func = $rule_argc_arr[0];
                                $counts = self::get_func_params(Rule::class,$argc_func);
                                if ($counts==3){
                                    throw new \KickPeach\Validate\ValidateException($argc_func.':不存在可定义参数'.$rule_argc_arr[1]);
                                }
                                Rule::$argc_func($data[$key],$key,$errmsg,$rule_argc_arr[1]);
                            } else {
                                throw new ValidateException('不存在该验证规则'.$rule_item);
                            }

                        }else if (count($rule_argc_arr)==1){

                            if (in_array($rule_item,get_class_methods(Rule::class))){
                                Rule::$rule_item($data[$key],$key,$errmsg);
                            } else {
                                throw new ValidateException('不存在该验证规则'.$rule_item);
                            }

                        } else {
                            throw new \KickPeach\Validate\ValidateException($rule_item.'验证格式不对');
                        }
                    }
                }
            }
            self::$verfieddata[$key] = $data[$key];
        }
        return self::$verfieddata;
    }

    /**
     * @param $class_name
     * @param $func
     * @return int
     * @throws \ReflectionException
     * @author sevenshi
     * @date 2019-03-29 10:59
     * 获取函数参数的个数
     */
    private static function get_func_params($class_name,$func)
    {
        $reflection =  new \ReflectionClass ( $class_name );
        $method = $reflection->getMethod($func);
        $str = $method->getDocComment();
        preg_match_all('/@param/',$str,$m);
        return count($m[0]);
    }

}


