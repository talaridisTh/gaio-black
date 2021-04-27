<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Imports\UsersImport;
use App\Models\User;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class UserController extends Controller {

    //
    public function index()
    {
        return view("admin.users.users");
    }

    public function create()
    {
        return view("admin.users.user-create");
    }

    public function userImport(Request $request)
    {

        Excel::import(new UsersImport, $request->file('excel-user'));
        return redirect()->back()->with('success', 'All good!');
    }

}
