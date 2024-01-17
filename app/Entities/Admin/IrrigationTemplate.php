<?php
namespace App\Entities\Admin;

use CodeIgniter\Entity;

class IrrigationTemplate extends \CodeIgniter\Entity\Entity
{
    protected $attributes = [
        "id" => null,
        "details" => null,
    ];
    protected $casts = [];
}
