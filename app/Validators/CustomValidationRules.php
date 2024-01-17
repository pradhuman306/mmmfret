namespace App\Validators;

use CodeIgniter\HTTP\RequestInterface;

class CustomValidationRules
{
    public function is_unique_edit(string $str, string $fields, array $data, string $error = null, RequestInterface $request = null)
    {
        $fields = explode(',', $fields);

        if (count($fields) !== 2) {
            return false;
        }

        list($table, $column) = $fields;

        // Get the current record's ID from the data array
        $currentId = $data[$fields[1]];

        $model = model($table);

        // Check if any record other than the current one has the same value
        $result = $model->where([$column => $str])->where('id !=', $currentId)->first();

        return empty($result);
    }
}
