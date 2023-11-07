@extends('layouts.app')

@section('title','Create New Topic')

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
                            id="inputTopicTitle" placeholder="Topic Title" aria-label="Enter Topic Title" />

                        <textarea required name="contents"
                            class="peer block min-h-[auto] mb-4 w-full rounded border bg-light px-3 py-[0.32rem] leading-[1.6] outline-none transition-all duration-200 ease-linear focus:placeholder:opacity-100 peer-focus:text-primary data-[te-input-state-active]:placeholder:opacity-100 motion-reduce:transition-none dark:text-neutral-800 dark:placeholder:text-zinc-350 dark:peer-focus:text-primary [&:not([data-te-input-placeholder-active])]:placeholder:opacity-100"
                            id="inputContents" placeholder="Contents" aria-label="Enter Contents" rows="15"></textarea>
                    </div>

                    <div class="justify-center sm:flex sm:items-start">

                        <a class="btn button_secondary inline-block rounded border-2 border-primary p-3 me-2 pb-[6px] pt-2 text-xs font-medium uppercase leading-normal text-primary transition duration-150 ease-in-out hover:border-primary-600 hover:bg-red-500 hover:bg-opacity-100 hover:text-white focus:border-primary-600 focus:text-primary-600 focus:outline-none focus:ring-0 active:border-primary-700 active:text-primary-700 dark:hover:bg-red-600 dark:hover:bg-opacity-100"
                        href={{ route('topics.index', $course->id) }}>Cancel
                        </a>

                        <button type="submit"
                            class="button_secondary inline-block rounded border-2 border-primary p-3 pb-[6px] pt-2 text-xs font-medium uppercase leading-normal text-primary transition duration-150 ease-in-out hover:border-primary-600 hover:bg-blue-500 hover:bg-opacity-100 hover:text-white focus:border-primary-600 focus:text-primary-600 focus:outline-none focus:ring-0 active:border-primary-700 active:text-primary-700 dark:hover:bg-blue-600 dark:hover:bg-opacity-100">Create
                        </button>
                    </div>
                </form>
            </div>

    </main>
@endsection
