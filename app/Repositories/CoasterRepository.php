<?php


namespace App\Repositories;


interface CoasterRepository
{
    public function get($id);

    public function all($page);

    public function count();
}
