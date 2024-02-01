<?php
namespace App\Models\Admin;

class FertilzerModel extends \App\Models\GoBaseModel
{
    protected $table = "fertilzer";

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
        "created_at",
        "cost_unit_default",
        "created_by",
        "category",
        "updated_at",
        "updated_by",
        "rate_per_litre",
        "rate_per_kg",
        "units",
    ];
    protected $returnType = "App\Entities\Admin\Fertilzer";

    protected $useTimestamps = true;
    protected $useSoftDeletes = true;

    protected $createdField = "created_at";
    protected $updatedField = "updated_at";
    protected $deletedField  = 'deleted_at';

    public static $labelField = "fertilzer";

    protected $validationRules = [
        "boron" => [
            "label" => "Fertilzers.boron",
            "rules" => "decimal|permit_empty",
        ],
        "calcium" => [
            "label" => "Fertilzers.calcium",
            "rules" => "decimal|permit_empty",
        ],
        "cost_unit_default" => [
            "label" => "Fertilzers.costUnitDefault",
            "rules" => "decimal|permit_empty",
        ],
        "created_at" => [
            "label" => "Fertilzers.createdAt",
            "rules" => "max_length[20]",
        ],
        "created_by" => [
            "label" => "Fertilzers.createdBy",
            "rules" => "trim|max_length[150]",
        ],
        "fertilzer" => [
            "label" => "Fertilzers.fertilzer",
            "rules" => "trim|max_length[250]",
        ],
        "maganense" => [
            "label" => "Fertilzers.maganense",
            "rules" => "decimal|permit_empty",
        ],
        "magnesium" => [
            "label" => "Fertilzers.magnesium",
            "rules" => "decimal|permit_empty",
        ],
        "nitrogen" => [
            "label" => "Fertilzers.nitrogen",
            "rules" => "decimal|permit_empty",
        ],
        "phosphorus" => [
            "label" => "Fertilzers.phosphorus",
            "rules" => "decimal|permit_empty",
        ],
        "potassium" => [
            "label" => "Fertilzers.potassium",
            "rules" => "decimal|permit_empty",
        ],
        "rate_per_kg" => [
            "label" => "Fertilzers.ratePerKg",
            "rules" => "decimal|permit_empty",
        ],
        "rate_per_litre" => [
            "label" => "Fertilzers.ratePerLitre",
            "rules" => "decimal|permit_empty",
        ],
        "sulfur" => [
            "label" => "Fertilzers.sulfur",
            "rules" => "decimal|permit_empty",
        ],
        "symbol" => [
            "label" => "Fertilzers.symbol",
            "rules" => "trim|max_length[20]",
        ],
        "units" => [
            "label" => "Fertilzers.units",
            "rules" => "decimal|permit_empty",
        ],
        "updated_at" => [
            "label" => "Fertilzers.updatedAt",
            "rules" => "max_length[20]",
        ],
        "updated_by" => [
            "label" => "Fertilzers.updatedBy",
            "rules" => "trim|max_length[150]",
        ],
    ];

    protected $validationMessages = [
        "boron" => [
            "decimal" => "Fertilzers.validation.boron.decimal",
        ],
        "calcium" => [
            "decimal" => "Fertilzers.validation.calcium.decimal",
        ],
        "cost_unit_default" => [
            "decimal" => "Fertilzers.validation.cost_unit_default.decimal",
        ],
        "created_at" => [
            "max_length" => "Fertilzers.validation.created_at.max_length",
        ],
        "created_by" => [
            "max_length" => "Fertilzers.validation.created_by.max_length",
        ],
        "fertilzer" => [
            "max_length" => "Fertilzers.validation.fertilzer.max_length",
        ],
        "maganense" => [
            "decimal" => "Fertilzers.validation.maganense.decimal",
        ],
        "magnesium" => [
            "decimal" => "Fertilzers.validation.magnesium.decimal",
        ],
        "nitrogen" => [
            "decimal" => "Fertilzers.validation.nitrogen.decimal",
        ],
        "phosphorus" => [
            "decimal" => "Fertilzers.validation.phosphorus.decimal",
        ],
        "potassium" => [
            "decimal" => "Fertilzers.validation.potassium.decimal",
        ],
        "rate_per_kg" => [
            "decimal" => "Fertilzers.validation.rate_per_kg.decimal",
        ],
        "rate_per_litre" => [
            "decimal" => "Fertilzers.validation.rate_per_litre.decimal",
        ],
        "sulfur" => [
            "decimal" => "Fertilzers.validation.sulfur.decimal",
        ],
        "symbol" => [
            "max_length" => "Fertilzers.validation.symbol.max_length",
        ],
        "units" => [
            "decimal" => "Fertilzers.validation.units.decimal",
        ],
        "updated_at" => [
            "max_length" => "Fertilzers.validation.updated_at.max_length",
        ],
        "updated_by" => [
            "max_length" => "Fertilzers.validation.updated_by.max_length",
        ],
    ];

    public function findAllWithCategories(string $selcols = "*", int $limit = null, int $offset = 0)
    {
        $sql =
            "SELECT t1." .
            $selcols .
            ",  t2.category AS category FROM " .
            $this->table .
            " t1  LEFT JOIN categories t2 ON t1.category = t2.id";
        if (!is_null($limit) && intval($limit) > 0) {
            $sql .= " LIMIT " . $limit;
        }

        if (!is_null($offset) && intval($offset) > 0) {
            $sql .= " OFFSET " . $offset;
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
                ->orLike("t1.id", $search)
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
                ->orLike("t2.category", $search)
                ->groupEnd();
    }
}
