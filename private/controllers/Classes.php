<?php

/**
 * classes controller
 */

class Classes extends Controller
{
    public function index()
    {
        if (!Auth::logged_in()) {
            $this->redirect('login');
        }
        $classes = new CLasses_model();

        $data = $classes->findAll();

        $crumbs[] = ['Tableau de bord', ''];
        $crumbs[] = ['Disciplines', 'classes'];

        $this->view('classes', [
            'rows' => $data,
            'crumbs' => $crumbs,

        ]);
    }
    public function add()
    {
        if (!Auth::logged_in()) {
            $this->redirect('login');
        }
        $errors = array();

        if (count($_POST) > 0) {
            $classes = new CLasses_model();
            if ($classes->validate($_POST)) {


                $_POST['date'] = date('Y-m-d H:i:s');

                $classes->insert($_POST);
                $this->redirect('classes');
            } else {

                $errors = $classes->errors;
            }
        }
        $crumbs[] = ['Tableau de bord', ''];
        $crumbs[] = ['Discipline', 'classes'];
        $crumbs[] = ['Ajouter', 'classes/add'];

        $this->view(
            'classes.add',
            [
                'errors' => $errors,
                'crumbs' => $crumbs,
            ]
        );
    }
    public function edit($id = null)
    {
        if (!Auth::logged_in()) {
            $this->redirect('login');
        }
        $classes = new CLasses_model();
        $errors = array();

        if (count($_POST) > 0) {
            if ($classes->validate($_POST)) {

                $classes->update($id, $_POST);
                $this->redirect('classes');
            } else {

                $errors = $classes->errors;
            }
        }
        $row = $classes->where('id', $id);

        $crumbs[] = ['Tableau de bord', ''];
        $crumbs[] = ['Discipline', 'classes'];
        $crumbs[] = ['Modifier', 'classes/edit'];

        $this->view(
            'classes.edit',
            [
                'row' => $row,
                'errors' => $errors,
                'crumbs' => $crumbs,

            ]
        );
    }
    public function delete($id = null)
    {
        if (!Auth::logged_in()) {
            $this->redirect('login');
        }
        $classes = new Classes_model();
        $errors = array();

        if (count($_POST) > 0) {
            $classes->delete($id);
            $this->redirect('classes');
        }

        $row = $classes->where('id', $id);

        $crumbs[] = ['Tableau de bord', ''];
        $crumbs[] = ['Disciplines', 'classes'];
        $crumbs[] = ['Supprimer', 'classes/delete'];

        $this->view(
            'classes.delete',
            [
                'row' => $row,
                'crumbs' => $crumbs,

            ]
        );
    }
}
