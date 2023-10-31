<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
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
        $request->validate([
            'username' => 'required|string|max:250',
            'email' => 'required|string|email:rfc,dns|max:250|unique:users',
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

    public function manageUserCoursePage(Course $course, User $user)
    {
        $courses = Course::all();
        return view('admin/user/manage_user_course', compact('courses', 'user'));
    }

    public function assignCourses(User $user)
    {
        $courseId = request('assign') ?? request('remove');

        if (request()->has('assign')) {
            $user->courses()->attach($courseId);
        } elseif (request()->has('remove')) {
            $user->courses()->detach($courseId);
        }

        return redirect()->back()->with('success', 'Course assignment updated.');
    }
}
