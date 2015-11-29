<?php
/**
 * Created by PhpStorm.
 * User: arielizuardi
 * Date: 11/29/15
 * Time: 9:43 PM
 */

namespace App\Http\Controllers;


class DashboardController extends Controller
{
    public function home()
    {
        return view('dashboard.home');
    }
}