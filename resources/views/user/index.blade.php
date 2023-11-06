@extends('layouts.app')

@section('content')
    @if (Session::has('success'))
        <div id="success-notification" class="bg-green-500 text-center text-white text-sm p-3 rounded-lg mb-4">
            <p>{{ Session::get('success') }}</p>
        </div>
        {{ Session::forget('success') }}
    @endif

    <main>
        <div class="card my-6 rounded-md mx-auto max-w-7xl py-6 sm:px-6 lg:px-8" style="background-color: #a4b6c4">
            <div align="left" class="card-header">
                <h1 class="mb-4 text-3xl font-extrabold text-gray-900 dark:text-gray-600 md:text-4xl lg:text-4xl">My Courses
                </h1>
            </div>
            
            <!-- Search Bar -->
            <form class="my-5 d-flex justify-content-center" method="GET" action="{{ route('normalUsers.dashboard') }}"
                accept-charset="UTF-8" role="search">
                <div class="grid grid-cols-12 gap-1 relative mb-3" data-te-input-wrapper-init>
                    <div class="col-span-12 md:col-span-4">
                    </div>
                    <div class="col-span-12 md:col-span-3">
                        <input
                            class="peer block min-h-[auto] mb-4 w-full rounded border-0 bg-light px-3 py-[0.32rem] leading-[1.6] outline-none transition-all duration-200 ease-linear focus:placeholder:opacity-100 peer-focus:text-primary data-[te-input-state-active]:placeholder:opacity-100 motion-reduce:transition-none dark:text-neutral-800 dark:placeholder:text-zinc-350 dark:peer-focus:text-primary [&:not([data-te-input-placeholder-active])]:placeholder:opacity-100 form-control"
                            maxlength="50" type="text" name="search" placeholder="Search Course"
                            value="{{ request('search') }}">
                    </div>
                    <div class="col-span-12 md:col-span-5">
                        <button
                            class="inline-block rounded border-2 border-primary px-6 pb-[6px] pt-2 text-xs font-medium uppercase leading-normal text-primary transition duration-150 ease-in-out hover:border-primary-600 hover:bg-neutral-500 hover:bg-opacity-10 hover:text-primary-600 focus:border-primary-600 focus:text-primary-600 focus:outline-none focus:ring-0 active:border-primary-700 active:text-primary-700 dark:hover:bg-neutral-100 dark:hover:bg-opacity-10"
                            href="#"><i class="fa-solid fa-magnifying-glass"></i></i><span
                                style="margin-left: 5px;">Search</span>
                        </button>
                    </div>
                </div>
            </form>

            <div class="card-body">

                <!-- Table -->
                <div>
                    <table class="table-auto my-5">
                        <thead class="">
                            <tr>
                                <th class="columns-6xl">Course Title</th>
                                <th class="columns-2xl">Completion</th>
                                <th class="columns-2xl">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (count($courses) > 0)
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
