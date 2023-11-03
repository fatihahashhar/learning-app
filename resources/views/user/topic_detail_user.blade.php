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

        <div class="card rounded-md mx-auto max-w-7xl py-6 sm:px-6 lg:px-8 my-5" style="background-color: #a4b6c4">
            <div class="card-header">
                <div class="text-right">
                    <form action="{{ route('normalUsers.completedTopic', $user->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        @if ($user->topics->contains($topic->id) && $user->topics->find($topic->id)->pivot->is_completed === 1)
                            <input type="hidden" name="incomplete" value="{{ $topic->id }}">
                            <button type="submit" name="incomplete" value="{{ $topic->id }}"
                                class="button_red inline-block rounded border-2 border-primary px-3 pb-[6px] pt-2 me-2 text-xs font-medium uppercase leading-normal text-primary transition duration-150 ease-in-out hover:border-primary-600 hover:bg-neutral-500 hover:bg-opacity-10 hover:text-primary-600 focus:border-primary-600 focus:text-primary-600 focus:outline-none focus:ring-0 active:border-primary-700 active:text-primary-700 dark:hover:bg-neutral-100 dark:hover:bg-opacity-10">Mark
                                as Incomplete</button>
                        @else
                            <input type="hidden" name="complete" value="{{ $topic->id }}">
                            <button type="submit" name="complete" value="{{ $topic->id }}"
                                class="button_green inline-block rounded border-2 border-primary px-3 pb-[6px] pt-2 me-2 text-xs font-medium uppercase leading-normal text-primary transition duration-150 ease-in-out hover:border-primary-600 hover:bg-neutral-500 hover:bg-opacity-10 hover:text-primary-600 focus:border-primary-600 focus:text-primary-600 focus:outline-none focus:ring-0 active:border-primary-700 active:text-primary-700 dark:hover:bg-neutral-100 dark:hover:bg-opacity-10">Mark
                                as Completed</button>
                        @endif
                    </form>

                </div>
                <h3 class="font-bold text-center text-lg mb-4">{{ $topic->title }}</h3>
            </div>
            <br>
            <div class="card-body">
                <h3 class="text-justify mb-2" style="line-height: 12px; white-space: pre-wrap;">{{ $topic->contents }}</h3>
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
