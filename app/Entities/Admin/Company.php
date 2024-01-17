<?php
namespace App\Entities\Admin;

use CodeIgniter\Entity;

class Company extends \CodeIgniter\Entity\Entity
{
    protected $attributes = [
        "id" => null,
        "company_name" => null,
        "street" => null,
        "abn" => null,
        "suburb" => null,
        "state" => null,
        "postcode" => null,
        "country" => null,
        "first_name" => null,
        "last_name" => null,
        "phone_no" => null,
        "email_address" => null,
        "sales_tax_default" => null,
        "mobile_number" => null,
        "created_at" => null,
        "updated_at" => null,
        "created_by" => null,
        "updated_by" => null,
        "lon" => null,
        "lat" => null,
        "title" => null,
    ];
    protected $casts = [
        "lon" => "?float",
        "lat" => "?float",
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
