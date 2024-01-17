<?php
namespace App\Entities\Admin;

use CodeIgniter\Entity;

class CropType extends \CodeIgniter\Entity\Entity
{
    protected $attributes = [
        "id" => null,
        "crop_type" => null,
        "variety" => null,
        "created_at" => null,
        "created_by" => null,
        "updated_at" => null,
        "updated_by" => null,
        "active" => true,
    ];
    protected $casts = [
        "active" => "?boolean",
    ];
}
