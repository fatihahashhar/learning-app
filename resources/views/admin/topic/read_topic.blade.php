@extends('layouts.app')

@section('content')
    @if ($message = Session::get('success'))
        <div id="success-notification" class="bg-green-500 text-center text-white text-sm p-3 rounded-lg mb-4">
            <p>{{ $message }}</p>
        </div>
    @elseif ($message = Session::get('error'))
        <div id="error-notification" class="bg-red-500 text-center text-white text-sm p-3 rounded-lg mb-4">
            <p>{{ $message }}</p>
        </div>
    @elseif ($message = Session::get('info'))
        <div id="info-notification" class="bg-blue-500 text-center text-white text-sm p-3 rounded-lg mb-4">
            <p>{{ $message }}</p>
        </div>
    @endif
    <main>

        @livewire('topic-delete', ['topic' => $topic])

        <div class="card rounded-md mx-auto max-w-7xl py-6 sm:px-6 lg:px-8 my-5" style="background-color: #a4b6c4">
            <div class="card-header">
                <div class="text-right">
                    <a class="button_secondary inline-block rounded border-2 border-primary px-3 pb-[6px] pt-2 text-xs me-2 font-medium uppercase leading-normal text-primary transition duration-150 ease-in-out hover:border-primary-600 hover:bg-neutral-500 hover:bg-opacity-10 hover:text-primary-600 focus:border-primary-600 focus:text-primary-600 focus:outline-none focus:ring-0 active:border-primary-700 active:text-primary-700 dark:hover:bg-neutral-100 dark:hover:bg-opacity-10"
                        href="{{ route('topics.updatePage', ['course' => $course->id, 'topic' => $topic->id]) }}">
                        <i class="fas fa-edit"></i><span style="margin-left: 5px;">Update</span>
                    </a>
                    <!-- Button to open Delete Topic Modal -->
                    <button type="button" onclick="delete_topic_modal.showModal()"
                        class="button_secondary inline-block rounded border-2 border-primary px-3 pb-[6px] pt-2 text-xs font-medium uppercase leading-normal text-primary transition duration-150 ease-in-out hover:border-primary-600 hover:bg-neutral-500 hover:bg-opacity-10 hover:text-primary-600 focus:border-primary-600 focus:text-primary-600 focus:outline-none focus:ring-0 active:border-primary-700 active:text-primary-700 dark:hover:bg-neutral-100 dark:hover:bg-opacity-10">
                        <i class="fas fa-trash"></i><span style="margin-left: 5px;">Delete</span>
                    </button>
                </div>
                <h3 class="font-bold text-center text-lg mb-4">{{ $topic->title }}</h3>
            </div>
            <br>
            <div class="card-body">
                <h3 class="text-justify mb-2" style="line-height: 16px; white-space: pre-wrap;">{!! nl2br(e($topic->contents)) !!}</h3>
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
