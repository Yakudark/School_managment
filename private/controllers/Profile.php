<?php

/**
 * home controller
 */
class Profile extends Controller
{

   function index($id = '')
   {

      if (!Auth::logged_in()) {
         $this->redirect('login');
      }

      $user = new User();
      $id = trim($id == '') ? Auth::getUser_id() : $id;

      $row = $user->first('user_id', $id);

      $crumbs[] = ['Dashboard', ''];
      $crumbs[] = ['profile', 'profile'];
      if ($row) {
         $crumbs[] = [$row->firstname, 'profile'];
      }

      //plus d'info sur l'onglet actif
      $data['page_tab'] = isset($_GET['tab']) ? $_GET['tab'] : 'info';

      if ($data['page_tab'] == 'classes' && $row) {

         $class = new Classes_model();

         $mytable = "class_students";
         if ($row->ranks == "Enseignant.e") {
            $mytable = "class_lecturers";
         }

         $query = "select * from $mytable where user_id = :user_id && disabled = 0";
         $data['stud_classes'] = $class->query($query, ['user_id' => $id]);

         $data['student_classes'] = array();
         if ($data['stud_classes']) {
            foreach ($data['stud_classes'] as $key => $arow) {
               $data['student_classes'][] = $class->first('class_id', $arow->class_id);
            }
         }
      }
      $data['row'] = $row;
      $data['crumbs'] = $crumbs;

      if (Auth::access('Réceptionniste') || Auth::i_own_content($row)) {
         $this->view('profile', $data);
      } else {
         $this->view('access-denied');
      }
   }

   function edit($id = '')
   {
      if (!Auth::logged_in()) {
         $this->redirect('login');
      }
$errors = array();

      $user = new User();
      $id = trim($id == '') ? Auth::getUser_id() : $id;

      $row = $user->first('user_id', $id);
      $data['row'] = $row;
      $data['errors'] = $errors;

      if (Auth::access('Réceptionniste') || Auth::i_own_content($row)) {
         $this->view('profile-edit', $data);
      } else {
         $this->view('access-denied');
      }
   }
}
