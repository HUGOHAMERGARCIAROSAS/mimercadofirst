<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Exception;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.pages.index');
    }
}