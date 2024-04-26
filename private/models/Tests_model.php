<?php

/**
 * Tests model
 */
class Tests_model extends Model
{
    protected $table = 'tests';
    protected $allowedColumns = [
        'test',
        'date',
        'class_id',
        'description',
        'disabled',
    ];

    protected $beforeInsert = [
        'make_school_id',
        'make_test_id',
        'make_user_id',
    ];

    protected $afterSelect = [
        'get_user',
    ];

    public function validate($DATA)
    {

        $this->errors = array();

        // vérification du nom de l'évaluation
        if (empty($DATA['test']) || !preg_match('/^[a-z A-Z0-9àáâãäåçèéêëìíîïðòóôõöùúûüýÿ]+$/', $DATA['test'])) {
            $this->errors['test'] = "Seules les lettres et les chiffres sont autorisées pour le nom de l'évaluation";
        }

        if (count($this->errors) == 0) {
            return true;
        }
        return false;
    }

    public function make_school_id($data)
    {
        if (isset($_SESSION['USER']->school_id)) {
            $data['school_id'] = $_SESSION['USER']->school_id;
        }
        return $data;
    }
    public function make_user_id($data)
    {
        if (isset($_SESSION['USER']->user_id)) {
            $data['user_id'] = $_SESSION['USER']->user_id;
        }
        return $data;
    }

    public function make_test_id($data)
    {
        $data['test_id'] = random_string(60);
        return $data;
    }

    public function get_user($data)
    {
        $user = new User();
        foreach ($data as $key => $row) {
            $result = $user->where('user_id', $row->user_id);
            $data[$key]->user = is_array($result) ? $result[0] : false;
        }
        return $data;
    }
}
