<?php


namespace App\Models;


class Coaster
{
    public $id;
    public $name;
    public $materialType;
    public $seatingType;
    public $speed;
    public $height;
    public $length;
    public $inversionsNumber;
    public $manufacturer;
    public $park;
    public $park_id;
    public $status;
    public $rank;
    public $imagePath;

    /**
     * Coaster constructor.
     */
    public function __construct(
        $id,
        $name,
        $materialType,
        $seatingType,
        $speed,
        $height,
        $length,
        $inversionsNumber,
        $manufacturer,
        $park,
        $park_id,
        $status,
        $rank,
        $imagePath
    )
    {
        $this->id = $id;
        $this->name = $name;
        $this->materialType = $materialType;
        $this->seatingType = $seatingType;
        $this->speed = $speed;
        $this->height = $height;
        $this->length = $length;
        $this->inversionsNumber = $inversionsNumber;
        $this->manufacturer = $manufacturer;
        $this->park = $park;
        $this->park_id = $park_id;
        $this->status = $status;
        $this->rank = $rank;
        $this->imagePath = $imagePath;
    }
}
