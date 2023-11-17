@extends('layouts.app')

@section('title', $topic->title)
@section('metaDescription', 'Display the contents of a particular topic.')

@section('content')
    <main>
        <div class="card rounded-md mx-auto max-w-7xl py-6 sm:px-6 lg:px-8 my-5" style="background-color: #a4b6c4">
            <div class="card-header">
                <div class="grid grid-cols-12 gap-1 relative mb-3">
                    <div class="col-span-12 md:col-span-10">
                        <a
                            class="button_back button_back:hover px-4"
                            href="{{ route('normalUsers.courseDetailPage', $course->id) }}">
                            <i class="fa-solid fa-arrow-left-long"></i><span style="margin-left: 5px;">Back</span>>
                        </a>
                        

                    </div>
                    <div class="col-span-12 md:col-span-2 flex justify-end">
                        {{-- <form action="{{ route('normalUsers.completedTopic', $user->id) }}" method="POST">
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
                        </form> --}}
                        <div class="flex justify-end p-2">
                            <completion-button :user-key={{ Auth::user()->id }}
                                :is-completed="{{ Auth::user()->topics()->wherePivot('topic_id', $topic->id)->value('is_completed') }}"
                                :topic-key="{{ $topic->id }}"></completion-button>
                        </div>
                    </div>

                </div>

                <h3 class="font-bold text-center text-lg mb-4">{{ $topic->title }}</h3>
            </div>
            <br>
            <div class="card-body">
                <h3 class="text-justify mb-2" style="white-space: pre-wrap;">{!! nl2br(e($topic->contents)) !!}</h3>
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
@vite(['resources/js/app.js'])
