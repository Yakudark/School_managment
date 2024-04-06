<?php

/**
 * schools controller
 */

class Schools extends Controller
{
    public function index()
    {
        if (!Auth::logged_in()) {
            $this->redirect('login');
        }
        $school = new School();

        $data = $school->findAll();

        $crumbs[] = ['Tableau de bord', ''];
        $crumbs[] = ['Écoles', 'schools'];

        $this->view('schools', [
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
            $school = new School();
            if ($school->validate($_POST)) {


                $_POST['date'] = date('Y-m-d H:i:s');

                $school->insert($_POST);
                $this->redirect('schools');
            } else {

                $errors = $school->errors;
            }
        }
        $crumbs[] = ['Tableau de bord', ''];
        $crumbs[] = ['Écoles', 'schools'];
        $crumbs[] = ['Ajouter', 'schools/add'];

        $this->view(
            'schools.add',
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
        $school = new School();
        $errors = array();

        if (count($_POST) > 0) {
            if ($school->validate($_POST)) {

                $school->update($id, $_POST);
                $this->redirect('schools');
            } else {

                $errors = $school->errors;
            }
        }
        $row = $school->where('id', $id);

        $crumbs[] = ['Tableau de bord', ''];
        $crumbs[] = ['Écoles', 'schools'];
        $crumbs[] = ['Modifier', 'schools/edit'];

        $this->view(
            'schools.edit',
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
        $school = new School();
        $errors = array();
        if (count($_POST) > 0) {
            $school->delete($id);
            $this->redirect('schools');
        }
        $row = $school->where('id', $id);

        $crumbs[] = ['Tableau de bord', ''];
        $crumbs[] = ['Écoles', 'schools'];
        $crumbs[] = ['Supprimer', 'schools/delete'];

        $this->view(
            'schools.delete',
            [
                'row' => $row,
                'crumbs' => $crumbs,

            ]
        );
    }
}
