<?php
/**
 * Created by PhpStorm.
 * User: tiago
 * Date: 11/08/16
 * Time: 17:18
 */

namespace Tiago\DI;

use App\Conn;
class Container
{
    public static function getModel($model)
    {
        $class = "\\App\\Models\\".ucfirst($model);
        return new $class(Conn::getDb());
    }



}