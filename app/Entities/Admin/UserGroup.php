<?php
namespace App\Entities\Admin;

use CodeIgniter\Entity;

class UserGroup extends \CodeIgniter\Entity\Entity
{
    protected $attributes = [
        "id" => null,
        "name" => null,
        "description" => null,
    ];
    protected $casts = [];
}
