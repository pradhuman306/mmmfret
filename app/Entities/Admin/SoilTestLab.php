<?php
namespace App\Entities\Admin;

use CodeIgniter\Entity;

class SoilTestLab extends \CodeIgniter\Entity\Entity
{
    protected $attributes = [
        "id" => null,
        "company" => null,
        "client_id" => null,
        "street" => null,
        "suburb" => null,
        "updated_at" => null,
        "title" => null,
        "updated_by" => null,
        "created_by" => null,
        "created_at" => null,
        "postcode" => null,
        "state" => null,
        "country" => null,
        "phone_no" => null,
        "mobile_number" => null,
        "abn" => null,
        "last_name" => null,
        "first_name" => null,
        "email_address" => null,
    ];
    protected $casts = [
        "client_id" => "?int",
    ];
    /**
     * Returns a full name: "first last"
     *
     * @return string
     */
    public function getFullName()
    {
        $fullName =
            (!empty($this->attributes["first_name"]) ? trim($this->attributes["first_name"]) . " " : "") .
            (!empty($this->attributes["last_name"]) ? trim($this->attributes["last_name"]) : "");
        $name = empty($fullName) ? $this->attributes["username"] : $fullName;
        return $name;
    }

    /**
     * Alias for getFullName()
     *
     * @return string
     */
    public function fullName()
    {
        return $this->getFullName();
    }
}
