<?php


namespace App\Models;


class Park
{
    public $id;
    public $name;
    public $country;
    public $longitude;
    public $latitude;

    public function __construct($id, $name, $country, $longitude, $latitude)
    {
        $this->id = $id;
        $this->name = $name;
        $this->country = $country;
        $this->longitude = $longitude;
        $this->latitude = $latitude;
    }


}
