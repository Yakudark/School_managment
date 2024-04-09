<?php

/**
 * Authentification class

 */
class Auth
{
    public static function authenticate($row)
    {
        $_SESSION['USER'] = $row;
    }


    public static function logout()
    {
        if (isset($_SESSION['USER'])) {
            unset($_SESSION['USER']);
        }
    }

    public static function check()
    {
        if (isset($_SESSION['USER'])) {
            return true;
        }
        return false;
    }

    public static function user()
    {
        if (isset($_SESSION['USER'])) {
            return $_SESSION['USER']->firstname;
        }
        return false;
    }

    public static function __callStatic($method, $params)
    {
        $prop = strtolower(str_replace("get", "", $method));
        if (isset($_SESSION['USER']->$prop)) {
            return $_SESSION['USER']->$prop;
        }
        return 'Inconnu';
    }

    public static function switch_school($id)
    {
        if (isset($_SESSION['USER']) && $_SESSION['USER']->ranks == 'Super Administrateur.trice') {
            $user = new User();
            $school = new School();

            if ($row = $school->where('id', $id)) {
                $row = $row[0];
                $arr['school_id'] = $row->school_id;

                $user->update($_SESSION['USER']->id, $arr);
                $_SESSION['USER']->school_id = $row->school_id;
                $_SESSION['USER']->school_name = $row->school;
            }

            return true;
        }
        return false;
    }
}
