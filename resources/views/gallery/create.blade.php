@extends('auth.layouts')
@section('content')
    <div class="row justify-content-center mt-5">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Add Game</div>
                <div class="card-body">
            <form action="{{ route('gallery.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3 row">
                    <label for="title" class="col-md-4 col-form-label text-md-end text-start">Title</label>
                    <div class="col-md-6">
                        <input type="text" class="form-control" id="title" name="title">
                        @error('title')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="description" class="col-md-4 col-form-label text-md-end text-start">Description</label>
                    <div class="col-md-6">
                        <textarea class="form-control" id="description" rows="5" name="description"></textarea>
                        @error('description')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="input-file" class="col-md-4 col-form-label text-md-end text-start">Upload Photo</label>
                    <div class="col-md-6">
                        <div class="custom-file">
                            <div class="mb-3">
                                <input class="form-control" type="file" id="input-file" name="picture" value="{{ old('picture')}}" onchange="previewImageGallery()">
                                <label class="custom-file-label" for="input-file"></label>
                                <img class="img-preview img-fluid mb-3 col-sm-5">
                            </div>
                            {{-- <div class="custom-file">
                                <input type="file" class="custom-file-input" id="input-file" name="picture">
                                <label class="custom-file-label" for="input-file">Choose file</label>
                            </div> --}}
                        </div>
                        <div class="text-start">
                            <button type="submit" class="btn btn-primary">Save</button>
                            <button type="reset" class="btn btn-md btn-warning">Reset</button>
                        </div>
                    </div>
                </div>
            </form>
                </div>
            </div>
        </div>
        </div>
    </div>
@endsection
