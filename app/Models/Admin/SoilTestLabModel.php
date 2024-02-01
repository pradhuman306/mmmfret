<?php
namespace App\Models\Admin;

class SoilTestLabModel extends \App\Models\GoBaseModel
{
    protected $table = "soil_test_labs";

    /**
     * Whether primary key uses auto increment.
     *
     * @var bool
     */
    protected $useAutoIncrement = true;

    const SORTABLE = [
        1 => "t1.id",
        2 => "t1.company",
        3 => "t1.client_id",
        4 => "t1.state",
        5 => "t1.suburb",
        6 => "t1.street",
        7 => "t1.postcode",
        8 => "t1.country",
        9 => "t1.email_address",
        10 => "t1.phone_no",
        11 => "t1.abn",
        12 => "t1.first_name",
        13 => "t1.last_name",
        14 => "t1.mobile_number",
        15 => "t1.title",
        16 => "t1.created_by",
        17 => "t1.updated_by",
    ];

    protected $useTimestamps = true;
    protected $useSoftDeletes = true;

    protected $createdField = "created_at";
    protected $updatedField = "updated_at";
    protected $deletedField  = 'deleted_at';

    protected $allowedFields = [
        "company",
        "client_id",
        "state",
        "suburb",
        "street",
        "postcode",
        "country",
        "email_address",
        "phone_no",
        "abn",
        "first_name",
        "last_name",
        "mobile_number",
        "title",
        "created_by",
        "updated_by",
    ];
    protected $returnType = "App\Entities\Admin\SoilTestLab";

    public static $labelField = "company";

    protected $validationRules = [
        "abn" => [
            "label" => "SoilTestLabs.abn",
            "rules" => "trim|max_length[100]",
        ],
        "client_id" => [
            "label" => "SoilTestLabs.clientId",
            "rules" => "integer|permit_empty",
        ],
        "company_name" => [
            "is_unique" => "Companies.validation.company_name.is_unique",
            "max_length" => "Companies.validation.company_name.max_length",
        ],
        "country" => [
            "label" => "SoilTestLabs.country",
            "rules" => "trim|max_length[100]",
        ],
        "created_by" => [
            "label" => "SoilTestLabs.createdBy",
            "rules" => "trim|max_length[150]",
        ],
        "email_address" => [
            "label" => "SoilTestLabs.emailAddress",
            "rules" => "trim|max_length[211]|valid_email|permit_empty",
        ],
        "first_name" => [
            "label" => "SoilTestLabs.firstName",
            "rules" => "trim|max_length[211]",
        ],
        "last_name" => [
            "label" => "SoilTestLabs.lastName",
            "rules" => "trim|max_length[211]",
        ],
        "mobile_number" => [
            "label" => "SoilTestLabs.mobileNumber",
            "rules" => "trim|max_length[20]",
        ],
        "phone_no" => [
            "label" => "SoilTestLabs.phoneNo",
            "rules" => "trim|max_length[20]",
        ],
        "postcode" => [
            "label" => "SoilTestLabs.postcode",
            "rules" => "trim|max_length[20]",
        ],
        "state" => [
            "label" => "SoilTestLabs.state",
            "rules" => "trim|max_length[50]",
        ],
        "street" => [
            "label" => "SoilTestLabs.street",
            "rules" => "trim|max_length[200]",
        ],
        "suburb" => [
            "label" => "SoilTestLabs.suburb",
            "rules" => "trim|max_length[150]",
        ],
        "title" => [
            "label" => "SoilTestLabs.title",
            "rules" => "trim|max_length[300]",
        ],
        "updated_by" => [
            "label" => "SoilTestLabs.updatedBy",
            "rules" => "trim|max_length[150]",
        ],
    ];

    protected $validationMessages = [
        "abn" => [
            "max_length" => "SoilTestLabs.validation.abn.max_length",
        ],
        "client_id" => [
            "integer" => "SoilTestLabs.validation.client_id.integer",
        ],
        "company" => [
            "max_length" => "SoilTestLabs.validation.company.max_length",
        ],
        "country" => [
            "max_length" => "SoilTestLabs.validation.country.max_length",
        ],
        "created_by" => [
            "max_length" => "SoilTestLabs.validation.created_by.max_length",
        ],
        "email_address" => [
            "max_length" => "SoilTestLabs.validation.email_address.max_length",
            "valid_email" => "SoilTestLabs.validation.email_address.valid_email",
        ],
        "first_name" => [
            "max_length" => "SoilTestLabs.validation.first_name.max_length",
        ],
        "last_name" => [
            "max_length" => "SoilTestLabs.validation.last_name.max_length",
        ],
        "mobile_number" => [
            "max_length" => "SoilTestLabs.validation.mobile_number.max_length",
        ],
        "phone_no" => [
            "max_length" => "SoilTestLabs.validation.phone_no.max_length",
        ],
        "postcode" => [
            "max_length" => "SoilTestLabs.validation.postcode.max_length",
        ],
        "state" => [
            "max_length" => "SoilTestLabs.validation.state.max_length",
        ],
        "street" => [
            "max_length" => "SoilTestLabs.validation.street.max_length",
        ],
        "suburb" => [
            "max_length" => "SoilTestLabs.validation.suburb.max_length",
        ],
        "title" => [
            "max_length" => "SoilTestLabs.validation.title.max_length",
        ],
        "updated_by" => [
            "max_length" => "SoilTestLabs.validation.updated_by.max_length",
        ],
    ];
    /**
     * Get resource data.
     *
     * @param string $search
     *
     * @return \CodeIgniter\Database\BaseBuilder
     */
    public function getResource(string $search = "")
    {
        $builder = $this->db
        ->table($this->table . " t1")
        ->select(
            "t1.*, t2.suburb AS suburb, t3.state AS state, t2.country"
        )->where('t1.deleted_at', null);
        $builder->join("postcode_australia_list t2", "t1.suburb = t2.id", "left");
        $builder->join("state t3", "t1.state = t3.state_id", "left");

        return empty($search)
            ? $builder
            : $builder
                ->groupStart()
                ->like("t1.id", $search)
                ->orLike("t1.company", $search)
                ->orLike("t1.client_id", $search)
                ->orLike("t1.suburb", $search)
                ->orLike("t1.street", $search)
                ->orLike("t1.country", $search)
                ->orLike("t1.email_address", $search)
                ->orLike("t1.phone_no", $search)
                ->orLike("t1.abn", $search)
                ->orLike("t1.first_name", $search)
                ->orLike("t1.last_name", $search)
                ->orLike("t1.mobile_number", $search)
                ->orLike("t1.title", $search)
                ->orLike("t1.created_at", $search)
                ->orLike("t1.created_by", $search)
                ->orLike("t1.updated_by", $search)
                ->orLike("t1.updated_at", $search)
                ->orLike("t2.state_id", $search)
                ->orLike("t3.id", $search)
                ->orLike("t1.id", $search)
                ->orLike("t1.company", $search)
                ->orLike("t1.client_id", $search)
                ->orLike("t1.state", $search)
                ->orLike("t1.suburb", $search)
                ->orLike("t1.street", $search)
                ->orLike("t1.postcode", $search)
                ->orLike("t1.country", $search)
                ->orLike("t1.email_address", $search)
                ->orLike("t1.phone_no", $search)
                ->orLike("t1.abn", $search)
                ->orLike("t1.first_name", $search)
                ->orLike("t1.last_name", $search)
                ->orLike("t1.mobile_number", $search)
                ->orLike("t1.title", $search)
                ->orLike("t1.created_by", $search)
                ->orLike("t1.updated_by", $search)
                ->orLike("t2.state", $search)
                ->orLike("t3.suburb", $search)
                ->groupEnd();
    }
}
