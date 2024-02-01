<?php
namespace App\Models\Admin;

class FertilzerCompanyModel extends \App\Models\GoBaseModel
{
    protected $table = "fertilzer_companies";

    /**
     * Whether primary key uses auto increment.
     *
     * @var bool
     */
    protected $useAutoIncrement = true;

    const SORTABLE = [
        1 => "t1.id",
        2 => "t1.fertilzer",
        3 => "t1.symbol",
        4 => "t1.nitrogen",
        5 => "t1.phosphorus",
        6 => "t1.potassium",
        7 => "t1.calcium",
        8 => "t1.sulfur",
        9 => "t1.magnesium",
        10 => "t1.maganense",
        11 => "t1.boron",
        12 => "t2.category",
    ];

    protected $allowedFields = [
        "fertilzer",
        "symbol",
        "nitrogen",
        "phosphorus",
        "potassium",
        "calcium",
        "sulfur",
        "magnesium",
        "maganense",
        "boron",
        "created_by",
        "updated_by",
        "cost_unit_default",
        "category",
    ];
    protected $returnType = "App\Entities\Admin\FertilzerCompany";


    protected $useTimestamps = true;
    protected $useSoftDeletes = true;

    protected $createdField = "created_at";
    protected $updatedField = "updated_at";
    protected $deletedField  = 'deleted_at';

    public static $labelField = "title";

    protected $validationRules = [
        "abn" => [
            "label" => "FertilzerCompanies.abn",
            "rules" => "trim|max_length[100]",
        ],
        "client_id" => [
            "label" => "FertilzerCompanies.clientId",
            "rules" => "integer|permit_empty",
        ],
        "company" => [
            "label" => "FertilzerCompanies.company",
            "rules" => "trim|max_length[300]",
        ],
        "country" => [
            "label" => "FertilzerCompanies.country",
            "rules" => "trim|max_length[100]",
        ],
        "created_at" => [
            "label" => "Companies.createdAt",
            "rules" => "max_length[20]",
        ],
        "created_by" => [
            "label" => "Companies.createdBy",
            "rules" => "trim|max_length[150]",
        ],
        "division" => [
            "label" => "FertilzerCompanies.division",
            "rules" => "trim|max_length[100]",
        ],
        "email_address" => [
            "label" => "FertilzerCompanies.emailAddress",
            "rules" => "trim|max_length[211]|valid_email|permit_empty",
        ],
        "first_name" => [
            "label" => "FertilzerCompanies.firstName",
            "rules" => "trim|max_length[211]",
        ],
         "last_name" => [
            "label" => "FertilzerCompanies.lastName",
            "rules" => "trim|max_length[211]",
        ],
        "mobile_number" => [
            "label" => "FertilzerCompanies.mobileNumber",
            "rules" => "trim|max_length[20]",
        ],
        "phone_no" => [
            "label" => "FertilzerCompanies.phoneNo",
            "rules" => "trim|max_length[50]",
        ],
        "postcode" => [
            "label" => "FertilzerCompanies.postcode",
            "rules" => "trim|max_length[20]",
        ],
        "registration_date" => [
            "label" => "FertilzerCompanies.registrationDate",
            "rules" => "valid_date|permit_empty",
        ],
        "state" => [
            "label" => "FertilzerCompanies.state",
            "rules" => "trim|max_length[50]",
        ],
        "status" => [
            "label" => "FertilzerCompanies.status",
            "rules" => "integer|permit_empty",
        ],
        "street" => [
            "label" => "FertilzerCompanies.street",
            "rules" => "trim|max_length[200]",
        ],
        "suburb" => [
            "label" => "FertilzerCompanies.suburb",
            "rules" => "trim|max_length[150]",
        ],
        "title" => [
            "label" => "FertilzerCompanies.title",
            "rules" => "trim|max_length[300]",
        ],
        "updated_at" => [
            "label" => "Companies.updatedAt",
            "rules" => "max_length[20]",
        ],
        "updated_by" => [
            "label" => "Companies.updatedBy",
            "rules" => "trim|max_length[150]",
        ],
    ];

    protected $validationMessages = [
        "abn" => [
            "max_length" => "FertilzerCompanies.validation.abn.max_length",
        ],
        "client_id" => [
            "integer" => "FertilzerCompanies.validation.client_id.integer",
        ],
        "company" => [
            "max_length" => "FertilzerCompanies.validation.company.max_length",
        ],
        "country" => [
            "max_length" => "FertilzerCompanies.validation.country.max_length",
        ],
        "division" => [
            "max_length" => "FertilzerCompanies.validation.division.max_length",
        ],
        "email_address" => [
            "max_length" => "FertilzerCompanies.validation.email_address.max_length",
            "valid_email" => "FertilzerCompanies.validation.email_address.valid_email",
        ],
        "created_at" => [
            "max_length" => "Companies.validation.created_at.max_length",
        ],
        "created_by" => [
            "max_length" => "Companies.validation.created_by.max_length",
        ],
        "first_name" => [
            "max_length" => "FertilzerCompanies.validation.first_name.max_length",
        ],
        "last_name" => [
            "max_length" => "FertilzerCompanies.validation.last_name.max_length",
        ],
        "mobile_number" => [
            "max_length" => "FertilzerCompanies.validation.mobile_number.max_length",
        ],
        "phone_no" => [
            "max_length" => "FertilzerCompanies.validation.phone_no.max_length",
        ],
        "postcode" => [
            "max_length" => "FertilzerCompanies.validation.postcode.max_length",
        ],
        "registration_date" => [
            "valid_date" => "FertilzerCompanies.validation.registration_date.valid_date",
        ],
        "state" => [
            "max_length" => "FertilzerCompanies.validation.state.max_length",
        ],
        "status" => [
            "integer" => "FertilzerCompanies.validation.status.integer",
        ],
        "street" => [
            "max_length" => "FertilzerCompanies.validation.street.max_length",
        ],
        "suburb" => [
            "max_length" => "FertilzerCompanies.validation.suburb.max_length",
        ],
        "title" => [
            "max_length" => "FertilzerCompanies.validation.title.max_length",
        ],
        "updated_at" => [
            "max_length" => "Companies.validation.updated_at.max_length",
        ],
        "updated_by" => [
            "max_length" => "Companies.validation.updated_by.max_length",
        ],
    ];

    public function getResource(string $search = "")
    {
        $builder = $this->db
            ->table($this->table . " t1")
            ->select(
                "t1.id AS id, t1.fertilzer AS fertilzer, t1.symbol AS symbol, t1.nitrogen AS nitrogen, t1.phosphorus AS phosphorus, t1.potassium AS potassium, t1.calcium AS calcium, t1.sulfur AS sulfur, t1.magnesium AS magnesium, t1.maganense AS maganense, t1.boron AS boron, t2.category AS category"
            );
        $builder->join("categories t2", "t1.category = t2.id", "left");

        return empty($search)
            ? $builder
            : $builder
                ->groupStart()
                ->like("t1.id", $search)
                ->orLike("t1.fertilzer", $search)
                ->orLike("t1.symbol", $search)
                ->orLike("t1.nitrogen", $search)
                ->orLike("t1.phosphorus", $search)
                ->orLike("t1.potassium", $search)
                ->orLike("t1.calcium", $search)
                ->orLike("t1.sulfur", $search)
                ->orLike("t1.magnesium", $search)
                ->orLike("t1.maganense", $search)
                ->orLike("t1.boron", $search)
                ->orLike("t2.id", $search)
                ->orLike("t2.category", $search)
                ->groupEnd();
    }
}
