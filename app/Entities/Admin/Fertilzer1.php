<?php
namespace App\Entities\Admin;

use CodeIgniter\Entity;

class Fertilzer extends \CodeIgniter\Entity\Entity
{
    protected $attributes = [
        "id" => null,
        "fertilzer" => null,
        "symbol" => null,
        "nitrogen" => null,
        "phosphorus" => null,
        "potassium" => null,
        "calcium" => null,
        "sulfur" => null,
        "magnesium" => null,
        "maganense" => null,
        "boron" => null,
        "created_at" => null,
        "created_by" => null,
        "updated_at" => null,
        "updated_by" => null,
    ];
    protected $casts = [
        "nitrogen" => "?float",
        "phosphorus" => "?float",
        "potassium" => "?float",
        "calcium" => "?float",
        "sulfur" => "?float",
        "magnesium" => "?float",
        "maganense" => "?float",
        "boron" => "?float",
    ];
}
