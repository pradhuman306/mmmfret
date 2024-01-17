<?php
namespace App\Models\Admin;

class CationFormulaModel extends \App\Models\GoBaseModel
{
    protected $table = "cation_formula";

    /**
     * Whether primary key uses auto increment.
     *
     * @var bool
     */
    protected $useAutoIncrement = true;

    protected $allowedFields = ["details"];
    protected $returnType = "App\Entities\Admin\CationFormula";

    public static $labelField = "details";

    protected $validationRules = [
        "details" => [
            "label" => "CationFormulas.details",
            "rules" => "trim|max_length[300]",
        ],
    ];

    protected $validationMessages = [
        "details" => [
            "max_length" => "CationFormulas.validation.details.max_length",
        ],
    ];
}
