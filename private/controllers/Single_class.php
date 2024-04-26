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

      $crumbs[] = ['Tableau de bord', ROOT . '/home'];
      $crumbs[] = ['Cours', ROOT . '/classes'];

      if ($row) {
         $crumbs[] = [$row->class, ''];
      }
      $limit = 10;
      $pager = new Pager($limit);
      $offset = $pager->offset;

      $page_tab = isset($_GET['tab']) ? $_GET['tab'] : 'lecturers';
      $lect = new Lecturers_model();

      $results = false;

      if ($page_tab == 'lecturers') {

         // liste des enseignant.e.s
         $query = "select * from class_lecturers where class_id = :class_id && disabled = 0 order by id desc limit $limit offset $offset";
         $lecturers = $lect->query($query, ['class_id' => $id]);
         $data['lecturers'] = $lecturers;
      } else if ($page_tab == 'students') {

         // liste des étudiant.e.s
         $query = "select * from class_students where class_id = :class_id && disabled = 0 order by id desc limit $limit offset $offset";
         $students = $lect->query($query, ['class_id' => $id]);
         $data['students'] = $students;
      } else if ($page_tab == 'tests') {

         // liste des évaluations
         $query = "select * from tests where class_id = :class_id order by id desc limit $limit offset $offset";
         $tests = $lect->query($query, ['class_id' => $id]);
         $data['tests'] = $tests;
      }

      $data['row'] = $row;
      $data['crumbs'] = $crumbs;
      $data['page_tab'] = $page_tab;
      $data['results'] = $results;
      $data['errors'] = $errors;
      $data['pager'] = $pager;

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

      $crumbs[] = ['Tableau de bord', ROOT . '/home'];
      $crumbs[] = ['Cours', ROOT . '/classes'];

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
            $query = "select disabled,id from class_lecturers where user_id = :user_id && class_id = :class_id limit 1";

            if (!$check = $lect->query($query, [
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
               // contrôle si l'enseignant.e est actif
               if (isset($check[0]->disabled)) {
                  if ($check[0]->disabled == 1) {
                     $arr = array();
                     $arr['disabled'] = 0;
                     $lect->update($check[0]->id, $arr);
                     $this->redirect('single_class/' . $id . '?tab=lecturers');
                  } else {
                     $errors[] = 'Cet enseignant.e est déjà dans la liste';
                  }
               } else {
                  $errors[] = 'Cet enseignant.e est déjà dans la liste';
               }
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

      $crumbs[] = ['Tableau de bord', ROOT . '/home'];
      $crumbs[] = ['Cours', ROOT . '/classes'];

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

      $crumbs[] = ['Tableau de bord', ROOT . '/home'];
      $crumbs[] = ['Cours', ROOT . '/classes'];

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
            $query = "select disabled, id from class_students where user_id = :user_id && class_id = :class_id limit 1";

            if (!$check = $stud->query($query, [
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
               if (isset($check[0]->disabled)) {
                  if ($check[0]->disabled == 1) {
                     $arr = array();
                     $arr['disabled'] = 0;
                     $stud->update($check[0]->id, $arr);
                     $this->redirect('single_class/' . $id . '?tab=students');
                  } else {
                     $errors[] = 'Cet.te étudiant.e est déjà dans la liste';
                  }
               } else {
                  $errors[] = 'Cet.te étudiant.e est déjà dans la liste';
               }
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

      $crumbs[] = ['Tableau de bord', ROOT . '/home'];
      $crumbs[] = ['Cours', ROOT . '/classes'];

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

   // --------------TESTS--------------------
   public function testadd($id = '')
   {
      $errors = array();
      if (!Auth::logged_in()) {
         $this->redirect('login');
      }

      $classes = new Classes_model();
      $row = $classes->first('class_id', $id);

      $crumbs[] = ['Tableau de bord', ROOT . '/home'];
      $crumbs[] = ['Évaluation', ROOT . '/tests'];

      if ($row) {
         $crumbs[] = [$row->class, ''];
      }

      $page_tab = 'test-add';
      $test_class = new Tests_model();

      $results = false;

      if (count($_POST) > 0) {

         if (isset($_POST['test'])) {

            $arr = array();
            $arr['test'] = $_POST['test'];
            $arr['description'] = $_POST['description'];
            $arr['class_id'] = $id;
            $arr['disabled'] = 0;
            $arr['date'] = date('Y-m-d H:i:s');

            $test_class->insert($arr);

            $this->redirect('single_class/' . $id . '?tab=tests');
         }
      }

      $data['row'] = $row;
      $data['crumbs'] = $crumbs;
      $data['page_tab'] = $page_tab;
      $data['results'] = $results;
      $data['errors'] = $errors;

      $this->view('single-class', $data);
   }
   public function testedit($id = '', $test_id = '')
   {

      $errors = array();
      if (!Auth::logged_in()) {
         $this->redirect('login');
      }

      $classes = new Classes_model();
      $tests = new Tests_model();

      $row = $classes->first('class_id', $id);
      $test_row = $tests->first('test_id', $test_id);

      $crumbs[] = ['Tableau de bord', ROOT . '/home'];
      $crumbs[] = ['Évaluation', ROOT . '/tests'];

      if ($row) {
         $crumbs[] = [$row->class, ''];
      }

      $page_tab = 'test-edit';
      $test_class = new Tests_model();

      $results = false;

      if (count($_POST) > 0) {

         if (isset($_POST['test'])) {

            $arr = array();
            $arr['test'] = $_POST['test'];
            $arr['description'] = $_POST['description'];
            $arr['disabled'] = $_POST['disabled'];

            $test_class->update($test_row->id, $arr);

            $this->redirect('single_class/testedit/' . $id . '/' . $test_id . '?tab=test-edit');
         }
      }

      $data['row'] = $row;
      $data['test_row'] = $test_row;
      $data['crumbs'] = $crumbs;
      $data['page_tab'] = $page_tab;
      $data['results'] = $results;
      $data['errors'] = $errors;

      $this->view('single-class', $data);
   }

   public function testdelete($id = '', $test_id = '')
   {

      $errors = array();
      if (!Auth::logged_in()) {
         $this->redirect('login');
      }

      $classes = new Classes_model();
      $tests = new Tests_model();

      $row = $classes->first('class_id', $id);
      $test_row = $tests->first('test_id', $test_id);

      $crumbs[] = ['Tableau de bord', ROOT . '/home'];
      $crumbs[] = ['Évaluation', ROOT . '/tests'];

      if ($row) {
         $crumbs[] = [$row->class, ''];
      }

      $page_tab = 'test-delete';
      $test_class = new Tests_model();

      $results = false;

      if (count($_POST) > 0) {

         if (isset($_POST['test'])) {

            $test_class->delete($test_row->id);

            $this->redirect('single_class/' . $id . '?tab=tests');
         }
      }

      $data['row']       = $row;
      $data['test_row']    = $test_row;
      $data['crumbs']    = $crumbs;
      $data['page_tab']    = $page_tab;
      $data['results']    = $results;
      $data['errors']    = $errors;

      $this->view('single-class', $data);
   }
}
