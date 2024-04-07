<?php

/**
 * Profile controller
 */

class Profile extends Controller
{
   function index($id = '')
   {
      $user = new User();
      $row = $user->first('user_id', $id);

      $crumbs[] = ['Tableau de bord', ''];
      $crumbs[] = ['Profil', 'profile'];

      if($row){
         $crumbs[] = [$row->firstname,'profile' ];
      }

      $this->view('profile',[
         'row' => $row,
         'crumbs' =>$crumbs,
      ]);
   }
}
