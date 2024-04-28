<?php

namespace App\Http\Controllers\User\UEQ;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DocumentationController extends Controller
{
    public function index()
    {
        return view('pages.research.ueq.documentation');
    }
}
