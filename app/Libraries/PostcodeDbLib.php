<?php namespace App\Libraries;

class PostcodeDbLib
{
    protected $db;

    public function __construct()
    {
        $this->db = \Config\Database::connect();
    }

    public function SuburbState()
    {
        $builder = $this->db->table('postcode_db');
        $builder->select('suburb, state');
        $query = $builder->get();
    
        $results = [];
        foreach ($query->getResultArray() as $row) {
            $results[] = $row['suburb'] . ' - ' . $row['state'];
        }
    
        return $results;
    }
    
}



