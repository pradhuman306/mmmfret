<?php
namespace App\Models\Admin;

class PlantNutrientModel extends \App\Models\GoBaseModel
{
    protected $table = "plant_nutrients";

    /**
     * Whether primary key uses auto increment.
     *
     * @var bool
     */
    protected $useAutoIncrement = true;

    const SORTABLE = [
        1 => "t1.id",
        2 => "t1.element",
        3 => "t1.symbol",
        4 => "t1.order",
    ];

    protected $allowedFields = [
        "element",
        "symbol",
        "order",
        "background_color",
        "text_color",
        "created_by",
        "updated_by",
    ];
    protected $returnType = "App\Entities\Admin\PlantNutrient";

    protected $useTimestamps = true;
    protected $useSoftDeletes = true;

    protected $createdField = "created_at";
    protected $updatedField = "updated_at";
    protected $deletedField  = 'deleted_at';

    public static $labelField = "element";

    protected $validationRules = [
        "background_color" => [
            "label" => "PlantNutrients.backgroundColor",
            "rules" => "trim|max_length[50]",
        ],
        "created_at" => [
            "label" => "PlantNutrients.createdAt",
            "rules" => "max_length[20]",
        ],
        "created_by" => [
            "label" => "PlantNutrients.createdBy",
            "rules" => "trim|max_length[300]",
        ],
        "element" => [
            "label" => "PlantNutrients.element",
            "rules" => "trim|max_length[300]",
        ],
        "order" => [
            "label" => "PlantNutrients.order",
            "rules" => "integer|permit_empty",
        ],
        "symbol" => [
            "label" => "PlantNutrients.symbol",
            "rules" => "trim|max_length[20]",
        ],
        "text_color" => [
            "label" => "PlantNutrients.textColor",
            "rules" => "trim|max_length[50]",
        ],
        "updated_at" => [
            "label" => "PlantNutrients.updatedAt",
            "rules" => "max_length[20]",
        ],
        "updated_by" => [
            "label" => "PlantNutrients.updatedBy",
            "rules" => "trim|max_length[300]",
        ],
    ];

    protected $validationMessages = [
        "background_color" => [
            "max_length" => "PlantNutrients.validation.background_color.max_length",
        ],
        "created_at" => [
            "max_length" => "PlantNutrients.validation.created_at.max_length",
        ],
        "created_by" => [
            "max_length" => "PlantNutrients.validation.created_by.max_length",
        ],
        "element" => [
            "max_length" => "PlantNutrients.validation.element.max_length",
        ],
        "order" => [
            "integer" => "PlantNutrients.validation.order.integer",
        ],
        "symbol" => [
            "max_length" => "PlantNutrients.validation.symbol.max_length",
        ],
        "text_color" => [
            "max_length" => "PlantNutrients.validation.text_color.max_length",
        ],
        "updated_at" => [
            "max_length" => "PlantNutrients.validation.updated_at.max_length",
        ],
        "updated_by" => [
            "max_length" => "PlantNutrients.validation.updated_by.max_length",
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
            ->select("t1.id AS id, t1.element AS element, t1.symbol AS symbol, t1.order AS order") ->where('t1.deleted_at', null);;

        return empty($search)
            ? $builder
            : $builder
                ->groupStart()
                ->like("t1.id", $search)
                ->orLike("t1.element", $search)
                ->orLike("t1.symbol", $search)
                ->orLike("t1.order", $search)
                ->orLike("t1.id", $search)
                ->orLike("t1.element", $search)
                ->orLike("t1.symbol", $search)
                ->orLike("t1.order", $search)
                ->groupEnd();
    }
}
