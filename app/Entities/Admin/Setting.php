<?php
namespace App\Entities\Admin;

use CodeIgniter\Entity;

class Setting extends \CodeIgniter\Entity\Entity
{
    protected $attributes = [
        "id" => null,
        "description" => null,
        "company_id" => null,
    ];
    protected $casts = [
        "company_id" => "int",
    ];
}
