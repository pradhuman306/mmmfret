<?php
namespace App\Models\Admin;

class HarvestTemplateModel extends \App\Models\GoBaseModel
{
    protected $table = "harvest_template";

    /**
     * Whether primary key uses auto increment.
     *
     * @var bool
     */
    protected $useAutoIncrement = true;

    const SORTABLE = [
        1 => "t1.id",
        2 => "t1.description",
    ];

    protected $allowedFields = ["description"];
    protected $returnType = "App\Entities\Admin\HarvestTemplate";

    public static $labelField = "description";

    protected $validationRules = [
        "description" => [
            "label" => "HarvestTemplates.description",
            "rules" => "trim|max_length[300]",
        ],
    ];

    protected $validationMessages = [
        "description" => [
            "max_length" => "HarvestTemplates.validation.description.max_length",
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
        $builder = $this->db->table($this->table . " t1")->select("t1.id AS id, t1.description AS description");

        return empty($search)
            ? $builder
            : $builder
                ->groupStart()
                ->like("t1.id", $search)
                ->orLike("t1.description", $search)
                ->orLike("t1.id", $search)
                ->orLike("t1.description", $search)
                ->groupEnd();
    }
}
