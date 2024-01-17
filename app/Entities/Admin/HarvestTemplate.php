<?php
namespace App\Entities\Admin;

use CodeIgniter\Entity;

class HarvestTemplate extends \CodeIgniter\Entity\Entity
{
    protected $attributes = [
        "id" => null,
        "description" => null,
    ];
    protected $casts = [];
}
