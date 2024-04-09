<?php

/**
 * Single_class controller
 */

class Single_class extends Controller
{
   function index($id = '')
   {
      $classes = new Classes_model();
      $row = $classes->first('class_id', $id);

      $crumbs[] = ['Tableau de bord', ''];
      $crumbs[] = ['Discipline', 'classes'];

      if ($row) {
         $crumbs[] = [$row->class, ''];
      }

      $page_tab = isset($_GET['tab']) ? $_GET['tab'] : 'lecturers';

      $results = false;
      if ($page_tab == 'lecturers-add' && count($_POST) > 0) {
         // ajouter un.e enseignant.e
         $user = new User();
         $name = "%" . $_POST['name'] . "%";
         $query = "SELECT * FROM users WHERE firstname LIKE :fname || lastname LIKE :lname limit 10";
         $results = $user->query($query, ['fname' => $name, 'lname' => $name]);
      }
      $this->view('single-class', [
         'row' => $row,
         'crumbs' => $crumbs,
         'page_tab' => $page_tab,
         'results' => $results,
      ]);
   }
}
