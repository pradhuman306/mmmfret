<?php
namespace App\Models\Admin;

class PestDiseasesTemplateModel extends \App\Models\GoBaseModel
{
    protected $table = "pest_diseases_template";

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
    protected $returnType = "App\Entities\Admin\PestDiseasesTemplate";

    public static $labelField = "details";

    protected $validationRules = [
        "details" => [
            "label" => "PestDiseasesTemplates.details",
            "rules" => "trim|max_length[300]",
        ],
    ];

    protected $validationMessages = [
        "details" => [
            "max_length" => "PestDiseasesTemplates.validation.details.max_length",
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
        $builder = $this->db->table($this->table . " t1")->select("t1.id AS id, t1.details AS details");

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
