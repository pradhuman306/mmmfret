<?php
namespace App\Models\Admin;

class SoilTestLabModel extends \App\Models\GoBaseModel
{
    protected $table = "soil_test_labs";

    /**
     * Whether primary key uses auto increment.
     *
     * @var bool
     */
    protected $useAutoIncrement = true;

    protected $allowedFields = [
        "company",
        "client_id",
        "invoice_prefix",
        "status",
        "registration_date",
        "street",
        "suburb",
        "postcode",
        "state",
        "country",
        "phone_number",
        "mobile_number",
        "abn",
        "division",
        "last_name",
        "first_name",
        "email_address",
    ];
    protected $returnType = "App\Entities\Admin\SoilTestLab";

    public static $labelField = "company";

    protected $validationRules = [
        "abn" => [
            "label" => "SoilTestLabs.abn",
            "rules" => "trim|max_length[100]",
        ],
        "client_id" => [
            "label" => "SoilTestLabs.clientId",
            "rules" => "integer|permit_empty",
        ],
        "company" => [
            "label" => "SoilTestLabs.company",
            "rules" => "trim|max_length[300]",
        ],
        "country" => [
            "label" => "SoilTestLabs.country",
            "rules" => "trim|max_length[100]",
        ],
        "division" => [
            "label" => "SoilTestLabs.division",
            "rules" => "trim|max_length[100]",
        ],
        "email_address" => [
            "label" => "SoilTestLabs.emailAddress",
            "rules" => "trim|max_length[211]|valid_email|permit_empty",
        ],
        "first_name" => [
            "label" => "SoilTestLabs.firstName",
            "rules" => "trim|max_length[211]",
        ],
        "invoice_prefix" => [
            "label" => "SoilTestLabs.invoicePrefix",
            "rules" => "trim|required|max_length[40]",
        ],
        "last_name" => [
            "label" => "SoilTestLabs.lastName",
            "rules" => "trim|max_length[211]",
        ],
        "mobile_number" => [
            "label" => "SoilTestLabs.mobileNumber",
            "rules" => "trim|max_length[20]",
        ],
        "phone_number" => [
            "label" => "SoilTestLabs.phoneNumber",
            "rules" => "trim|max_length[20]",
        ],
        "postcode" => [
            "label" => "SoilTestLabs.postcode",
            "rules" => "trim|max_length[20]",
        ],
        "registration_date" => [
            "label" => "SoilTestLabs.registrationDate",
            "rules" => "valid_date|permit_empty",
        ],
        "state" => [
            "label" => "SoilTestLabs.state",
            "rules" => "trim|max_length[50]",
        ],
        "status" => [
            "label" => "SoilTestLabs.status",
            "rules" => "integer|permit_empty",
        ],
        "street" => [
            "label" => "SoilTestLabs.street",
            "rules" => "trim|max_length[200]",
        ],
        "suburb" => [
            "label" => "SoilTestLabs.suburb",
            "rules" => "trim|max_length[150]",
        ],
    ];

    protected $validationMessages = [
        "abn" => [
            "max_length" => "SoilTestLabs.validation.abn.max_length",
        ],
        "client_id" => [
            "integer" => "SoilTestLabs.validation.client_id.integer",
        ],
        "company" => [
            "max_length" => "SoilTestLabs.validation.company.max_length",
        ],
        "country" => [
            "max_length" => "SoilTestLabs.validation.country.max_length",
        ],
        "division" => [
            "max_length" => "SoilTestLabs.validation.division.max_length",
        ],
        "email_address" => [
            "max_length" => "SoilTestLabs.validation.email_address.max_length",
            "valid_email" => "SoilTestLabs.validation.email_address.valid_email",
        ],
        "first_name" => [
            "max_length" => "SoilTestLabs.validation.first_name.max_length",
        ],
        "invoice_prefix" => [
            "max_length" => "SoilTestLabs.validation.invoice_prefix.max_length",
            "required" => "SoilTestLabs.validation.invoice_prefix.required",
        ],
        "last_name" => [
            "max_length" => "SoilTestLabs.validation.last_name.max_length",
        ],
        "mobile_number" => [
            "max_length" => "SoilTestLabs.validation.mobile_number.max_length",
        ],
        "phone_number" => [
            "max_length" => "SoilTestLabs.validation.phone_number.max_length",
        ],
        "postcode" => [
            "max_length" => "SoilTestLabs.validation.postcode.max_length",
        ],
        "registration_date" => [
            "valid_date" => "SoilTestLabs.validation.registration_date.valid_date",
        ],
        "state" => [
            "max_length" => "SoilTestLabs.validation.state.max_length",
        ],
        "status" => [
            "integer" => "SoilTestLabs.validation.status.integer",
        ],
        "street" => [
            "max_length" => "SoilTestLabs.validation.street.max_length",
        ],
        "suburb" => [
            "max_length" => "SoilTestLabs.validation.suburb.max_length",
        ],
    ];
}
