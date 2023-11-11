@extends('auth.layouts')

@section('content')

<body>
    <div class="container mt-5 mb-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 shadow-sm rounded">
                    <div class="card-body">
                        <form action="{{ route('gallery.update', $games->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-group mb-3">
                                <label class="font-weight-bold">New Title</label>
                                <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title', $games->title) }}" placeholder="Insert New Title">

                                <!-- error message untuk title -->
                                @error('title')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label class="font-weight-bold">New Description</label>
                                <input type="text" class="form-control @error('content') is-invalid @enderror" name="description" rows="5" value="{{ old('description', $games->description) }}" placeholder="Insert New Description"></input>

                                <!-- error message untuk content -->
                                @error('content')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <label class="font-weight-bold mb-2">New Image</label>
                            <div class="form-group mb-3">
                                @if($games->picture)
                                    <img src="{{asset('storage/'. $games->picture )}}"class="img-preview img-fluid mb-3" width="400px">
                                @else
                                    <img class="img-preview img-fluid mb-3 col-sm-5">
                                @endif
                                <input type="file" class="form-control" name="picture" id="picture" onchange="previewImageGallery2()">
                            </div>
                            @error('image')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                            <button type="submit" class="btn btn-md btn-primary">Update</button>
                            <button type="reset" class="btn btn-md btn-warning">Reset</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
@endsection


