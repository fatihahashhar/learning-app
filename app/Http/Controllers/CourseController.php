<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $user = auth()->user();

        $keyword = $request->get('search');

        if ($request->has('action') && $request->input('action') === 'clear') {
            return redirect()->route('courses.index');
        }

        if (!empty($keyword)) {
            $courses = Course::where('title', 'LIKE', "%$keyword%")
                ->orWhere('description', 'LIKE', "%$keyword%")
                ->paginate(10);
        } else {
            $courses = Course::paginate(10);
        }

        return view('admin/course/index', compact('courses'));
    }
}
