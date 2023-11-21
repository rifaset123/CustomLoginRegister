@extends('layouts.app') // Use your layout as needed

@section('content')
    <h1>Gallery</h1>

    @foreach ($posts as $post)
        <div>
            <h2>{{ $post['title'] }}</h2>
            <p>{{ $post['description'] }}</p>
            <!-- Add other fields as needed -->
        </div>
    @endforeach
@endsection
