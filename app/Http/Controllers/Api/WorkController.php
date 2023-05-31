<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Work;
use Illuminate\Http\Request;

class WorkController extends Controller
{
   public function index(){
    $works = Work::with(['type','technologies'])->get();//-> paginate(3);
    return response()->json([
        'succes' => true,
        'results' => $works,
    ]);
   }
   
   
   public function show($id){
        $work = Work::where('id', $id)->with(['type','technologies'])->first();

        return response()->json([
            'succes' => true,
            'work' => $work
        ]);
   }
}
