<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\StudentResource;
use App\Models\Student;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class FormController extends Controller
{
    public function index(){
        $students = Student::paginate(5);
        $collectionsStudents = StudentResource::collection($students);
        return response()->json([
            'message' => 'ini halaman index!',
            'data_student' => $collectionsStudents
        ], Response::HTTP_OK);
    }

    public function create(Request $request){
        $request->validate([
            'nama' => 'required',
            'alamat' => 'required',
            'no_telp' => 'required',
        ]);
        $student = Student::create($request->all());
        return response()->json([
            'message' => 'Data Berhasil Dibuat!',
            'data_student' => $student
        ], Response::HTTP_CREATED);
    }

    public function edit($id){
        $student = Student::find($id);
        return response()->json([
            'message' => 'Success!',
            'data_student' => $student
        ], Response::HTTP_OK);
    }

    public function update(Request $request, $id){
        $request->validate([
            'nama' => 'required',
            'alamat' => 'required',
            'no_telp' => 'required',
        ]);
        $student = Student::find($id);
        $student->update($request->all());
        return response()->json([
            'message' => 'Data Berhasil di Update!',
            'data_student' => $student
        ], Response::HTTP_OK);
    }

    public function destroy(Request $request){
        $this->validate($request, ['student_id' => 'required']);
        $student = Student::find($request->student_id);
        $student->delete();
        return response()->json([
            'message' => 'Data berhasil dihapus!',
        ], Response::HTTP_OK);
    }
}
