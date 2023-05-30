<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Work;
use Illuminate\Http\Request;

class WorkController extends Controller
{
   public function index(){
    $works = Work::all();
    return response()->json([
        'succes' => true,
        'results' => $works,
    ]);
   }
}
