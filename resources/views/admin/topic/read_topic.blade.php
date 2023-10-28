@extends('layouts.app')

@section('content')
    <main>
        <br>
        <div class="card rounded-md mx-auto max-w-7xl py-6 sm:px-6 lg:px-8" style="background-color: #a4b6c4">
            <div class="card-header">
                <h3 class="font-bold text-center text-lg mb-4">{{ $topic->title }}</h3>
            </div>
            <br>
            <div class="card-body">
                <h3 class="text-justify mb-3" style="line-height: 15px; white-space: pre-wrap;">{!! nl2br(e($topic->contents)) !!}</h3>
            </div>
    </main>
@endsection
