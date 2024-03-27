<?php

namespace App\Http\Controllers;

use App\Http\Requests\StudentRequest;
use App\Http\Requests\updateStudentRequest;
use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $student = Student::query()->latest('id')->paginate(5);

        return response()->json([
            'status' => 200,
            'msg' => 'fetch_all_students',
            'students' => $student
        ]);


    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StudentRequest $request)
    {

        $data = $request->validated();
        $student =   Student::create($data);
        return response()->json([
            'status' => 200,
            'msg' => 'store_student',
            'students' => $student
        ]);


    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $student = Student::where('id',$id)->first();

        if(empty($student)){
            $msg = "student not found";
            return response()->json($msg,404);
        }

        return response()->json([
            'status' => 200,
            'msg' => 'fetch_student_successfully',
            'students' => $student
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(updateStudentRequest $request, string $id)
    {
        $data = $request->validated();
        $student = Student::where('id',$id)->first();
        if(empty($student)){
            $msg = "student not found";
            return response()->json($msg,404);
        }

      $updateData =  $student->update($data);

        return response()->json([
            'status' => 200,
            'msg' => 'update_student_successfully',
            'students' => $updateData
        ]);


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $student = Student::where('id',$id)->first();

        if(empty($student)){
            $msg = "student not found";
            return response()->json($msg,404);
        }

         $student->delete($student);

        return response()->json([
            'status' => 200,
            'msg' => 'delete_student_successfully',
        ]);




    }
}
