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

      $limit = 10;
      $pager = new Pager($limit);
      $offset = $pager->offset;


      $query = "select * from users where school_id = :school_id && ranks in ('étudiant.e') order by id desc limit $limit offset $offset";
      $arr['school_id'] = $school_id;

      if (isset($_GET['find'])) {
         $find = '%' . $_GET['find'] . '%';
         $query = "select * from users where school_id = :school_id && ranks in ('étudiant.e') && (firstname like :find || lastname like :find) order by id desc limit $limit offset $offset";
         $arr['find'] = $find;
      }
      $data = $user->query($query, $arr);

      $crumbs[] = ['Tableau de bord', ROOT . '/home'];
      $crumbs[] = ['Étudiants', ROOT . '/students'];

      if (Auth::access('Réceptionniste')) {
         $this->view('students', [
            'rows' => $data,
            'crumbs' => $crumbs,
            'pager' => $pager

         ]);
      } else {
         $this->view('access-denied');
      }
   }
}
