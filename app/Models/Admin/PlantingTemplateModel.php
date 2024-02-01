<?php
namespace App\Models\Admin;

class PlantingTemplateModel extends \App\Models\GoBaseModel
{
    protected $table = "planting_template";

    /**
     * Whether primary key uses auto increment.
     *
     * @var bool
     */
    protected $useAutoIncrement = true;

    const SORTABLE = [
        1 => "t1.id",
        2 => "t1.details",
    ];

    protected $allowedFields = ["details"];
    protected $returnType = "App\Entities\Admin\PlantingTemplate";

    public static $labelField = "details";

    protected $validationRules = [
        "details" => [
            "label" => "PlantingTemplates.details",
            "rules" => "trim|max_length[300]",
        ],
    ];

    protected $validationMessages = [
        "details" => [
            "max_length" => "PlantingTemplates.validation.details.max_length",
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
        $builder = $this->db->table($this->table . " t1")->select("t1.id AS id, t1.details AS details") ->where('t1.deleted_at', null);;

        return empty($search)
            ? $builder
            : $builder
                ->groupStart()
                ->like("t1.id", $search)
                ->orLike("t1.details", $search)
                ->orLike("t1.id", $search)
                ->orLike("t1.details", $search)
                ->groupEnd();
    }
}
