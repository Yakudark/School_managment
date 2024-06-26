
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
        'gender',
        'ranks',
        'date',
        'image',
        'school_id',
    ];

    protected $beforeInsert = [
        'make_user_id',
        'make_school_id',
        'hash_password'
    ];
    protected $beforeUpdate = [
        'hash_password'
    ];

    public function validate($DATA, $id = '')
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

        // vérification de l'unicité de l'email
        if (trim($id) == "") {
            if ($this->where('email', $DATA['email'])) {
                $this->errors['email'] = "L'email est déjà utilisé";
            }
        } else {
            if ($this->query("select email from $this->table where email = :email && user_id != :id", ['email' => $DATA['email'], 'id' => $id])) {
                $this->errors['email'] = "L'email est déjà utilisé";
            }
        }

        // vérification des mots de passe
        if (isset($DATA['password'])) {

            if (empty($DATA['password']) || ($DATA['password'] !== $DATA['password2'])) {
                $this->errors['password'] = "Les mots de passe ne correspondent pas";
            }

            // vérification de la longueur des mots de passe
            if (strlen($DATA['password']) < 4) {
                $this->errors['password'] = "Le mot de passe doit contenir au moins 4 caractères";
            }
        }

        // vérification du genre
        $genders = ['Homme', 'Femme'];
        if (empty($DATA['gender']) || !in_array($DATA['gender'], $genders)) {
            $this->errors['gender'] = "Le genre n'est pas valide";
        }

        // vérification du rang
        $ranks = ['Étudiant.e', 'Réceptionniste', 'Enseignant.e', 'Admin', 'Super Admin'];
        if (empty($DATA['ranks']) || !in_array($DATA['ranks'], $ranks)) {
            $this->errors['ranks'] = "Le statut n'est pas valide";
        }

        if (count($this->errors) == 0) {
            return true;
        }
        return false;
    }

    public function make_user_id($data)
    {
        $data['user_id'] = strtolower($data['firstname'] . "." . $data['lastname']);

        while ($this->where('user_id', $data['user_id'])) {
            $data['user_id'] .= rand(10, 9999);
        }
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
        if (isset($data['password'])) {
            $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
        }
        return $data;
    }
}
