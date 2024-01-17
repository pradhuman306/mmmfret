<?php
namespace App\Entities\Admin;

use CodeIgniter\Entity;

class Timezone extends \CodeIgniter\Entity\Entity
{
    protected $attributes = [
        "id" => null,
        "timezone" => null,
        "created_at" => null,
        "created_by" => null,
        "updated_at" => null,
        "updated_by" => null,
    ];
    protected $casts = [];
}
