<?php
namespace App\Entities\Admin;

use CodeIgniter\Entity;

class FertilizerTemplate extends \CodeIgniter\Entity\Entity
{
    protected $attributes = [
        "id" => null,
        "details" => null,
    ];
    protected $casts = [];
}
