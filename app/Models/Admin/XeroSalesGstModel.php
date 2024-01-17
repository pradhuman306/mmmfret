<?php
namespace App\Models\Admin;

class XeroSalesGstModel extends \App\Models\GoBaseModel
{
    protected $table = "xero_sales_gst";

    /**
     * Whether primary key uses auto increment.
     *
     * @var bool
     */
    protected $useAutoIncrement = true;

    const SORTABLE = [
        1 => "t1.id",
        2 => "t1.type",
        3 => "t1.xero_code",
    ];

    protected $allowedFields = ["type", "xero_code", "created_by", "updated_by"];
    protected $returnType = 'App\Entities\Admin\XeroSalesGst';

    protected $useTimestamps = true;
    protected $useSoftDeletes = true;

    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';


    protected $validationRules = [
        "created_at" => [
            "label" => "XeroSalesGsts.createdAt",
            "rules" => "valid_date|permit_empty",
        ],
        "created_by" => [
            "label" => "XeroSalesGsts.createdBy",
            "rules" => "trim|max_length[150]",
        ],
        "type" => [
            "label" => "XeroSalesGsts.type",
            "rules" => "trim|max_length[120]",
        ],
        "updated_at" => [
            "label" => "XeroSalesGsts.updatedAt",
            "rules" => "valid_date|permit_empty",
        ],
        "updated_by" => [
            "label" => "XeroSalesGsts.updatedBy",
            "rules" => "trim|max_length[150]",
        ],
        "xero_code" => [
            "label" => "XeroSalesGsts.xeroCode",
            "rules" => "trim|max_length[150]",
        ],
    ];

    protected $validationMessages = [
        "created_at" => [
            "valid_date" => "XeroSalesGsts.validation.created_at.valid_date",
        ],
        "created_by" => [
            "max_length" => "XeroSalesGsts.validation.created_by.max_length",
        ],
        "type" => [
            "max_length" => "XeroSalesGsts.validation.type.max_length",
        ],
        "updated_at" => [
            "valid_date" => "XeroSalesGsts.validation.updated_at.valid_date",
        ],
        "updated_by" => [
            "max_length" => "XeroSalesGsts.validation.updated_by.max_length",
        ],
        "xero_code" => [
            "max_length" => "XeroSalesGsts.validation.xero_code.max_length",
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
            ->select("t1.id AS id, t1.type AS type, t1.xero_code AS xero_code")
            ->where('t1.deleted_at', null);

        return empty($search)
            ? $builder
            : $builder
                ->groupStart()
                ->like("t1.id", $search)
                ->orLike("t1.type", $search)
                ->orLike("t1.xero_code", $search)
                ->orLike("t1.id", $search)
                ->orLike("t1.type", $search)
                ->orLike("t1.xero_code", $search)
                ->groupEnd();
    }
}
