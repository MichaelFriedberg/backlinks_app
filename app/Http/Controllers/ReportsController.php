<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;

class ReportsController extends Controller
{
    /**
     * Show all reports
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $reports = Auth::user()->reports()->latest()->get();

        return view('reports.index', compact('reports'));
    }
}
