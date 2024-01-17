<?php
namespace App\Models\Admin;

class StateModel extends \App\Models\GoBaseModel
{
    protected $table = "state";

    /**
     * Whether primary key uses auto increment.
     *
     * @var bool
     */
    protected $useAutoIncrement = true;

    protected $primaryKey = "state_id";

    const SORTABLE = [
        1 => "t1.state_id",
        2 => "t1.state",
    ];

    protected $allowedFields = ["state", "created_by", "updated_by"];
    protected $returnType = "App\Entities\Admin\State";

    protected $useTimestamps = true;
    protected $useSoftDeletes = true;

    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';


    public static $labelField = "state";

    protected $validationRules = [
        "created_at" => [
            "label" => "States.createdAt",
            "rules" => "max_length[20]",
        ],
        "created_by" => [
            "label" => "States.createdBy",
            "rules" => "trim|max_length[120]",
        ],
        "state" => [
            "label" => "States.state",
            "rules" => "trim|max_length[120]",
        ],
        "updated_at" => [
            "label" => "States.updatedAt",
            "rules" => "max_length[20]",
        ],
        "updated_by" => [
            "label" => "States.updatedBy",
            "rules" => "trim|max_length[120]",
        ],
    ];

    protected $validationMessages = [
        "created_at" => [
            "max_length" => "States.validation.created_at.max_length",
        ],
        "created_by" => [
            "max_length" => "States.validation.created_by.max_length",
        ],
        "state" => [
            "max_length" => "States.validation.state.max_length",
        ],
        "updated_at" => [
            "max_length" => "States.validation.updated_at.max_length",
        ],
        "updated_by" => [
            "max_length" => "States.validation.updated_by.max_length",
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
        $builder = $this->db->table($this->table . " t1")
        ->select("t1.state_id AS state_id, t1.state AS state")
        ->where('t1.deleted_at', null);

        return empty($search)
            ? $builder
            : $builder
                ->groupStart()
                ->like("t1.state_id", $search)
                ->orLike("t1.state", $search)
                ->orLike("t1.state_id", $search)
                ->orLike("t1.state", $search)
                ->groupEnd();
    }
}
