@extends('layouts.app')

@section('title', 'Login')
@section('metaDescription', 'Login page to login into the platform to explore courses, manage user profile, and engage with educational content.')

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
        <div style="display: flex; justify-content: center; align-items: center; height: 100vh;">
            <div class="card rounded-md w-full max-w-md py-10 sm:px-8 lg:px-10" style="background-color: #a4b6c4;">
                <div class="card-header">
                    <h3
                        class="mb-2 text-3xl font-extrabold text-gray-900 dark:text-gray-600 md:text-4xl lg:text-4xl font-bold text-center text-lg mb-4">
                        Login</h3>
                </div>
                <br>
                <div class="card-body">

                    <form action="{{ route('authenticate') }}" method="post">
                        @csrf
                        <div class="form-group email-label row mb-1">
                            <div class="mb-3">
                                <input required type="email" placeholder="Email Address" aria-label="Email Address"
                                    class="peer block min-h-[auto] mb-4 w-full rounded border bg-light px-3 py-[0.32rem] leading-[1.6] outline-none transition-all duration-200 ease-linear focus:placeholder:opacity-100 peer-focus:text-primary data-[te-input-state-active]:placeholder:opacity-100 motion-reduce:transition-none dark:text-neutral-800 dark:placeholder:text-zinc-350 dark:peer-focus:text-primary [&:not([data-te-input-placeholder-active])]:placeholder:opacity-100 form-control @error('email') is-invalid @enderror"
                                    id="email" name="email" value="{{ old('email') }}">
                                @if ($errors->has('email'))
                                    <span class="text-danger">{{ $errors->first('email') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group password-label row mb-1">
                            <div class="mb-1">
                                <input required type="password" placeholder="Password" aria-label="Password"
                                    class="peer block min-h-[auto] mb-4 w-full rounded border bg-light px-3 py-[0.32rem] leading-[1.6] outline-none transition-all duration-200 ease-linear focus:placeholder:opacity-100 peer-focus:text-primary data-[te-input-state-active]:placeholder:opacity-100 motion-reduce:transition-none dark:text-neutral-800 dark:placeholder:text-zinc-350 dark:peer-focus:text-primary [&:not([data-te-input-placeholder-active])]:placeholder:opacity-100 form-control @error('password') is-invalid @enderror"
                                    id="password" name="password">
                                @if ($errors->has('password'))
                                    <span class="text-danger">{{ $errors->first('password') }}</span>
                                @endif
                            </div>
                        </div>
                        <div align="right">
                            <input type="submit"
                                class="button_primary inline-block rounded border-2 border-primary px-11 py-2 mt-3 text-xs font-medium uppercase leading-normal text-primary transition duration-150 ease-in-out hover:border-primary-600 hover:bg-blue-500 hover:bg-opacity-100 hover:text-white focus:border-primary-600 focus:text-primary-600 focus:outline-none focus:ring-0 active:border-primary-700 active:text-primary-700 dark:hover:bg-blue-600 dark:hover:bg-opacity-100"
                                value="Login">
                        </div>
                    </form>
                </div>
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
