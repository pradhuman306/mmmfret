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
        "cost_unit_default" => null,
        "created_by" => null,
        "category" => null,
        "updated_at" => null,
        "updated_by" => null,
        "rate_per_litre" => null,
        "rate_per_kg" => null,
        "units" => null,
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
        "cost_unit_default" => "?float",
        "rate_per_litre" => "?float",
        "rate_per_kg" => "?float",
        "units" => "?float",
    ];
}
