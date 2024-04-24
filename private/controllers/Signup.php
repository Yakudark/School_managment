<?php

/**
 * signup controller
 */

class Signup extends Controller
{
    function index()
    {
        if (!Auth::logged_in()) {
            $this->redirect('login');
        }
        $mode = isset($_GET['mode']) ? $_GET['mode'] : '';
        $errors = array();
        if (count($_POST) > 0) {
            $user = new User();

            if ($user->validate($_POST)) {

                $_POST['date'] = date('Y-m-d H:i:s');

                if (Auth::access('Réceptionniste')) {

                    if ($_POST['ranks'] == 'Super Admin' && $_SESSION['USER']->rank != 'Super Admin') {
                        $_POST['ranks'] = 'Admin';
                    }
                    $user->insert($_POST);
                }

                $redirect = $mode == 'students' ? 'students' : 'users';
                $this->redirect($redirect);
            } else {

                $errors = $user->errors;
            }
        }
        if (Auth::access('Réceptionniste')) {
            $this->view('signup', [
                'errors' => $errors,
                'mode' => $mode,
            ]);
        } else {
            $this->view('access-denied');
        }
    }
}
