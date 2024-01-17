<?php
namespace App\Entities\Admin;

use CodeIgniter\Entity;

class XeroSalesGst extends \CodeIgniter\Entity\Entity
{
    protected $attributes = [
        "id" => null,
        "type" => null,
        "xero_code" => null,
        "created_at" => null,
        "created_by" => null,
        "updated_at" => null,
        "updated_by" => null,
    ];
    protected $casts = [];
}
