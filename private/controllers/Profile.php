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

      if (count($_POST) > 0 && Auth::access('Réceptionniste')) {

         //vérification si les mots de passe existent
         if (trim($_POST['password']) == "") {
            unset($_POST['password']);
            unset($_POST['password2']);
         }

         if ($user->validate($_POST, $id)) {

            if (count($_FILES) > 0) {

               $allowed[] = "image/jpeg";
               $allowed[] = "image/png";

               if ($_FILES['image']['error'] == 0 && in_array($_FILES['image']['type'], $allowed)) {
                  $folder = "uploads/";
                  if (!file_exists($folder)) {
                     mkdir($folder, 0777, true);
                  }
                  $destination = $folder . $_FILES['image']['name'];
                  move_uploaded_file($_FILES['image']['tmp_name'], $destination);
                  $_POST['image'] = $destination;
               }
            }
            if ($_POST['ranks'] == 'Super Admin' && $_SESSION['USER']->rank != 'Super Admin') {
               $_POST['ranks'] = 'Admin';
            }

            $myrow = $user->first('user_id', $id);
            if (is_object($myrow)) {
               $user->update($myrow->id, $_POST);
            }

            $redirect = 'profile/edit/' . $id;
            $this->redirect($redirect);
         } else {

            $errors = $user->errors;
         }
      }

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
