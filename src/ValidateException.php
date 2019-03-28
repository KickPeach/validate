<?php
/**
 * Created by PhpStorm.
 * User: shisiying
 * Date: 2019-03-27
 * Time: 23:49
 */

namespace KickPeach\Validate;

use Throwable;

class ValidateException extends \RuntimeException
{
    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

}