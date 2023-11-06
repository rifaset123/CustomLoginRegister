@extends('auth.layouts')

@section('content')

<body>

    <div class="container mt-5 mb-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 shadow-sm rounded">
                    <div class="card-body">
                        <form action="{{ route('user.update', $users->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="form-group mb-3">
                                <label class="font-weight-bold">New Name</label>
                                <input type="text" class="form-control @error('title') is-invalid @enderror" name="name" value="{{ old('name', $users->name) }}" placeholder="Insert New Username">

                                <!-- error message untuk title -->
                                @error('title')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label class="font-weight-bold">New Email</label>
                                <input type="text" class="form-control @error('content') is-invalid @enderror" name="email" rows="5" value="{{ old('email', $users->email) }}" placeholder="Insert New Email"></input>

                                <!-- error message untuk content -->
                                @error('content')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <label class="font-weight-bold">Image</label>
                            <div class="form-group mb-3">
                                @if($users->photo)
                                    <img src="{{asset('storage/'.$users->photo )}}"class="img-preview img-fluid mb-3" width="250px">
                                @else
                                    <img class="img-preview img-fluid mb-3 col-sm-5">
                                @endif
                                <input type="file" class="form-control" name="photo" id="photo" onchange="previewImage()">
                            </div>
                            @error('image')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                            <button type="submit" class="btn btn-md btn-primary">UPDATE</button>
                            <button type="reset" class="btn btn-md btn-warning">RESET</button>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
@endsection


