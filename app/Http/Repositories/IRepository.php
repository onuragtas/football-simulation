<?php


namespace App\Http\Repositories;


interface IRepository
{
    public function getAll();
    public function get(int $id);
}
