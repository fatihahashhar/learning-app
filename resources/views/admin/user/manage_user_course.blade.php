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
                <button
                    class="mb-4 button_back inline-block rounded border-2 border-primary px-6 pb-[6px] pt-2 text-xs font-medium uppercase leading-normal text-primary transition duration-150 ease-in-out hover:border-primary-600 hover-bg-neutral-500 hover:bg-opacity-10 hover-text-primary-600 focus-border-primary-600 focus-text-primary-600 focus-outline-none focus-ring-0 active-border-primary-700 active-text-primary-700 dark-hover-bg-neutral-100 dark-hover-bg-opacity-10"
                    onclick="javascript:history.back();">
                    <i class="fa-solid fa-arrow-left-long"></i><span style="margin-left: 5px;">Back</span>
                </button>
            </div>

            <div class="card-body">
                <!-- Table -->
                <div>
                    <table class="table-auto my-5">
                        <thead class="">
                            <tr>
                                <th class="columns-8xl">Course Name</th>
                                <th class="columns-4xl action-column">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (count($courses) > 0)
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
                                                        class="button_red inline-block rounded border-2 border-primary px-3 pb-[6px] pt-2 me-2 text-xs font-medium uppercase leading-normal text-primary transition duration-150 ease-in-out hover:border-primary-600 hover:bg-neutral-500 hover:bg-opacity-10 hover:text-primary-600 focus:border-primary-600 focus:text-primary-600 focus:outline-none focus:ring-0 active:border-primary-700 active:text-primary-700 dark:hover:bg-neutral-100 dark:hover:bg-opacity-10">Remove</button>
                                                @else
                                                    <input type="hidden" name="assign" value="{{ $course->id }}">
                                                    <button type="submit" name="assign" value="{{ $course->id }}"
                                                        class="button_green inline-block rounded border-2 border-primary px-3 pb-[6px] pt-2 me-2 text-xs font-medium uppercase leading-normal text-primary transition duration-150 ease-in-out hover:border-primary-600 hover:bg-neutral-500 hover:bg-opacity-10 hover:text-primary-600 focus:border-primary-600 focus:text-primary-600 focus:outline-none focus:ring-0 active:border-primary-700 active:text-primary-700 dark:hover:bg-neutral-100 dark:hover:bg-opacity-10">Assign</button>
                                                @endif
                                            </form>

                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="3" align="center">
                                        No Course Found!
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
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
