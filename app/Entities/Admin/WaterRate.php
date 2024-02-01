<?php
namespace App\Entities\Admin;

use CodeIgniter\Entity;

class WaterRate extends \CodeIgniter\Entity\Entity
{
    protected $attributes = [
        "id" => null,
        "rate" => null,
        "created_at" => null,
        "created_by" => null,
        "updated_at" => null,
        "updated_by" => null,
    ];
    protected $casts = [
        "rate" => "?int",
    ];
}
