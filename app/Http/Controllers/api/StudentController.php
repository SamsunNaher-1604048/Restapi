<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index(){
       $student = Student::all();

       if($student->count()>0){
        return response()->json([
          'status'=>200,
          'student'=> $student
        ],200);
       }
       else{
        return response()->json([
            'status'=>404,
            'student'=>"student not found"
          ],200);

       }
    }
}
