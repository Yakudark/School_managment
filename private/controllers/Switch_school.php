<?php

/**
 * switch_school controller
 */

class Switch_school extends Controller
{
    function index($id = '')
    {
        if (Auth::access('Super Admin')) {

            Auth::switch_school($id);
        }
        $this->redirect('schools');
    }
}
