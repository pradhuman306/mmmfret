<?php
namespace App\Models;

class UserModel extends \Myth\Auth\Models\UserModel
{
    protected $table = "users";

    /**
     * Whether primary key uses auto increment.
     *
     * @var bool
     */
    protected $useAutoIncrement = true;

    protected $allowedFields = [
        "email",
        "username",
        "first_name",
        "last_name",
        "primary_phone",
        "password_hash",
        "active",
        "reset_hash",
        "reset_at",
        "reset_expires",
        "activate_hash",
        "status",
        "status_message",
        "force_pass_reset",
        "permissions",
        "deleted_at",
    ];

    protected $validationRules = [
        "id" => "permit_empty",
        "email" => "required|valid_email|is_unique[users.email,id,{id}]",
        "username" => "required|alpha_numeric_punct|min_length[3]|max_length[30]|is_unique[users.username,id,{id}]",
    ];

    protected $returnType = "App\Entities\User";

    public static $labelField = "username";

    /**
     * Returns the number of rows in the database table
     *
     * @return int
     */
    public function getCount()
    {
        $name = $this->table;
        $count = $this->db->table($name)->countAll();
        return $count;
    }

    /**
     * @param string $columns2select
     * @param string $resultSorting
     * @param bool $onlyActiveOnes
     * @param bool $alsoDeletedOnes
     * @param array $additionalConditions
     * @return array
     */
    public function getAllForMenu(
        $columns2select = "*",
        $resultSorting = "id",
        bool $onlyActiveOnes = false,
        bool $alsoDeletedOnes = true,
        $additionalConditions = []
    ) {
        $theseConditionsAreMet = [];

        if ($onlyActiveOnes) {
            if (in_array("enabled", $this->allowedFields)) {
                $theseConditionsAreMet["enabled"] = true;
            } elseif (in_array("active", $this->allowedFields)) {
                $theseConditionsAreMet["active"] = true;
            }
        }

        // This check is deprecated and left here only for backward compatibility and this method should be overridden in extending classes so as to check if the bound entity class has these attributes
        if (!$alsoDeletedOnes) {
            if (in_array("deleted_at", $this->allowedFields)) {
                $theseConditionsAreMet["deleted_at"] = null;
            }
            if (in_array("deleted", $this->allowedFields)) {
                $theseConditionsAreMet["deleted"] = false;
            }
            if (in_array("date_time_deleted", $this->allowedFields)) {
                $theseConditionsAreMet["date_time_deleted"] = null;
            }
        }

        if (!empty($additionalConditions)) {
            $theseConditionsAreMet = array_merge($theseConditionsAreMet, $additionalConditions);
        }
        $queryBuilder = $this->db->table($this->table);
        $queryBuilder->select($columns2select);
        if (!empty($theseConditionsAreMet)) {
            $queryBuilder->where($theseConditionsAreMet);
        }
        $queryBuilder->orderBy($resultSorting);
        $result = $queryBuilder->get()->getResult();

        return $result;
    }

        public function getUserTimeZone($userId)
    {
        $user = $this->find($userId);
        if ($user && !empty($user->timezone)) {
            return $user->timezone;
        } else {
            // Return a default time zone if user not found or timezone not set
            return 'UTC';
        }
    }

    /**
     *
     * @param mixed $columns2select either array or string
     * @param mixed $sortResultsBy  either string or array
     * @param bool $onlyActiveOnes
     * @param string $select1str e.g. 'Please select one...'
     * @param bool $alsoDeletedOnes
     * @param array $additionalConditions
     * @return array for use in dropdown menus
     */
    public function getAllForCiMenu(
        $columns2select = ["id", "designation"],
        $sortResultsBy = "id",
        bool $onlyActiveOnes = false,
        $selectionRequestLabel = "Please select one...",
        bool $alsoDeletedOnes = true,
        $additionalConditions = []
    ) {
        $ciDropDownOptions = [];

        if (is_array($columns2select) && count($columns2select) >= 2) {
            $key = $columns2select[0];
            $val = $columns2select[1];

            $cols2selectStr = implode(",", $columns2select);

            $valInd = strpos($val, " AS ");
            if ($valInd !== false) {
                $val = substr($val, $valInd + 4);
            }
        } elseif (is_string($columns2select) && strpos($columns2select, ",") !== false) {
            $cols2selectStr = $columns2select;

            $arr = explode(",", $columns2select, 2);
            $key = trim($arr[0]);
            $val = trim($arr[1]);
        } else {
            return ["error" => "Invalid argument for columns/fields to select"];
        }

        $resultList = $this->getAllForMenu(
            $cols2selectStr,
            $sortResultsBy,
            $onlyActiveOnes,
            $alsoDeletedOnes,
            $additionalConditions
        );

        if ($resultList != false) {
            if (!empty($selectionRequestLabel)) {
                $ciDropDownOptions[""] = $selectionRequestLabel;
            }

            foreach ($resultList as $res) {
                if (isset($res->$key) && isset($res->$val)) {
                    $ciDropDownOptions[$res->$key] = $res->$val;
                }
            }
        }

        return $ciDropDownOptions;
    }

    /**
     * @param array|string[] $columns2select
     * @param | $resultSorting
     * @param bool|bool $onlyActiveOnes
     * @param | $searchStr
     * @return array
     */
    public function getSelect2MenuItems(
        array $columns2select = ["id", "designation"],
        $resultSorting = null,
        bool $onlyActiveOnes = true,
        $searchStr = null
    ) {
        $theseConditionsAreMet = [];

        $id = $columns2select[0] . " AS id";
        $text = $columns2select[1] . " AS text";

        if (empty($resultSorting)) {
            $resultSorting = $this->getPrimaryKeyName();
        }

        if ($onlyActiveOnes) {
            if (in_array("enabled", $this->allowedFields)) {
                $theseConditionsAreMet["enabled"] = true;
            } elseif (in_array("active", $this->allowedFields)) {
                $theseConditionsAreMet["active"] = true;
            }
        }

        $queryBuilder = $this->db->table($this->table);
        $queryBuilder->select([$id, $text]);
        $queryBuilder->where($theseConditionsAreMet);
        if (!empty($searchStr)) {
            $queryBuilder
                ->groupStart()
                ->like($columns2select[0], $searchStr)
                ->orLike($columns2select[1], $searchStr)
                ->groupEnd();
        }
        $queryBuilder->orderBy($resultSorting);
        $result = $queryBuilder->get()->getResult();

        return $result;
    }
}
