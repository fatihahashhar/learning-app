@extends('layouts.app')

@section('title', 'Create New Topic')
@section('metaDescription', 'Easily create and customize a new topic for a particular course.')

@section('content')
    <main>
        <div class="card my-6 rounded-md mx-auto max-w-7xl py-6 sm:px-6 lg:px-8" style="background-color: #a4b6c4">
            <div class="card-header">
                <h3 class="font-bold text-center text-lg mb-4">Create New Topic</h3>
            </div>
            <br>
            <div class="card-body">

                <form method="post" action="{{ route('topics.store', $course->id) }}">
                    @csrf

                    <div data-te-input-wrapper-init>
                        <input required type="text" name="title"
                            class="peer block min-h-[auto] mb-4 w-full rounded border bg-light px-3 py-[0.32rem] leading-[1.6] outline-none transition-all duration-200 ease-linear focus:placeholder:opacity-100 peer-focus:text-primary data-[te-input-state-active]:placeholder:opacity-100 motion-reduce:transition-none dark:text-neutral-800 dark:placeholder:text-zinc-350 dark:peer-focus:text-primary [&:not([data-te-input-placeholder-active])]:placeholder:opacity-100"
                            id="inputTopicTitle" placeholder="Topic Title" aria-label="Enter Topic Title"
                            value="{{ old('title') }}" />
                        @error('title')
                            <div class="alert alert-danger" style="color: #cf0707">{{ $message }}</div>
                        @enderror

                        <textarea required name="contents"
                            class="peer block min-h-[auto] mb-4 w-full rounded border bg-light px-3 py-[0.32rem] leading-[1.6] outline-none transition-all duration-200 ease-linear focus:placeholder:opacity-100 peer-focus:text-primary data-[te-input-state-active]:placeholder:opacity-100 motion-reduce:transition-none dark:text-neutral-800 dark:placeholder:text-zinc-350 dark:peer-focus:text-primary [&:not([data-te-input-placeholder-active])]:placeholder:opacity-100"
                            id="inputContents" placeholder="Contents" aria-label="Enter Contents" rows="15">{{ old('contents') }}</textarea>

                    </div>

                    <div class="justify-center sm:flex sm:items-start">

                        <a class="button_red button_red:hover px-4 me-3"
                            href={{ route('topics.index', $course->id) }}>Cancel
                        </a>

                        <button type="submit" class="button_blue button_blue:hover px-4">Create
                        </button>
                    </div>
                </form>
            </div>

    </main>
@endsection
