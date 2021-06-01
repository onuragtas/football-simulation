<?php


namespace App\Http\Repositories;


/**
 * Class AbstractRepository
 *
 * @package App\Http\Repositories
 */
abstract class AbstractRepository
{
    /**
     * @return mixed
     */
    abstract public static function getInstance();
}
