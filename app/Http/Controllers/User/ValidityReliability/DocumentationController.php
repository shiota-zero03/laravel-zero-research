<?php

namespace App\Http\Controllers\User\ValidityReliability;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DocumentationController extends Controller
{
    public function index()
    {
        return view('pages.research.validity-reliability.documentation');
    }
}
