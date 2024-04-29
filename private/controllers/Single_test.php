<?php

/**
 * Single test controller
 */
class Single_test extends Controller
{

   public function index($id = '')
   {
      $errors = array();
      if (!Auth::logged_in()) {
         $this->redirect('login');
      }

      $tests = new Tests_model();
      $row = $tests->first('test_id', $id);

      $crumbs[] = ['Tableau de bord', ROOT . '/home'];
      $crumbs[] = ['Évaluation', ROOT . '/tests'];

      if ($row) {
         $crumbs[] = [$row->test, ''];
      }
      $page_tab = isset($_GET['tab']) ? $_GET['tab'] : 'view';

      $limit = 10;
      $pager = new Pager($limit);
      $offset = $pager->offset;


      $results = false;

      $data['row'] = $row;
      $data['crumbs'] = $crumbs;
      $data['page_tab'] = $page_tab;
      $data['results'] = $results;
      $data['errors'] = $errors;
      $data['pager'] = $pager;

      $this->view('single-test', $data);
   }
   public function addsubjective($id = '')
   {
      $errors = array();
      if (!Auth::logged_in()) {
         $this->redirect('login');
      }

      $tests = new Tests_model();
      $row = $tests->first('test_id', $id);

      $crumbs[] = ['Tableau de bord', ROOT . '/home'];
      $crumbs[] = ['Évaluation', ROOT . '/tests'];

      if ($row) {
         $crumbs[] = [$row->test, ''];
      }
      $page_tab = 'add-subjective';

      $limit = 10;
      $pager = new Pager($limit);
      $offset = $pager->offset;

      if (count($_POST) > 0) {
         $quest = new Questions_model();
         if ($quest->validate($_POST)) {
            
            $_POST['test_id'] = $id;
            $_POST['question_type'] = 'subjective';
            $_POST['date'] = date("Y-m-d H:i:s");

            $quest->insert($_POST);
            $this->redirect('single_test/' . $id);
         } else {
            $errors = $quest->errors;
         }
      };

      $results = false;

      $data['row'] = $row;
      $data['crumbs'] = $crumbs;
      $data['page_tab'] = $page_tab;
      $data['results'] = $results;
      $data['errors'] = $errors;
      $data['pager'] = $pager;

      $this->view('single-test', $data);
   }
}
