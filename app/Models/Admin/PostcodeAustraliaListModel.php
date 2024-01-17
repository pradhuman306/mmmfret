<?php
namespace App\Models\Admin;

class PostcodeAustraliaListModel extends \App\Models\GoBaseModel
{
    protected $table = "postcode_australia_list";

    /**
     * Whether primary key uses auto increment.
     *
     * @var bool
     */
    protected $useAutoIncrement = true;

    const SORTABLE = [
        1 => "t1.id",
        2 => "t1.timezone",
        3 => "t1.state",
        4 => "t1.suburb",
        5 => "t1.postcode",
        6 => "t1.country",
        7 => "t2.timezone",
        8 => "t3.state",
    ];

    protected $allowedFields = [
        "timezone",
        "state",
        "suburb",
        "postcode",
        "country",
        "lon",
        "lat",
        "created_by",
         "updated_by",
    ];
    protected $returnType = "App\Entities\Admin\PostcodeAustraliaList";

    protected $useTimestamps = true;
    protected $useSoftDeletes = true;

    protected $createdField = "created_at";

    protected $updatedField = "updated_at";

    public static $labelField = "suburb";

    protected $validationRules = [
        "country" => [
            "label" => "PostcodeAustraliaLists.country",
            "rules" => "trim|max_length[150]",
        ],
        "created_at" => [
            "label" => "PostcodeAustraliaLists.createdAt",
            "rules" => "max_length[20]",
        ],
        "created_by" => [
            "label" => "PostcodeAustraliaLists.createdBy",
            "rules" => "trim|max_length[120]",
        ],
        "lat" => [
            "label" => "PostcodeAustraliaLists.lat",
            "rules" => "decimal|permit_empty",
        ],
        "lon" => [
            "label" => "PostcodeAustraliaLists.lon",
            "rules" => "decimal|permit_empty",
        ],
        "postcode" => [
            "label" => "PostcodeAustraliaLists.postcode",
            "rules" => "trim|max_length[20]",
        ],
        "suburb" => [
            "label" => "PostcodeAustraliaLists.suburb",
            "rules" => "trim|max_length[100]",
        ],
        "updated_at" => [
            "label" => "PostcodeAustraliaLists.updatedAt",
            "rules" => "max_length[20]",
        ],
        "updated_by" => [
            "label" => "PostcodeAustraliaLists.updatedBy",
            "rules" => "trim|max_length[120]",
        ],
    ];

    protected $validationMessages = [
        "country" => [
            "max_length" => "PostcodeAustraliaLists.validation.country.max_length",
        ],
        "created_at" => [
            "max_length" => "PostcodeAustraliaLists.validation.created_at.max_length",
        ],
        "created_by" => [
            "max_length" => "PostcodeAustraliaLists.validation.created_by.max_length",
        ],
        "lat" => [
            "decimal" => "PostcodeAustraliaLists.validation.lat.decimal",
        ],
        "lon" => [
            "decimal" => "PostcodeAustraliaLists.validation.lon.decimal",
        ],
        "postcode" => [
            "max_length" => "PostcodeAustraliaLists.validation.postcode.max_length",
        ],
        "suburb" => [
            "max_length" => "PostcodeAustraliaLists.validation.suburb.max_length",
        ],
        "updated_at" => [
            "max_length" => "PostcodeAustraliaLists.validation.updated_at.max_length",
        ],
        "updated_by" => [
            "max_length" => "PostcodeAustraliaLists.validation.updated_by.max_length",
        ],
    ];
    public function findAllWithAllRelations(string $selcols = "*", int $limit = null, int $offset = 0)
    {
        $sql =
            "SELECT t1." .
            $selcols .
            ",  t2.timezone AS timezone,  t3.state AS state FROM " .
            $this->table .
            " t1  LEFT JOIN timezone t2 ON t1.timezone = t2.id LEFT JOIN state t3 ON t1.state = t3.state_id";
        if (!is_null($limit) && intval($limit) > 0) {
            $sql .= " LIMIT " . intval($limit);
        }

        if (!is_null($offset) && intval($offset) > 0) {
            $sql .= " OFFSET " . intval($offset);
        }

        $query = $this->db->query($sql);
        $result = $query->getResultObject();
        return $result;
    }

    public function getstatebytimezone(int $id)
    {
        $sql =
            "SELECT timezone.*,state.*
            FROM timezone
            INNER JOIN state
            ON timezone.state_id = state.state_id
            WHERE timezone.id = $id";

        $query = $this->db->query($sql);
        $result = $query->getResultObject();
        return $result;
    }

    public function getSelect2MenuItemsBystate($statenumber,array $columns2select = ['id', 'designation'], $resultSorting=null, bool $onlyActiveOnes=true, $searchStr = null) {

        $theseConditionsAreMet = [];

        $id = $columns2select[0].' AS id';
        $text = $columns2select[1].' AS text';

        if (empty($resultSorting)) {
            $resultSorting = $this->getPrimaryKeyName();
        }

        if ($onlyActiveOnes) {
            if ( in_array('enabled', $this->allowedFields) ) {
                $theseConditionsAreMet['enabled'] = true;
            } elseif (in_array('active', $this->allowedFields)) {
                $theseConditionsAreMet['active'] = true;
            }
        }

        $queryBuilder = $this->db->table($this->table);
        $queryBuilder->select([$id, $text,'postcode','country','lat','lon']);
        $queryBuilder->where($theseConditionsAreMet);
        if($statenumber){
            $queryBuilder->where('state',$statenumber);
            }
        if (!empty($searchStr)) {
            $queryBuilder->groupStart()
                ->like($columns2select[0], $searchStr)
                ->orLike($columns2select[1], $searchStr)
                ->groupEnd();
        }
        $queryBuilder->orderBy($resultSorting);
        $result =  $queryBuilder->get()->getResult();

        return $result;
    }

    /**
     * Get resource data.
     *
     * @param string $search
     *
     * @return \CodeIgniter\Database\BaseBuilder
     */
    public function getResource(string $search = "")
    {
        $builder = $this->db->table($this->table . " t1")->select("t1.id AS id, t1.suburb AS suburb, t1.postcode AS postcode, t1.country AS country, t2.timezone AS timezone, t3.state AS state")->where('t1.deleted_at', null);;
        $builder->join("timezone t2", "t1.timezone = t2.id", "left");
        $builder->join("state t3", "t1.state = t3.state_id", "left");

        return empty($search)
            ? $builder
            : $builder
                ->groupStart()
                ->like("t1.id", $search)
                ->orLike("t1.suburb", $search)
                ->orLike("t1.postcode", $search)
                ->orLike("t1.country", $search)
                ->orLike("t2.id", $search)
                ->orLike("t3.state_id", $search)
                ->orLike("t1.id", $search)
                ->orLike("t1.timezone", $search)
                ->orLike("t1.state", $search)
                ->orLike("t1.suburb", $search)
                ->orLike("t1.postcode", $search)
                ->orLike("t1.country", $search)
                ->orLike("t2.timezone", $search)
                ->orLike("t3.state", $search)
                ->groupEnd();
    }
}
