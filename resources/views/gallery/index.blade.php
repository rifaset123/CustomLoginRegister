@extends('auth.layouts')
@section('content')
    <div class="row justify-content-center mt-5">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">My Game of Decade</div>
                <div class="card-body mt-2">
                    <div class="row">
                        @if (count($galleries) > 0)
                            @foreach ($galleries as $gallery)
                                <div class="col-sm-4">
                                    <div>
                                        <div class="parent">
                                            <div class="child">
                                                <a class="example-image-link" href="{{ asset('storage/' . $gallery->picture) }}"
                                                    data-lightbox="roadtrip" data-title="{{ $gallery->description }}">
                                                <img class="example-image mb-1 rounded" src="{{ asset('storage/' . $gallery->picture) }}" alt="image-1" width="200"/> </a>
                                            </div>
                                        </div>
                                        <div  class="break-word">
                                            <h4>{{$gallery->title}}</h4>
                                        </div>
                                        <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{ route('gallery.destroy', $gallery->id) }}" method="POST">
                                            <a href="{{ route('gallery.edit', $gallery->id)}}"  class="btn btn-outline-primary mt-2 ms-4 mb-2">Edit</a>
                                            @csrf
                                            @method('DELETE')
                                                <button type="submit" class="btn btn-danger mt-2 mb-2">Hapus</button>
                                            </form>
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <h3>Data Not Found.</h3>
                        @endif
                        <div class="d-flex">
                            {{ $galleries->links() }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="text-end">
                <a href="{{ route('gallery.create')}}"  class="btn btn-outline-primary mt-2 ">Add Game</a>
            </div>
        </div>
    </div>
@endsection
