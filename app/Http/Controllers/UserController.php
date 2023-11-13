<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Topic;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // public function index()
    // {
    //     $users = User::all();
    //     return view('admin/user/index', compact('users'));
    // }

    public function index(Request $request)
    {
        $user = auth()->user();

        $keyword = $request->get('search');

        if ($request->has('action') && $request->input('action') === 'clear') {
            return redirect()->route('users.index');
        }

        if (!empty($keyword)) {
            $users = User::where(function ($query) use ($keyword) {
                $query->where('username', 'LIKE', "%$keyword%")
                    ->orWhere('email', 'LIKE', "%$keyword%");
            })
                ->where('role', 'user')
                ->orderBy('created_at', 'asc')
                ->paginate(10);
        } else {
            $users = User::where('role', 'user')->paginate(10);
        }

        return view('admin/user/index', compact('users'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function createPage(User $user)
    {
        return view('admin/user/create_user', compact('user'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Check if the email or username already exists in the database
        $existingUsername = User::where('username', $request->username)
            ->first();

        $existingEmail = User::where('email', $request->email)
            ->first();

        if ($existingUsername) {
            // Username already exists, return with an error message
            return redirect()->back()
                ->withInput($request->except('email', 'password', 'password_confirmation'))
                ->withErrors(['username' => 'The username has already been taken.']);
        } else if ($existingEmail) {
            // Email already exists, return with an error message
            return redirect()->back()
                ->withInput($request->except('username', 'password', 'password_confirmation'))
                ->withErrors(['email' => 'The email has existed in database.']);
        }

        // Validation passed, create the new user
        $request->validate([
            'username' => 'required|string|max:250',
            'email' => 'required|string|email:rfc,dns|max:250',
            'password' => 'required|string|min:8|confirmed'
        ]);

        User::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'user'
        ]);

        // Redirect
        return redirect()->route('users.index')->with('success', 'User created successfully!');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function updatePage(User $user)
    {
        $user = User::findOrFail($user->id);
        return view('admin.user.update_user', ['user' => $user]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        //dd('updating page');
        $user = User::find($user->id);

        $user->username = $request->username;
        $user->email = $request->email;

        if ($user->isDirty()) {
            if ($user->save()) {
                return redirect()->route('users.index')->with('success', 'User details updated successfully!');
            } else {
                return redirect()->route('users.index')->with('error', 'User details cannot be updated!');
            }
        } else {
            return redirect()->route('users.index')->with('info', 'No changes were made');
        }
    }

    public function deletePage(User $user)
    {
        $user = User::findOrFail($user->id);
        return view('admin.user.delete_user', ['user' => $user]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(User $user)
    {
        $user = User::findOrFail($user->id);
        $user->delete();

        return redirect()->route('users.index')->with('success', 'User has been deleted!');
    }

    public function manageUserCoursePage(User $user)
    {
        $courses = Course::paginate(10);
        return view('admin/user/manage_user_course', compact('courses', 'user'));
    }

    public function assignCourses(User $user)
    {
        $courseId = request('assign') ?? request('remove');

        if (request()->has('assign')) {
            $user->courses()->attach($courseId);
            $course_topics = Topic::where('course_id', $courseId)->get();
            if ($course_topics != null) {
                foreach ($course_topics as $course_topic) {

                    $user->topics()->attach($course_topic);
                }
            }
        } elseif (request()->has('remove')) {
            $user->courses()->detach($courseId);
            $course_topics = Topic::where('course_id', $courseId)->get();
            if ($course_topics != null) {
                foreach ($course_topics as $course_topic) {
                    $user->topics()->detach($course_topic);
                }
            }
        }

        return redirect()->back()->with('success', 'Course assignment updated.');
    }
}
