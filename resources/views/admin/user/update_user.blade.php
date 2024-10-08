@extends('layouts.app')

@section('title', 'Update User')
@section('metaDescription', 'Seamlessly modify the existing user of the system.')

@section('content')
    <main>
        <br>
        <div class="card rounded-md mx-auto max-w-xl py-6 sm:px-6 lg:px-8" style="background-color: #a4b6c4">
            <div class="card-header">
                <h3 class="font-bold text-center text-lg mb-4">Update User</h3>
            </div>
            <br>
            <div class="card-body">

                <form method="post" action="{{ route('users.update', $user->id) }}">
                    @csrf

                    <div data-te-input-wrapper-init>
                        <input required type="text" name="username" value="{{ $user->username }}"
                            class="peer block min-h-[auto] mb-4 w-full rounded border bg-light px-3 py-[0.32rem] leading-[1.6] outline-none transition-all duration-200 ease-linear focus:placeholder:opacity-100 peer-focus:text-primary data-[te-input-state-active]:placeholder:opacity-100 motion-reduce:transition-none dark:text-neutral-800 dark:placeholder:text-zinc-350 dark:peer-focus:text-primary [&:not([data-te-input-placeholder-active])]:placeholder:opacity-100"
                            id="inputUsername" placeholder="Username" aria-label="Enter Username" />
                        @error('username')
                            <div class="alert alert-danger" style="color: #cf0707">{{ $message }}</div>
                        @enderror
                        <input required type="email" name="email" value="{{ $user->email }}"
                            class="peer block min-h-[auto] mb-7 w-full rounded border bg-light px-3 py-[0.32rem] leading-[1.6] outline-none transition-all duration-200 ease-linear focus:placeholder:opacity-100 peer-focus:text-primary data-[te-input-state-active]:placeholder:opacity-100 motion-reduce:transition-none dark:text-neutral-800 dark:placeholder:text-zinc-350 dark:peer-focus:text-primary [&:not([data-te-input-placeholder-active])]:placeholder:opacity-100"
                            id="inputEmail" placeholder="Email" aria-label="Enter Email" />
                        @error('email')
                            <div class="alert alert-danger" style="color: #cf0707">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="justify-center sm:flex sm:items-start">

                        <a class="button_red button_red:hover px-4 me-3" href="{{ route('users.index') }}">Cancel
                        </a>

                        <button type="submit" class="button_blue button_blue:hover px-4">Save
                            Changes
                        </button>
                    </div>
                </form>
            </div>

    </main>
@endsection
