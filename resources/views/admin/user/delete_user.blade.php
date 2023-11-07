@extends('layouts.app')

@section('title', 'Delete User')
@section('metaDescription', 'Safely remove a particular user from the system.')

@section('content')
    <main>
        <br>
        <div class="card rounded-md mx-auto max-w-xl py-6 sm:px-8 lg:px-10" style="background-color: #a4b6c4">
            <div class="card-header">
                <h3 class="font-bold text-center text-lg mb-4">Delete User</h3>
            </div>
            <br>
            <div class="card-body">
                <form method="post" action="{{ route('users.delete', $user->id) }}">
                    @csrf

                    <h4 class="mb-4 text-center">
                        Username: {{ $user->username }}
                    </h4>

                    <h6 class="my-7 text-center">
                        Are you sure that you want to delete this user?
                    </h6>

                    <div class="justify-center sm:flex sm:items-start">

                        <a class="btn button_secondary inline-block rounded border-2 border-primary p-3 me-2 pb-[6px] pt-2 text-xs font-medium uppercase leading-normal text-primary transition duration-150 ease-in-out hover:border-primary-600 hover:bg-red-500 hover:bg-opacity-100 hover:text-white focus:border-primary-600 focus:text-primary-600 focus:outline-none focus:ring-0 active:border-primary-700 active:text-primary-700 dark:hover:bg-red-600 dark:hover:bg-opacity-100"
                            href={{ route('users.index') }}>Cancel
                        </a>

                        <button type="submit"
                            class="button_secondary inline-block rounded border-2 border-primary p-3 pb-[6px] pt-2 text-xs font-medium uppercase leading-normal text-primary transition duration-150 ease-in-out hover:border-primary-600 hover:bg-blue-500 hover:bg-opacity-100 hover:text-white focus:border-primary-600 focus:text-primary-600 focus:outline-none focus:ring-0 active:border-primary-700 active:text-primary-700 dark:hover:bg-blue-600 dark:hover:bg-opacity-100">Delete
                        </button>
                    </div>
                </form>
            </div>
    </main>
@endsection
