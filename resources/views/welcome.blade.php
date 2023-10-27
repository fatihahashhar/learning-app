@extends('layouts.app')

@section('content')
    <div class="flex justify-center">
        <div class="w-6/12 bg-white p-6 shadow-md rounded-lg">

            <div class="flex justify-center p-2 mb-3 text-xl font-bold">
                Add New Course
            </div>

            <form action="{{ route('courses.store') }}" method="POST">
                @csrf

                <!-- Title -->
                <div>
                    <label for="title">Title</label>
                    <input id="title" class="block mt-1 w-full" type="text" name="title" :value="old('title')"
                        autofocus autocomplete="title">

                    @if ($errors->has('title'))
                        <ul class='text-sm text-red-600 space-y-1'>
                            @foreach ($errors->get('title') as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    @endif
                </div>

                <!-- Description -->
                <div class="form-group mt-4">
                    <label for="description">Description</label>
                    <textarea id="description" class="bg-gray-100 rounded-md mt-1 w-full" type="text" name="description"
                        :value="old('description')"></textarea>

                </div>

                <div class="flex justify-end mt-4">
                    <button type="submit" class="primary-btn px-4 py-2 mr-2">Add Course</button>
                    <a class="secondary-btn px-4 py-2" href="{{ route('courses.index') }}">Cancel</a>
                </div>

            </form>

        </div>
    </div>
@endsection