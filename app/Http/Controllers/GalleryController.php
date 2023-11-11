<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\File;


class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //  menampilkan data pada table posts yang memiliki gambar dan kolom gambar tidak kosong
        $data = array(
            'id' => "posts",
            'menu' => 'Gallery',
            'galleries' => Post::where('picture', '!=','') -> whereNotNull('picture')->orderBy('created_at', 'desc')->paginate(30));
            return view('gallery.index') -> with($data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Membuat form upload gambar
        return view('gallery.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $path = null; // Inisialisasi dengan null
        // Membuat form upload gambar agar bisa menyimpan
        $this->validate($request, [
            'title' => 'required|max:255',
            'description' => 'required',
            'picture' => 'image|nullable|max:1999'
            ]);

            if ($request->hasFile('picture')) {
                $filenameWithExt = $request->file('picture')->getClientOriginalName();
                $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                $extension = $request->file('picture')->getClientOriginalExtension();
                $basename = uniqid() . time();
                $smallFilename = "small_{$basename}.{$extension}";
                $mediumFilename = "medium_{$basename}.{$extension}";
                $largeFilename = "large_{$basename}.{$extension}";
                $filenameSimpan = "{$basename}.{$extension}";

                $path = $request->file('picture')->storeAs('posts_image', $filenameSimpan);

            } else {
                $filenameSimpan = 'noimage.png';
            }
            // dd($request->input());
            $post = new Post;
            $post->picture = $path;
            $post->title = $request->input('title');
            $post->description = $request->input('description');
            $post->save();

            return redirect('gallery')->with('success', 'Berhasil menambahkan data baru');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $games = Post::findOrFail($id);

        //render view with users
        return view('gallery.edit', compact('games'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $games = Post::findOrFail($id);
        // Validate form

        // Validate form
        $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'picture' => 'image|nullable|max:1999'
        ]);
        $userData = [
            'title' => $request->title,
            'description' => $request->description,
        ];


        // valiidate gambar
        if ($request->hasFile('picture')) {

            // Hapus gambar lama
            File::delete(public_path() .'/storage/posts_image/'. $games->picture);

            // Upload gambar baru ukuran normal
            $filenameWithExt = $request->file('picture')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('picture')->getClientOriginalExtension();
            $filenameSimpan = "{$filename}_".time().".{$extension}";
            $path = $request->file('picture')->storeAs('posts_image', $filenameSimpan);

            $userData['picture'] = $path;
        }
        else{
        }

        $games->update($userData);

        return redirect('gallery')->with('success', 'Data successfully modified.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $user = Post::findOrFail($id);
        $user->delete();
        return redirect()->route('gallery.index')
            ->withSuccess('Data Deleted Successfully');
    }
}
