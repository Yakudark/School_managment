<?php

/**
 * User model
 */
class User extends Model
{
    protected $table = 'users';
    protected $allowedColumns = [
        'firstname',
        'lastname',
        'email',
        'password',
        'ranks',
        'gender',
        'date',
    ];

    protected $beforeInsert = [
        'make_user_id',
        'make_school_id',
        'hash_password'
    ];

    public function validate($DATA)
    {

        $this->errors = array();

        // vérification du nom
        if (empty($DATA['firstname']) || !preg_match('/^[a-zA-Z]+$/', $DATA['firstname'])) {
            $this->errors['firstname'] = "Seules les lettres sont autorisés pour le prénom";
        }
        // vérification du prénom
        if (empty($DATA['lastname']) || !preg_match('/^[a-zA-Z]+$/', $DATA['lastname'])) {
            $this->errors['lastname'] = "Seules les lettres sont autorisés pour le nom";
        }

        // vérification de l'email
        if (empty($DATA['email']) || !filter_var($DATA['email'], FILTER_VALIDATE_EMAIL)) {
            $this->errors['email'] = "L'email n'est pas valide";
        }

        // vérification du genre
        $genders = ['male', 'female', 'other', 'wont'];
        if (empty($DATA['gender']) || !in_array($DATA['gender'], $genders)) {
            $this->errors['gender'] = "Le genre n'est pas valide";
        }

        // vérification du rang
        $ranks = ['student', 'reception', 'lecturer', 'admin', 'super_admin'];
        if (empty($DATA['ranks']) || !in_array($DATA['ranks'], $ranks)) {
            $this->errors['ranks'] = "Le rang n'est pas valide";
        }


        // vérification des mots de passe
        if (empty($DATA['password']) || ($DATA['password'] !== $DATA['password2'])) {
            $this->errors['password'] = "Les mots de passe ne correspondent pas";
        }

        // vérification de la longueur des mots de passe
        if (strlen($DATA['password']) < 4) {
            $this->errors['password'] = "Le mot de passe doit contenir au moins 4 caractères";
        }

        if (count($this->errors) == 0) {
            return true;
        }
        return false;
    }

    public function make_user_id($data)
    {
        $data['user_id'] = $this->random_string(60);
        return $data;
    }

    public function make_school_id($data)
    {
        if (isset($_SESSION['USER']->school_id)) {
            $data['school_id'] = $_SESSION['USER']->school_id;
        }
        return $data;
    }

    public function hash_password($data)
    {
        $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
        return $data;
    }

    private function random_string($length)
    {
        $array = array(
            0, 1, 2, 3, 4, 5, 6, 7, 8, 9,
            'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j',
            'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't',
            'u', 'v', 'w', 'x', 'y', 'z', 'A', 'B', 'C', 'D',
            'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N',
            'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X',
            'Y', 'Z'
        );
        $text = "";

        for ($x = 0; $x < $length; $x++) {
            $random = rand(0, 61);
            $text .= $array[$random];
        }
        return $text;
    }
}
