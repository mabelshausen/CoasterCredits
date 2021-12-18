<?php


namespace App\Repositories;


interface CoasterRepository
{
    public function get($id);

    public function getByName($name);

    public function all($page);

    public function count();
}
