<?php
namespace App\Models\Admin;

class FertilizerTemplateModel extends \App\Models\GoBaseModel
{
    protected $table = "fertilizer_template";

    /**
     * Whether primary key uses auto increment.
     *
     * @var bool
     */
    protected $useAutoIncrement = true;

    protected $allowedFields = ["details"];
    protected $returnType = "App\Entities\Admin\FertilizerTemplate";

    public static $labelField = "details";

    protected $validationRules = [
        "details" => [
            "label" => "FertilizerTemplates.details",
            "rules" => "trim|max_length[300]",
        ],
    ];

    protected $validationMessages = [
        "details" => [
            "max_length" => "FertilizerTemplates.validation.details.max_length",
        ],
    ];
}
