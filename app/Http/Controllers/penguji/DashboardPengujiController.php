<?php

namespace App\Http\Controllers\penguji;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class DashboardPengujiController extends Controller
{
 public function index(){
    return view('pagepenguji.dashboard.index');
 }
}
