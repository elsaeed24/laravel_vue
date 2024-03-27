<?php

namespace App\Http\Controllers;

use App\Http\Requests\CourseRequest;
use App\Http\Requests\UpdateCourseRequest;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $course = Course::query()->latest('id')->get();
        return response()->json([
            'status' => 200,
            'msg' => 'fetch_all_course',
            'courses' => $course
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
    public function store(CourseRequest $request)
    {
        $data = $request->validated();
        $data['image'] = $this->uploadImage($request,'image','image_course');
        $course = Course::create($data);

        return response()->json([
            'status' => 200,
            'msg' => 'store_course_successfully',
            'course' => $course
        ]);

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $course = Course::where('id',$id)->first();
        if(empty($course)){
            $msg = 'course not found';
            return response()->json($msg,404);

        }
        return response()->json([
            'status' => 200,
            'msg' => 'fetch_course_successfully',
            'courses' => $course
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
    public function update(UpdateCourseRequest $request, string $id)
    {
        $course = Course::where('id', $id)->first();
        if(empty($course)){
            $msg = 'course not found';
            return response()->json($msg,404);

        }
        $old_image = $course->image;
        $data = $request->validated();
        $new_image = $this->uploadImage($request,'image','image_course');

        if (isset($new_image))
        {
          $data['image']  = $new_image;

        }

         $course->update($data);

        if (isset($old_image) && isset($new_image)){
//            Storage::disk('uploads')->delete($old_image);
            $this->deleteImageFromDisk('uploads',$old_image);
        }

        return response()->json([
            'status' => 200,
            'msg' => 'update_course_successfully',
            'course' => $course
        ]);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Course $course)
    {
        $old_image = $course->image;
        if (isset($old_image))
        {
            $this->deleteImageFromDisk('uploads',$old_image);
        }

        $course->delete();

        return response()->json([
            'status' => 200,
            'msg' => 'delete_course_successfully',
        ]);

    }

    public function uploadImage($request ,$name,$folder)
    {
        if (!$request->hasFile($name)){
            return;
        }
        $file = $request->file($name);
        $path = $file->store($folder,[
            'disk' => 'uploads'
        ]);
        return $path;

    }

    public function deleteImageFromDisk($disk,$old_image)
    {
        Storage::disk($disk)->delete($old_image);
    }
}
