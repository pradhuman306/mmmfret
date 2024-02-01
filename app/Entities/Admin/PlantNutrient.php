<?php
namespace App\Entities\Admin;

use CodeIgniter\Entity;

class PlantNutrient extends \CodeIgniter\Entity\Entity
{
    protected $attributes = [
        "id" => null,
        "element" => null,
        "symbol" => null,
        "order" => null,
        "background_color" => null,
        "text_color" => null,
        "created_at" => null,
        "created_by" => null,
        "updated_at" => null,
        "updated_by" => null,
    ];
    protected $casts = [
        "order" => "?int",
    ];
}
