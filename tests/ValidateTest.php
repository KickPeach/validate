<?php
/**
 * Created by PhpStorm.
 * User: shisiying
 * Date: 2019-03-28
 * Time: 17:09
 */

namespace Tests\KickPeach\Validate;

use PHPUnit\Framework\TestCase;
use \KickPeach\Validate\Validate;
class ValidateTest extends TestCase
{
    public function setUp(){
        parent::setUp();
    }


    public function testValidate()
    {

        $data = [
//            'name'=>'111',
//            'avatar'=>'',
        ];

        $rules = [
//            'name'=>'required|max:2',
//            'avatar'=>'required|url',
        ];

        $data =  Validate::validated($data,$rules);

//        var_dump($data);
//        die();

    }
}

