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

                    <h6 class="my-6 text-center">
                        Deleting a user is <span style="color: red; font-weight: 600">irreversible</span>. <br> Are you sure that you want to proceed deleting this user?
                    </h6>

                    <div class="justify-center sm:flex sm:items-start">

                        <a class="button_blue button_blue:hover me-3 px-4"
                            href={{ route('users.index') }}>Cancel
                        </a>

                        <button type="submit"
                            class="button_red button_red:hover px-4">Delete
                        </button>
                    </div>
                </form>
            </div>
    </main>
@endsection
