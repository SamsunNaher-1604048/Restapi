<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use PhpParser\Node\Stmt\Return_;

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


    public function store(Request $request){
      $validator  = Validator::make($request->all(),[
        'name'=>'required',
        'course'=>'required',
        'phone'=>'required',
        'email'=>'required',
      ]);

      if($validator->fails()){
        return response()->json([
          'status'=>422,
          'error'=>$validator->messages()
        ],422);
      }
      
      else{
        $student = Student::create([
          'name'=>$request->name,
          'course'=>$request->course,
          'phone'=>$request->phone,
          'email'=>$request->email
        ]);

        if($student){
           return response()->json([
              'status'=>200,
              'message'=>'insert successfull'
           ],200);
        }
        else{
          return response()->json([
            'status'=>500,
            'message'=>'sonething is wrong'
         ],500);
        }

      }

    }

     public function show($id){
        $student = Student::find($id);
        if($student){
          return response()->json([
            'status'=>200,
            'student'=>$student
        ],200);

        }
        else{
          return response()->json([
            'status'=>404,
            'message'=>'No such student is found'
        ],404);
        }
     }

     public function edit($id){
        $student = Student::find($id);
        if($student){
          return response()->json([
            'status'=>200,
            'student'=>$student
        ],200);

        }
        else{
          return response()->json([
            'status'=>404,
            'message'=>'No such student is found'
        ],404);
        }
     }

     public function update(Request $request,$id){

      $validator  = Validator::make($request->all(),[
        'name'=>'required',
        'course'=>'required',
        'phone'=>'required',
        'email'=>'required',
      ]);

      if($validator->fails()){
        return response()->json([
          'status'=>422,
          'error'=>$validator->messages()
        ],422);
      }
      
      else{
        $student = Student::find($id);

        $student->update([
          'name'=>$request->name,
          'course'=>$request->course,
          'phone'=>$request->phone,
          'email'=>$request->email
        ]);

        if($student){
           return response()->json([
              'status'=>200,
              'message'=>'insert successfull'
           ],200);
        }
        else{
          return response()->json([
            'status'=>500,
            'message'=>'sonething is wrong'
         ],500);
        }
      }

     }
}
