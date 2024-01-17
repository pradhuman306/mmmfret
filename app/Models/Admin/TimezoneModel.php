<?php
namespace App\Models\Admin;

class TimezoneModel extends \App\Models\GoBaseModel
{
    protected $table = "timezone";

    /**
     * Whether primary key uses auto increment.
     *
     * @var bool
     */
    protected $useAutoIncrement = true;

    const SORTABLE = [
        1 => "t1.id",
        2 => "t1.timezone",
    ];

    protected $allowedFields = ["timezone", "created_by", "updated_by"];
    protected $returnType = "App\Entities\Admin\Timezone";

    protected $useTimestamps = true;
    protected $useSoftDeletes = true;

    protected $createdField = "created_at";
    protected $updatedField = "updated_at";
    protected $deletedField  = 'deleted_at';

    protected $validationRules = [
        "created_at" => [
            "label" => "Timezones.createdAt",
            "rules" => "valid_date|permit_empty",
        ],
        "created_by" => [
            "label" => "Timezones.createdBy",
            "rules" => "trim|max_length[150]",
        ],
        "timezone" => [
            "label" => "Timezones.timezone",
            "rules" => "trim|max_length[120]",
        ],
        "updated_at" => [
            "label" => "Timezones.updatedAt",
            "rules" => "valid_date|permit_empty",
        ],
        "updated_by" => [
            "label" => "Timezones.updatedBy",
            "rules" => "trim|max_length[150]",
        ],
    ];

    protected $validationMessages = [
        "created_at" => [
            "valid_date" => "Timezones.validation.created_at.valid_date",
        ],
        "created_by" => [
            "max_length" => "Timezones.validation.created_by.max_length",
        ],
        "timezone" => [
            "max_length" => "Timezones.validation.timezone.max_length",
        ],
        "updated_at" => [
            "valid_date" => "Timezones.validation.updated_at.valid_date",
        ],
        "updated_by" => [
            "max_length" => "Timezones.validation.updated_by.max_length",
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
        $builder = $this->db->table($this->table . " t1")->select("t1.id AS id, t1.timezone AS timezone")->where('t1.deleted_at', null);;

        return empty($search)
            ? $builder
            : $builder
                ->groupStart()
                ->like("t1.id", $search)
                ->orLike("t1.timezone", $search)
                ->orLike("t1.id", $search)
                ->orLike("t1.timezone", $search)
                ->groupEnd();
    }
}
