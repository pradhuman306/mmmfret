<?php
namespace App\Entities\Admin;

use CodeIgniter\Entity;

class State extends \CodeIgniter\Entity\Entity
{
    protected $attributes = [
        "state_id" => null,
        "state" => null,
        "created_at" => null,
        "created_by" => null,
        "updated_at" => null,
        "updated_by" => null,
    ];
    protected $casts = [];
}
