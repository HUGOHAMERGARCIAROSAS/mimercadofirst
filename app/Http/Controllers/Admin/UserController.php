<?php

namespace App\Http\Controllers\Admin;

use App\src\Repositories\UserRepository;
use App\Http\Controllers\Controller;
use Exception;
use Log;

class UserController extends Controller
{

    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function index()
    {
        return view('admin.pages.users.index', [
            'users' => $this->userRepository->all(),
        ]);
    }
}
