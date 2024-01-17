<?php
namespace App\Models\Admin;

class FertilzerCompanyModel extends \App\Models\GoBaseModel
{
    protected $table = "fertilzer_companies";

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
        "updated_at",
    ];
    protected $returnType = "App\Entities\Admin\FertilzerCompany";

    public static $labelField = "company";

    protected $validationRules = [
        "abn" => [
            "label" => "FertilzerCompanies.abn",
            "rules" => "trim|max_length[100]",
        ],
        "client_id" => [
            "label" => "FertilzerCompanies.clientId",
            "rules" => "integer|permit_empty",
        ],
        "company" => [
            "label" => "FertilzerCompanies.company",
            "rules" => "trim|max_length[300]",
        ],
        "country" => [
            "label" => "FertilzerCompanies.country",
            "rules" => "trim|max_length[100]",
        ],
        "division" => [
            "label" => "FertilzerCompanies.division",
            "rules" => "trim|max_length[100]",
        ],
        "email_address" => [
            "label" => "FertilzerCompanies.emailAddress",
            "rules" => "trim|max_length[211]|valid_email|permit_empty",
        ],
        "first_name" => [
            "label" => "FertilzerCompanies.firstName",
            "rules" => "trim|max_length[211]",
        ],
        "invoice_prefix" => [
            "label" => "FertilzerCompanies.invoicePrefix",
            "rules" => "trim|required|max_length[40]",
        ],
        "last_name" => [
            "label" => "FertilzerCompanies.lastName",
            "rules" => "trim|max_length[211]",
        ],
        "mobile_number" => [
            "label" => "FertilzerCompanies.mobileNumber",
            "rules" => "trim|max_length[20]",
        ],
        "phone_number" => [
            "label" => "FertilzerCompanies.phoneNumber",
            "rules" => "trim|max_length[20]",
        ],
        "postcode" => [
            "label" => "FertilzerCompanies.postcode",
            "rules" => "trim|max_length[20]",
        ],
        "registration_date" => [
            "label" => "FertilzerCompanies.registrationDate",
            "rules" => "valid_date|permit_empty",
        ],
        "state" => [
            "label" => "FertilzerCompanies.state",
            "rules" => "trim|max_length[50]",
        ],
        "status" => [
            "label" => "FertilzerCompanies.status",
            "rules" => "integer|permit_empty",
        ],
        "street" => [
            "label" => "FertilzerCompanies.street",
            "rules" => "trim|max_length[200]",
        ],
        "suburb" => [
            "label" => "FertilzerCompanies.suburb",
            "rules" => "trim|max_length[150]",
        ],
        "updated_at" => [
            "label" => "FertilzerCompanies.updatedAt",
            "rules" => "max_length[20]",
        ],
    ];

    protected $validationMessages = [
        "abn" => [
            "max_length" => "FertilzerCompanies.validation.abn.max_length",
        ],
        "client_id" => [
            "integer" => "FertilzerCompanies.validation.client_id.integer",
        ],
        "company" => [
            "max_length" => "FertilzerCompanies.validation.company.max_length",
        ],
        "country" => [
            "max_length" => "FertilzerCompanies.validation.country.max_length",
        ],
        "division" => [
            "max_length" => "FertilzerCompanies.validation.division.max_length",
        ],
        "email_address" => [
            "max_length" => "FertilzerCompanies.validation.email_address.max_length",
            "valid_email" => "FertilzerCompanies.validation.email_address.valid_email",
        ],
        "first_name" => [
            "max_length" => "FertilzerCompanies.validation.first_name.max_length",
        ],
        "invoice_prefix" => [
            "max_length" => "FertilzerCompanies.validation.invoice_prefix.max_length",
            "required" => "FertilzerCompanies.validation.invoice_prefix.required",
        ],
        "last_name" => [
            "max_length" => "FertilzerCompanies.validation.last_name.max_length",
        ],
        "mobile_number" => [
            "max_length" => "FertilzerCompanies.validation.mobile_number.max_length",
        ],
        "phone_number" => [
            "max_length" => "FertilzerCompanies.validation.phone_number.max_length",
        ],
        "postcode" => [
            "max_length" => "FertilzerCompanies.validation.postcode.max_length",
        ],
        "registration_date" => [
            "valid_date" => "FertilzerCompanies.validation.registration_date.valid_date",
        ],
        "state" => [
            "max_length" => "FertilzerCompanies.validation.state.max_length",
        ],
        "status" => [
            "integer" => "FertilzerCompanies.validation.status.integer",
        ],
        "street" => [
            "max_length" => "FertilzerCompanies.validation.street.max_length",
        ],
        "suburb" => [
            "max_length" => "FertilzerCompanies.validation.suburb.max_length",
        ],
        "updated_at" => [
            "max_length" => "FertilzerCompanies.validation.updated_at.max_length",
        ],
    ];
}
