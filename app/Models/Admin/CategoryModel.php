<?php
namespace App\Models\Admin;

class CategoryModel extends \App\Models\GoBaseModel
{
    protected $table = "categories";

    /**
     * Whether primary key uses auto increment.
     *
     * @var bool
     */
    protected $useAutoIncrement = true;

    const SORTABLE = [
        1 => "t1.id",
        2 => "t1.category",
    ];

    protected $allowedFields = ["category", "created_by", "updated_by"];
    protected $returnType = "App\Entities\Admin\Category";


    protected $useTimestamps = true;
    protected $useSoftDeletes = true;

    protected $createdField = "created_at";
    protected $updatedField = "updated_at";
    protected $deletedField  = 'deleted_at';


    public static $labelField = "category";

    protected $validationRules = [
        "category" => [
            "label" => "Categories.category",
            "rules" => "trim|max_length[200]",
        ],
        "created_at" => [
            "label" => "Categories.createdAt",
            "rules" => "max_length[20]",
        ],
        "created_by" => [
            "label" => "Categories.createdBy",
            "rules" => "trim|max_length[300]",
        ],
        "updated_at" => [
            "label" => "Categories.updatedAt",
            "rules" => "max_length[20]",
        ],
        "updated_by" => [
            "label" => "Categories.updatedBy",
            "rules" => "trim|max_length[300]",
        ],
    ];

    protected $validationMessages = [
        "category" => [
            "max_length" => "Categories.validation.category.max_length",
        ],
        "created_at" => [
            "max_length" => "Categories.validation.created_at.max_length",
        ],
        "created_by" => [
            "max_length" => "Categories.validation.created_by.max_length",
        ],
        "updated_at" => [
            "max_length" => "Categories.validation.updated_at.max_length",
        ],
        "updated_by" => [
            "max_length" => "Categories.validation.updated_by.max_length",
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
        $builder = $this->db->table($this->table . " t1")->select("t1.id AS id, t1.category AS category") ->where('t1.deleted_at', null);;

        return empty($search)
            ? $builder
            : $builder
                ->groupStart()
                ->like("t1.id", $search)
                ->orLike("t1.category", $search)
                ->orLike("t1.id", $search)
                ->orLike("t1.category", $search)
                ->groupEnd();
    }
}
