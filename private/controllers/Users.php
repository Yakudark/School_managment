<?php

/**
 * users controller
 */

class Users extends Controller
{
   function index()
   {
      if (!Auth::check()) {
         $this->redirect('login');
      }
      $user = new User();
      $school_id = Auth::getSchool_id();
      $data = $user->query("select * from users where school_id = :school_id && ranks not in ('étudiant.e') order by id desc", ['school_id' => $school_id]);

      $crumbs[] = ['Tableau de bord', ''];
      $crumbs[] = ['Personnel', 'users'];

      if (Auth::access('Administrateur.trice')) {
         $this->view('users', [
            'rows' => $data,
            'crumbs' => $crumbs,
         ]);
      } else {
         $this->view('access-denied');
      }
   }
}
