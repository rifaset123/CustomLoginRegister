@extends('auth.layouts')

@section('content')

<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <div>
                <h3 class="text-center my-4">All Users Data</h3>
                <hr>
            </div>
            <div class="card border-0 shadow-sm rounded">
                <div class="card-body">
                    <table class="table table-striped text-center">
                        <thead>
                          <tr>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Original Photo (max 450x450)</th>
                            <th scope="col">Tumbnail (150x150)</th>
                            <th scope="col">Square (200x200)</th>
                            <th scope="col">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          @forelse ($users as $post)
                            <tr>
                                <td>{{$post->name}}</td>
                                <td>{{ $post->email }}</td>
                                <td class="text-start">
                                    @if($post->photo)
                                        <img src="{{asset('storage/'.$post->photo )}}" width="450x450px"">
                                    @else
                                        No photo detected
                                    @endif
                                </td>
                                <td class="text-start">
                                @if($post->thumbnail)
                                    <img src="{{asset('storage/'.$post->thumbnail )}}"">
                                @else
                                    No thumbnail detected
                                @endif
                                </td>
                                <td class="text-start">
                                @if($post->square)
                                    <img src="{{asset('storage/'.$post->square )}}"">
                                @else
                                    No square detected
                                @endif
                                </td>
                                <td class="text-start">
                                    <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{ route('user.destroy', $post->id) }}" method="POST">
                                        <a href="{{ route('user.edit', $post->id) }}" class="btn btn-sm btn-primary">EDIT</a>
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">HAPUS</button>
                                    </form>
                                </td>
                            </tr>
                          @empty
                              <div class="alert alert-danger">
                                  Users Data Not
                              </div>
                          @endforelse
                        </tbody>
                      </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
