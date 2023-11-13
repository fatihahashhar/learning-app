@extends('layouts.app')

@section('title', 'Courses')
@section('metaDescription', 'List out all of the Courses that has been assigned.')

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
            <div align="left" class="card-header">
                <h1 class="mb-4 text-3xl font-extrabold text-gray-900 dark:text-gray-600 md:text-4xl lg:text-4xl">My Courses
                </h1>
            </div>

            <!-- Search Bar -->
            <form class="flex justify-center" method="GET" action="{{ route('normalUsers.dashboard') }}"
                accept-charset="UTF-8" role="search">
                <div class="grid grid-cols-12 gap-1 relative" data-te-input-wrapper-init>
                    <div class="col-span-12 md:col-span-7">
                        <div class="relative">
                            <input
                                class="peer block min-h-[auto] w-full rounded border-0 bg-light px-3 py-[0.32rem] leading-[1.6] outline-none transition-all duration-200 ease-linear focus:placeholder:opacity-100 peer-focus:text-primary data-[te-input-state-active]:placeholder:opacity-100 motion-reduce:transition-none dark:text-neutral-800 dark:placeholder:text-zinc-350 dark:peer-focus:text-primary [&:not([data-te-input-placeholder-active])]:placeholder:opacity:100 form-control"
                                maxlength="50" type="text" name="search" placeholder="Search Course"
                                value="{{ request('search') }}">
                            <button
                                class="button_search absolute inset-y-0 right-0 mt-[1px] mr-[10px] text-primary focus:outline-none"
                                name="action" value="search">
                                <i class="fa-solid fa-magnifying-glass"></i>
                            </button>
                        </div>
                    </div>
                    <div class="col-span-12 md:col-span-5">
                        <button
                            class="button_back inline-block rounded border-2 border-primary px-4 pb-[6px] pt-2 text-xs font-medium uppercase leading-normal text-primary transition duration-150 ease-in-out hover:border-primary-600 hover:bg-neutral-500 hover:bg-opacity-10 hover:text-primary-600 focus:border-primary-600 focus:text-primary-600 focus:outline-none focus:ring-0 active:border-primary-700 active:text-primary-700 dark:hover:bg-neutral-100 dark:hover:bg-opacity-10"
                            name="action" value="clear">
                            <i class="fa-solid fa-broom"></i><span style="margin-left: 5px;">Clear</span>
                        </button>
                    </div>
                </div>
            </form>

            <div class="card-body">

                <!-- Table -->
                <div>
                    <table class="table-auto my-5">
                        @if (count($courses) > 0)
                            <thead class="">
                                <tr>
                                    <th class="columns-6xl">Course Title</th>
                                    <th class="columns-2xl">Completion</th>
                                    <th class="columns-2xl">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($courses as $course)
                                    <tr>
                                        <td class="text-center">{{ $course->title }}</td>
                                        <td class="text-center">
                                            {{ $courseCompletionRatios[$course->id] }}%
                                        </td>
                                        <td class="text-center">
                                            <a class="button_secondary inline-block rounded border-2 border-primary px-3 pb-[6px] pt-2 me-2 text-xs font-medium uppercase leading-normal text-primary transition duration-150 ease-in-out hover:border-primary-600 hover:bg-neutral-500 hover:bg-opacity-10 hover:text-primary-600 focus:border-primary-600 focus:text-primary-600 focus:outline-none focus:ring-0 active:border-primary-700 active:text-primary-700 dark:hover:bg-neutral-100 dark:hover:bg-opacity-10"
                                                href={{ route('normalUsers.courseDetailPage', ['course' => $course->id]) }}>View
                                            </a>
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
                            <span class="font-medium">No Course Found!</span> Change a few things up and try to
                            search again.
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
