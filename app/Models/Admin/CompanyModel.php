<?php
namespace App\Models\Admin;

class CompanyModel extends \App\Models\GoBaseModel
{
    protected $table = "company";

    /**
     * Whether primary key uses auto increment.
     *
     * @var bool
     */
    protected $useAutoIncrement = false;

    protected $primaryKey = "id";

    const SORTABLE = [
        1 => "t1.id",
        2 => "t1.company_name",
        3 => "t1.street",
        4 => "t1.suburb",
        5 => "t1.state",
        6 => "t1.postcode",
        7 => "t1.first_name",
        8 => "t1.last_name",
        9 => "t1.phone_no",
        10 => "t1.email_address",
        11 => "t2.suburb",
        12 => "t3.state",
    ];

    protected $allowedFields = [
        "id",
        "company_name",
        "street",
        "abn",
        "suburb",
        "state",
        "postcode",
        "country",
        "first_name",
        "last_name",
        "phone_no",
        "email_address",
        "sales_tax_default",
        "mobile_number",
        "created_by",
        "updated_by",
        "lon",
        "lat",
        "title",
        "logo_url",
    ];
    protected $returnType = "App\Entities\Admin\Company";

    protected $useTimestamps = true;
    protected $useSoftDeletes = true;

    protected $createdField = "created_at";
    protected $updatedField = "updated_at";
    protected $deletedField  = 'deleted_at';

    public static $labelField = "title";

    protected $validationRules = [
        "abn" => [
            "label" => "Companies.abn",
            "rules" => "trim|max_length[100]",
        ],
        "company_name" => [
            "label" => "Companies.companyName",
            "rules" => "trim|max_length[250]",
        ],
        "country" => [
            "label" => "Companies.country",
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
        "email_address" => [
            "label" => "Companies.emailAddress",
            "rules" => "trim|max_length[100]|valid_email|permit_empty",
        ],
        "first_name" => [
            "label" => "Companies.firstName",
            "rules" => "trim|max_length[50]",
        ],
        "last_name" => [
            "label" => "Companies.lastName",
            "rules" => "trim|max_length[100]",
        ],
        "lat" => [
            "label" => "Companies.lat",
            "rules" => "decimal|permit_empty",
        ],
        "lon" => [
            "label" => "Companies.lon",
            "rules" => "decimal|permit_empty",
        ],
        "mobile_number" => [
            "label" => "Companies.mobileNumber",
            "rules" => "trim|max_length[50]",
        ],
        "phone_no" => [
            "label" => "Companies.phoneNo",
            "rules" => "trim|max_length[50]",
        ],
        "postcode" => [
            "label" => "Companies.postcode",
            "rules" => "trim|max_length[20]",
        ],
        "sales_tax_default" => [
            "label" => "Companies.salesTaxDefault",
            "rules" => "trim|max_length[50]",
        ],
        "street" => [
            "label" => "Companies.street",
            "rules" => "trim|max_length[200]",
        ],
        "title" => [
            "label" => "Companies.title",
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
            "max_length" => "Companies.validation.abn.max_length",
        ],
        "company_name" => [
            "is_unique" => "Companies.validation.company_name.is_unique",
            "max_length" => "Companies.validation.company_name.max_length",
        ],
        "country" => [
            "max_length" => "Companies.validation.country.max_length",
        ],
        "created_at" => [
            "max_length" => "Companies.validation.created_at.max_length",
        ],
        "created_by" => [
            "max_length" => "Companies.validation.created_by.max_length",
        ],
        "email_address" => [
            "max_length" => "Companies.validation.email_address.max_length",
            "valid_email" => "Companies.validation.email_address.valid_email",
        ],
        "first_name" => [
            "max_length" => "Companies.validation.first_name.max_length",
        ],
        "last_name" => [
            "max_length" => "Companies.validation.last_name.max_length",
        ],
        "lat" => [
            "decimal" => "Companies.validation.lat.decimal",
        ],
        "lon" => [
            "decimal" => "Companies.validation.lon.decimal",
        ],
        "mobile_number" => [
            "max_length" => "Companies.validation.mobile_number.max_length",
        ],
        "phone_no" => [
            "max_length" => "Companies.validation.phone_no.max_length",
        ],
        "postcode" => [
            "max_length" => "Companies.validation.postcode.max_length",
        ],
        "sales_tax_default" => [
            "max_length" => "Companies.validation.sales_tax_default.max_length",
        ],
        "street" => [
            "max_length" => "Companies.validation.street.max_length",
        ],
        "title" => [
            "max_length" => "Companies.validation.title.max_length",
        ],
        "updated_at" => [
            "max_length" => "Companies.validation.updated_at.max_length",
        ],
        "updated_by" => [
            "max_length" => "Companies.validation.updated_by.max_length",
        ],
    ];
    public function findAllWithAllRelations(string $selcols = "*", int $limit = null, int $offset = 0)
    {
        $sql =
            "SELECT t1." .
            $selcols .
            ",  t2.suburb AS suburb,  t3.state AS state FROM " .
            $this->table .
            " t1  LEFT JOIN postcode_australia_list t2 ON t1.suburb = t2.id LEFT JOIN state t3 ON t1.state = t3.state_id";
        if (!is_null($limit) && intval($limit) > 0) {
            $sql .= " LIMIT " . intval($limit);
        }

        if (!is_null($offset) && intval($offset) > 0) {
            $sql .= " OFFSET " . intval($offset);
        }

        $query = $this->db->query($sql);
        $result = $query->getResultObject();
        return $result;
    }

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
                "t1.id AS id, t1.company_name AS company_name, t1.street AS street, t1.postcode AS postcode, t1.first_name AS first_name, t1.last_name AS last_name, t1.phone_no AS phone_no, t1.email_address AS email_address, t2.suburb AS suburb, t3.state AS state"
            );
        $builder->join("postcode_australia_list t2", "t1.suburb = t2.id", "left");
        $builder->join("state t3", "t1.state = t3.state_id", "left");

        return empty($search)
            ? $builder
            : $builder
                ->groupStart()
                ->like("t1.id", $search)
                ->orLike("t1.company_name", $search)
                ->orLike("t1.street", $search)
                ->orLike("t1.postcode", $search)
                ->orLike("t1.first_name", $search)
                ->orLike("t1.last_name", $search)
                ->orLike("t1.phone_no", $search)
                ->orLike("t1.email_address", $search)
                ->orLike("t2.id", $search)
                ->orLike("t3.state_id", $search)
                ->orLike("t1.id", $search)
                ->orLike("t1.company_name", $search)
                ->orLike("t1.street", $search)
                ->orLike("t1.suburb", $search)
                ->orLike("t1.state", $search)
                ->orLike("t1.postcode", $search)
                ->orLike("t1.first_name", $search)
                ->orLike("t1.last_name", $search)
                ->orLike("t1.phone_no", $search)
                ->orLike("t1.email_address", $search)
                ->orLike("t2.suburb", $search)
                ->orLike("t3.state", $search)
                ->groupEnd();
    }
}
