<?php
namespace App\Entities\Admin;

use CodeIgniter\Entity;

class Category extends \CodeIgniter\Entity\Entity
{
    protected $attributes = [
        "id" => null,
        "category" => null,
        "created_at" => null,
        "created_by" => null,
        "updated_at" => null,
        "updated_by" => null,
    ];
    protected $casts = [];
}
