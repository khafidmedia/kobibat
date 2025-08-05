<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SHU;

class SHUAdminController extends Controller
{
    public function index()
    {
        $shus = SHU::latest()->paginate(10);
        return view('admin.shu.index', compact('shus'));
    }
}
