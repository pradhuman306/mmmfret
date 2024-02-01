<?php
namespace App\Models\Admin;

class WaterRateModel extends \App\Models\GoBaseModel
{
    protected $table = "water_rates";

    /**
     * Whether primary key uses auto increment.
     *
     * @var bool
     */
    protected $useAutoIncrement = true;

    const SORTABLE = [
        1 => "t1.id",
        2 => "t1.rate",
    ];

    protected $allowedFields = ["rate", "created_by", "updated_by"];

    protected $useTimestamps = true;
    protected $useSoftDeletes = true;

    protected $createdField = "created_at";
    protected $updatedField = "updated_at";
    protected $deletedField  = 'deleted_at';
    protected $returnType = "App\Entities\Admin\WaterRate";

    public static $labelField = "rate";

    protected $validationRules = [
        "created_at" => [
            "label" => "WaterRates.createdAt",
            "rules" => "max_length[20]",
        ],
        "created_by" => [
            "label" => "WaterRates.createdBy",
            "rules" => "trim|max_length[300]",
        ],
        "rate" => [
            "label" => "WaterRates.rate",
            "rules" => "integer|permit_empty",
        ],
        "updated_at" => [
            "label" => "WaterRates.updatedAt",
            "rules" => "max_length[20]",
        ],
        "updated_by" => [
            "label" => "WaterRates.updatedBy",
            "rules" => "trim|max_length[300]",
        ],
    ];

    protected $validationMessages = [
        "created_at" => [
            "max_length" => "WaterRates.validation.created_at.max_length",
        ],
        "created_by" => [
            "max_length" => "WaterRates.validation.created_by.max_length",
        ],
        "rate" => [
            "integer" => "WaterRates.validation.rate.integer",
        ],
        "updated_at" => [
            "max_length" => "WaterRates.validation.updated_at.max_length",
        ],
        "updated_by" => [
            "max_length" => "WaterRates.validation.updated_by.max_length",
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
        $builder = $this->db->table($this->table . " t1")->select("t1.id AS id, t1.rate AS rate") ->where('t1.deleted_at', null);;

        return empty($search)
            ? $builder
            : $builder
                ->groupStart()
                ->like("t1.id", $search)
                ->orLike("t1.rate", $search)
                ->orLike("t1.id", $search)
                ->orLike("t1.rate", $search)
                ->groupEnd();
    }
}
