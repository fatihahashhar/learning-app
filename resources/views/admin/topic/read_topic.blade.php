@extends('layouts.app')

@section('title', $topic->title)
@section('metaDescription', 'Display the contents of a particular topic.')

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

        @livewire('topic-delete', ['topic' => $topic])

        <div class="card rounded-md mx-auto max-w-7xl py-6 sm:px-6 lg:px-8 my-5" style="background-color: #a4b6c4">
            <div class="card-header">
                <div class="grid grid-cols-12 gap-1 relative mb-3">
                    <div class="col-span-12 md:col-span-10">
                        <a
                            class="button_back button_back:hover px-4"
                            href="{{ route('topics.index', $course->id) }}">
                            <i class="fa-solid fa-arrow-left-long"></i><span style="margin-left: 5px;">Back</span>
                        </a>
                    </div>
                    <div class="col-span-12 md:col-span-2 flex justify-end">
                        <div class="text-right">
                            <a class="button_secondary button_secondary:hover px-3 me-3"
                                href="{{ route('topics.updatePage', ['course' => $course->id, 'topic' => $topic->id]) }}">
                                <i class="fas fa-edit"></i><span style="margin-left: 5px;">Update</span>
                            </a>
                            <!-- Button to open Delete Topic Modal -->
                            <button type="button" onclick="delete_topic_modal.showModal()"
                                class="button_secondary button_secondary:hover px-3">
                                <i class="fas fa-trash"></i><span style="margin-left: 5px;">Delete</span>
                            </button>
                        </div>
                    </div>
                </div>
                <h3 class="font-bold text-center text-lg">{{ $topic->title }}</h3>
            </div>
            <br>
            <div class="card-body">
                <h3 class="text-justify mb-2" style="white-space: pre-wrap;">{!! nl2br(e($topic->contents)) !!}</h3>
            </div> 
        </div>
        @livewireScripts
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
