@extends('layouts.app')

@section('title', 'Users')
@section('metaDescription', 'List out all of the registered User account that are available.')

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
        <br>
        <div class="card rounded-md mx-auto max-w-7xl py-6 sm:px-6 lg:px-8" style="background-color: #a4b6c4">
            <div align="right" class="card-header">

                <!-- Button to open Create User Modal -->
                <a class="button_primary button_primary:hover px-6"
                    href="{{ route('users.createPage') }}">
                    <i class="fa-solid fa-plus"></i><span style="margin-left: 5px;">Create User</span>
                </a>

            </div>
            <br>
            <div class="card-body">
                <!-- Search Bar -->
                <form class="flex justify-center" method="GET" action="{{ route('users.index') }}" accept-charset="UTF-8"
                    role="search">
                    <div class="grid grid-cols-12 gap-1 relative" data-te-input-wrapper-init>
                        <div class="col-span-12 md:col-span-8">
                            <div class="relative">
                                <input
                                    class="peer block min-h-[auto] w-full rounded border-0 bg-light px-3 py-[0.32rem] leading-[1.6] outline-none transition-all duration-200 ease-linear focus:placeholder:opacity-100 peer-focus:text-primary data-[te-input-state-active]:placeholder:opacity-100 motion-reduce:transition-none dark:text-neutral-800 dark:placeholder:text-zinc-350 dark:peer-focus:text-primary [&:not([data-te-input-placeholder-active])]:placeholder:opacity:100 form-control"
                                    maxlength="50" type="text" name="search" placeholder="Search User"
                                    value="{{ request('search') }}">
                                <button
                                    class="button_search absolute inset-y-0 right-0 mt-[1px] mr-[10px] text-primary focus:outline-none"
                                    name="action" value="search">
                                    <i class="fa-solid fa-magnifying-glass"></i>
                                </button>
                            </div>
                        </div>
                        <div class="col-span-12 md:col-span-4">
                            <button
                                class="button_back button_back:hover px-4"
                                name="action" value="clear">
                                <i class="fa-solid fa-broom"></i><span style="margin-left: 5px;">Clear</span>
                            </button>
                        </div>
                    </div>
                </form>
                <!-- Table -->
                <div>
                    @if (count($users) > 0 && $users->where('role', 'user')->count() > 0)
                        <table class="table-auto mt-5 mb-3">
                            <thead class="">
                                <tr>
                                    <th class="columns-2xl">Username</th>
                                    <th class="columns-6xl">Email</th>
                                    <th class="columns-4xl">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    @if ($user->role === 'user')
                                        <tr>
                                            <td class="text-center">{{ $user->username }}</td>
                                            <td class="text-center">{{ $user->email }}</td>
                                            <td class="text-center">
                                                <a class="button_secondary button_secondary:hover px-3"
                                                    href="{{ route('users.manageUserCoursePage', ['user' => $user->id]) }}">Manage
                                                    Courses
                                                </a>
                                                <a class="button_secondary button_secondary:hover px-3"
                                                    href="{{ route('users.updatePage', $user->id) }}">Edit
                                                </a>
                                                <a class="button_secondary button_secondary:hover px-3"
                                                    href="{{ route('users.deletePage', $user->id) }}">Delete
                                                </a>
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <div class="flex items-center justify-center p-4 mt-4 mb-[-1rem] text-sm text-red-800 dark:text-red-700"
                            role="alert">
                            <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                            </svg>
                            <span class="sr-only">Info</span>
                            <div class="text-center">
                                <span class="font-medium">No User Found!</span>
                            </div>
                        </div>
                    @endif
                </div>


                <!-- Pagination -->
                <div class="mx-auto w-4/5">
                    {{ $users->links('pagination::tailwind') }}
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
