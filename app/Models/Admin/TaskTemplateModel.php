<?php
namespace App\Models\Admin;

class TaskTemplateModel extends \App\Models\GoBaseModel
{
    protected $table = "task_template";

    /**
     * Whether primary key uses auto increment.
     *
     * @var bool
     */
    protected $useAutoIncrement = true;

    protected $allowedFields = ["details"];
    protected $returnType = "App\Entities\Admin\TaskTemplate";

    public static $labelField = "details";

    protected $validationRules = [
        "details" => [
            "label" => "TaskTemplates.details",
            "rules" => "trim|max_length[300]",
        ],
    ];

    protected $validationMessages = [
        "details" => [
            "max_length" => "TaskTemplates.validation.details.max_length",
        ],
    ];
}
