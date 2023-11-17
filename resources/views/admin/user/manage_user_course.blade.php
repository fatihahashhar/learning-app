@extends('layouts.app')

@section('title', "Manage User's Course")
@section('metaDescription', 'Efficiently administer user enrollments or course assignments.')

@section('content')
    <!-- Pop-up -->
    @if ($message = Session::get('success'))
        {{ session()->forget('success') }}
        <script type="text/javascript">
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            })

            Toast.fire({
                icon: 'success',
                title: '{{ $message }}'
            })
        </script>
    @elseif ($message = Session::get('info'))
        {{ session()->forget('info') }}
        <script type="text/javascript">
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            })

            Toast.fire({
                icon: 'info',
                title: '{{ $message }}'
            })
        </script>
    @elseif ($message = Session::get('error'))
        {{ session()->forget('error') }}
        <script type="text/javascript">
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            })

            Toast.fire({
                icon: 'error',
                title: '{{ $message }}'
            })
        </script>
    @endif
    <!-- Pop-up -->

    <main>
        <div class="card my-6 rounded-md mx-auto max-w-7xl py-6 sm:px-6 lg:px-8" style="background-color: #a4b6c4">
            <div class="card-header">
                <a class="mb-4 button_back button_back:hover px-4"
                    href="{{ route('users.index') }}">
                    <i class="fa-solid fa-arrow-left-long"></i><span style="margin-left: 5px;">Back</span>
                </a>
            </div>

            <div class="card-body">
                <!-- Table -->
                <div>
                    <table class="table-auto my-5">
                        @if (count($courses) > 0)
                            <thead class="">
                                <tr>
                                    <th class="columns-8xl">Course Name</th>
                                    <th class="columns-4xl action-column">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($courses as $course)
                                    <tr>
                                        <td class="text-center">{{ $course->title }}</td>
                                        <td class="text-center">
                                            <form action="{{ route('users.assignCourses', $user->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')

                                                @if ($user->courses->contains($course->id))
                                                    <input type="hidden" name="remove" value="{{ $course->id }}">
                                                    <button type="submit" name="remove" value="{{ $course->id }}"
                                                        class="button_red button_red:hover">Remove</button>
                                                @else
                                                    <input type="hidden" name="assign" value="{{ $course->id }}">
                                                    <button type="submit" name="assign" value="{{ $course->id }}"
                                                        class="button_green button_green:hover">Assign</button>
                                                @endif
                                            </form>

                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                    </table>
                @else
                    <div class="flex items-center justify-center p-4 mt-4 mb-[-3rem] text-sm text-red-800 dark:text-red-700"
                        role="alert">
                        <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                        </svg>
                        <span class="sr-only">Info</span>
                        <div class="text-center">
                            <span class="font-medium">No Course Available!</span> Create one.
                        </div>
                    </div>
                    @endif
                </div>

                <!-- Pagination -->
                <div class="mx-auto w-4/5">
                    {{ $courses->links('pagination::tailwind') }}
                </div>
            </div>

    </main>
    <script>
        /* When the user clicks on the button, toggle between hiding and showing the dropdown content */
        function myFunction() {
            document.getElementById("myDropdown").classList.toggle("show");
        }

        // Close the dropdown if the user clicks outside of it
        window.onclick = function(e) {
            if (!e.target.matches('.dropbtn')) {
                var myDropdown = document.getElementById("myDropdown");
                if (myDropdown.classList.contains('show')) {
                    myDropdown.classList.remove('show');
                }
            }
        }
        // Wait for the document to be fully loaded
        document.addEventListener("DOMContentLoaded", function() {
            const successNotification = document.getElementById('success-notification');

            if (successNotification) {
                // Add a CSS class to hide the notification after 3 seconds
                setTimeout(function() {
                    successNotification.classList.add('hidden');
                }, 3000); // 3000 milliseconds = 3 seconds
            }
        });
    </script>
@endsection
