<?php
namespace App\Entities\Admin;

use CodeIgniter\Entity;

class PostcodeAustraliaList extends \CodeIgniter\Entity\Entity
{
    protected $attributes = [
        "id" => null,
        "postcode" => null,
        "suburb" => null,
        "state" => null,
        "country" => "Australia",
        "lat" => null,
        "lon" => null,
        "timezone" => null,
        "created_at" => null,
        "created_by" => null,
        "updated_at" => null,
        "updated_by" => null,
    ];
    protected $casts = [
        "lat" => "?float",
        "lon" => "?float",
    ];
}
