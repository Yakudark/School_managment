
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

        // vérification de l'unicité de l'email
        if ($this->where('email', $DATA['email'])) {
            $this->errors['email'] = "L'email est déjà utilisé";
        }

        // vérification du genre
        $genders = ['Homme', 'Femme'];
        if (empty($DATA['gender']) || !in_array($DATA['gender'], $genders)) {
            $this->errors['gender'] = "Le genre n'est pas valide";
        }

        // vérification du rang
        $ranks = ['Étudiant.e', 'Réceptionniste', 'Enseignant.e', 'Administrateur.trice', 'Super Administrateur.trice'];
        if (empty($DATA['ranks']) || !in_array($DATA['ranks'], $ranks)) {
            $this->errors['ranks'] = "Le statut n'est pas valide";
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
        $data['user_id'] = random_string(60);
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
}
