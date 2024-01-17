<?php
namespace App\Models\Admin;

class CropTypeModel extends \App\Models\GoBaseModel
{
    protected $table = "crop_type";

    /**
     * Whether primary key uses auto increment.
     *
     * @var bool
     */
    protected $useAutoIncrement = true;

    protected $allowedFields = [
        "crop_type",
        "variety",
        "created_by",
        "updated_by",
        "active",
    ];
    protected $returnType = "App\Entities\Admin\CropType";

    protected $useTimestamps = true;
    protected $useSoftDeletes = true;

    protected $createdField = "created_at";

    protected $updatedField = "updated_at";

    public static $labelField = "crop_type";

    protected $validationRules = [
        "created_at" => [
            "label" => "CropTypes.createdAt",
            "rules" => "valid_date|permit_empty",
        ],
        "created_by" => [
            "label" => "CropTypes.createdBy",
            "rules" => "trim|max_length[120]",
        ],
        "crop_type" => [
            "label" => "CropTypes.cropType",
            "rules" => "trim|max_length[200]",
        ],
        "updated_at" => [
            "label" => "CropTypes.updatedAt",
             "rules" => "max_length[20]",
        ],
        "updated_by" => [
            "label" => "CropTypes.updatedBy",
            "rules" => "trim|max_length[31]",
        ],
        "variety" => [
            "label" => "CropTypes.variety",
            "rules" => "trim|max_length[200]",
        ],
    ];

    protected $validationMessages = [
        "created_at" => [
            "valid_date" => "CropTypes.validation.created_at.valid_date",
        ],
        "created_by" => [
            "max_length" => "CropTypes.validation.created_by.max_length",
        ],
        "crop_type" => [
            "max_length" => "CropTypes.validation.crop_type.max_length",
        ],
        "updated_at" => [
            "max_length" => "CropTypes.validation.updated_at.max_length",
        ],
        "updated_by" => [
            "max_length" => "CropTypes.validation.updated_by.max_length",
        ],
        "variety" => [
            "max_length" => "CropTypes.validation.variety.max_length",
        ],
    ];

}
