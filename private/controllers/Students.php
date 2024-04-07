<?php

/**
 * students controller
 */

class Students extends Controller
{
   function index()
   {
      if (!Auth::check()) {
         $this->redirect('login');
      }
      $user = new User();
      $school_id = Auth::getSchool_id();
      $data = $user->query("select * from users where school_id = :school_id && ranks in ('étudiant.e') order by id desc", ['school_id' => $school_id]);

      $crumbs[] = ['Tableau de bord', ''];
      $crumbs[] = ['Étudiants', 'students'];

      $this->view('students', [
         'rows' => $data,
         'crumbs' => $crumbs,

      ]);
   }
}
