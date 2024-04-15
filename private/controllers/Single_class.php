<?php

/**
 * Single_class controller
 */
class Single_class extends Controller
{

   public function index($id = '')
   {
      $errors = array();
      if (!Auth::logged_in()) {
         $this->redirect('login');
      }

      $classes = new Classes_model();
      $row = $classes->first('class_id', $id);

      $crumbs[] = ['Tableau de bord', ''];
      $crumbs[] = ['École', 'classes'];

      if ($row) {
         $crumbs[] = [$row->class, ''];
      }

      $page_tab = isset($_GET['tab']) ? $_GET['tab'] : 'lecturers';
      $lect = new Lecturers_model();

      $results = false;

      if ($page_tab == 'lecturers') {

         // liste des enseignant.e.s
         $query = "select * from class_lecturers where class_id = :class_id && disabled = 0 order by id desc";
         $lecturers = $lect->query($query, ['class_id' => $id]);
         $data['lecturers'] = $lecturers;
      } else if ($page_tab == 'students') {

         // liste des étudiant.e.s
         $query = "select * from class_students where class_id = :class_id && disabled = 0 order by id desc";
         $students = $lect->query($query, ['class_id' => $id]);
         $data['students'] = $students;
      }

      $data['row'] = $row;
      $data['crumbs'] = $crumbs;
      $data['page_tab'] = $page_tab;
      $data['results'] = $results;
      $data['errors'] = $errors;

      $this->view('single-class', $data);
   }

   public function lectureradd($id = '')
   {
      $errors = array();
      if (!Auth::logged_in()) {
         $this->redirect('login');
      }

      $classes = new Classes_model();
      $row = $classes->first('class_id', $id);

      $crumbs[] = ['Tableau de bord', ''];
      $crumbs[] = ['École', 'classes'];

      if ($row) {
         $crumbs[] = [$row->class, ''];
      }

      $page_tab = 'lecturer-add';
      $lect = new Lecturers_model();

      $results = false;

      if (count($_POST) > 0) {


         if (isset($_POST['search'])) {
            if (trim($_POST['name']) != "") {

               // trouver un.e enseignant.e
               $user = new User();
               $name = "%" . trim($_POST['name']) . "%";
               $query = "SELECT * FROM users WHERE (firstname LIKE :fname || lastname LIKE :lname) && ranks = 'enseignant.e' limit 10";
               $results = $user->query($query, ['fname' => $name, 'lname' => $name]);
            } else {
               $errors[] = 'Veuillez entrer un nom';
            }
         } else if (isset($_POST['selected'])) {

            // ajouter un.e enseignant.e
            $query = "select id from class_lecturers where user_id = :user_id && class_id = :class_id && disabled = 0 limit 1";

            if (!$lect->query($query, [
               'user_id' => $_POST['selected'],
               'class_id' => $id
            ])) {
               $arr = array();
               $arr['user_id'] = $_POST['selected'];
               $arr['class_id'] = $id;
               $arr['disabled'] = 0;
               $arr['date'] = date('Y-m-d H:i:s');

               $lect->insert($arr);

               $this->redirect('single_class/' . $id . '?tab=lecturers');
            } else {
               $errors[] = 'Cet enseignant.e est déjà dans la liste';
            }
         }
      }

      $data['row'] = $row;
      $data['crumbs'] = $crumbs;
      $data['page_tab'] = $page_tab;
      $data['results'] = $results;
      $data['errors'] = $errors;

      $this->view('single-class', $data);
   }



   public function lecturerremove($id = '')
   {
      $errors = array();
      if (!Auth::logged_in()) {
         $this->redirect('login');
      }

      $classes = new Classes_model();
      $row = $classes->first('class_id', $id);

      $crumbs[] = ['Tableau de bord', ''];
      $crumbs[] = ['École', 'classes'];

      if ($row) {
         $crumbs[] = [$row->class, ''];
      }

      $page_tab = 'lecturer-remove';
      $lect = new Lecturers_model();

      $results = false;

      if (count($_POST) > 0) {


         if (isset($_POST['search'])) {
            if (trim($_POST['name']) != "") {

               // trouver un.e enseignant.e
               $user = new User();
               $name = "%" . trim($_POST['name']) . "%";
               $query = "SELECT * FROM users WHERE (firstname LIKE :fname || lastname LIKE :lname) && ranks = 'enseignant.e' limit 10";
               $results = $user->query($query, ['fname' => $name, 'lname' => $name]);
            } else {
               $errors[] = 'Veuillez entrer un nom';
            }
         } else if (isset($_POST['selected'])) {

            // ajouter un.e enseignant.e
            $query = "select id from class_lecturers where user_id = :user_id && class_id = :class_id && disabled = 0 limit 1";

            if ($row = $lect->query($query, [
               'user_id' => $_POST['selected'],
               'class_id' => $id
            ])) {
               $arr = array();
               $arr['disabled'] = 1;

               $lect->update($row[0]->id, $arr);

               $this->redirect('single_class/' . $id . '?tab=lecturers');
            } else {
               $errors[] = 'Cet enseignant.e n\'est pas dans la liste';
            }
         }
      }

      $data['row'] = $row;
      $data['crumbs'] = $crumbs;
      $data['page_tab'] = $page_tab;
      $data['results'] = $results;
      $data['errors'] = $errors;

      $this->view('single-class', $data);
   }

   //-----------------------------Students
   public function studentadd($id = '')
   {
      $errors = array();
      if (!Auth::logged_in()) {
         $this->redirect('login');
      }

      $classes = new Classes_model();
      $row = $classes->first('class_id', $id);

      $crumbs[] = ['Tableau de bord', ''];
      $crumbs[] = ['École', 'classes'];

      if ($row) {
         $crumbs[] = [$row->class, ''];
      }

      $page_tab = 'student-add';
      $stud = new Students_model();

      $results = false;

      if (count($_POST) > 0) {


         if (isset($_POST['search'])) {
            if (trim($_POST['name']) != "") {

               // trouver un.e enseignant.e
               $user = new User();
               $name = "%" . trim($_POST['name']) . "%";
               $query = "SELECT * FROM users WHERE (firstname LIKE :fname || lastname LIKE :lname) && ranks = 'étudiant.e' limit 10";
               $results = $user->query($query, ['fname' => $name, 'lname' => $name]);
            } else {
               $errors[] = 'Veuillez entrer un nom';
            }
         } else if (isset($_POST['selected'])) {

            // ajouter un.e enseignant.e
            $query = "select id from class_students where user_id = :user_id && class_id = :class_id && disabled = 0 limit 1";

            if (!$stud->query($query, [
               'user_id' => $_POST['selected'],
               'class_id' => $id
            ])) {
               $arr = array();
               $arr['user_id'] = $_POST['selected'];
               $arr['class_id'] = $id;
               $arr['disabled'] = 0;
               $arr['date'] = date('Y-m-d H:i:s');

               $stud->insert($arr);

               $this->redirect('single_class/' . $id . '?tab=students');
            } else {
               $errors[] = 'Cet.te étudiant.e est déjà dans la liste';
            }
         }
      }

      $data['row'] = $row;
      $data['crumbs'] = $crumbs;
      $data['page_tab'] = $page_tab;
      $data['results'] = $results;
      $data['errors'] = $errors;

      $this->view('single-class', $data);
   }

   public function studentremove($id = '')
   {
      $errors = array();
      if (!Auth::logged_in()) {
         $this->redirect('login');
      }

      $classes = new Classes_model();
      $row = $classes->first('class_id', $id);

      $crumbs[] = ['Tableau de bord', ''];
      $crumbs[] = ['École', 'classes'];

      if ($row) {
         $crumbs[] = [$row->class, ''];
      }

      $page_tab = 'student-remove';
      $stud = new Students_model();

      $results = false;

      if (count($_POST) > 0) {


         if (isset($_POST['search'])) {
            if (trim($_POST['name']) != "") {

               // trouver un.e étudiant.e
               $user = new User();
               $name = "%" . trim($_POST['name']) . "%";
               $query = "SELECT * FROM users WHERE (firstname LIKE :fname || lastname LIKE :lname) && ranks = 'étudiant.e' limit 10";
               $results = $user->query($query, ['fname' => $name, 'lname' => $name]);
            } else {
               $errors[] = 'Veuillez entrer un nom';
            }
         } else if (isset($_POST['selected'])) {

            // ajouter un.e étudiant.e
            $query = "select id from class_students where user_id = :user_id && class_id = :class_id && disabled = 0 limit 1";

            if ($row = $stud->query($query, [
               'user_id' => $_POST['selected'],
               'class_id' => $id
            ])) {
               $arr = array();
               $arr['disabled'] = 1;

               $stud->update($row[0]->id, $arr);

               $this->redirect('single_class/' . $id . '?tab=students');
            } else {
               $errors[] = 'Cet.te étudiant.e n\'est pas dans la liste';
            }
         }
      }

      $data['row'] = $row;
      $data['crumbs'] = $crumbs;
      $data['page_tab'] = $page_tab;
      $data['results'] = $results;
      $data['errors'] = $errors;

      $this->view('single-class', $data);
   }
}
