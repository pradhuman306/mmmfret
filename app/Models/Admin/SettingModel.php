<?php
namespace App\Models\Admin;

class SettingModel extends \App\Models\GoBaseModel
{
    protected $table = "settings";

    /**
     * Whether primary key uses auto increment.
     *
     * @var bool
     */
    protected $useAutoIncrement = true;

    protected $allowedFields = ["description", "company_id"];
    protected $returnType = "App\Entities\Admin\Setting";

    public static $labelField = "description";

    protected $validationRules = [
        "company_id" => [
            "label" => "Settings.companyId",
            "rules" => "required|integer",
        ],
        "description" => [
            "label" => "Settings.description",
            "rules" => "trim|max_length[150]",
        ],
    ];

    protected $validationMessages = [
        "company_id" => [
            "integer" => "Settings.validation.company_id.integer",
            "required" => "Settings.validation.company_id.required",
        ],
        "description" => [
            "max_length" => "Settings.validation.description.max_length",
        ],
    ];
}
