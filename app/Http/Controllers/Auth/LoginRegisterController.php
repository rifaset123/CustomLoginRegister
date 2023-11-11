<?php

namespace App\Http\Controllers\Auth;

use Image;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Jobs\SendMailJob;
use Illuminate\View\View;
use App\Mail\SendEmail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use App\Http\Requests\UpdateUsersRequest;

class LoginRegisterController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('guest')->except([
            'logout', 'dashboard'
        ]);
    }

    /**
     * Display a registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function register()
    {
        return view('auth.register');
    }

    /**
     * Store a new user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request -> validate([
            'name' => 'required|string|max:250',
            'email' => 'required|email|max:250|unique:users',
            'password' => 'required|min:8|confirmed',
            'photo' => 'image|nullable|max:1999'
        ]);

        // file upload

        $path = null; // Inisialisasi dengan null
        $pathTumbnail = null; // Inisialisasi dengan null
        $pathSquare = null; // Inisialisasi dengan null

        if($request -> hasFile('photo')){
            $filenameWithExt = $request->file('photo')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);

            $extension = $request->file('photo')->getClientOriginalExtension();
            $filenameSimpan = $filename.'_'.time().'.'.$extension;

            $path = $request->file('photo')->storeAs('photos', $filenameSimpan);

            // resize ke thumbnail
            $thumbnail = Image::make($request->file('photo')->getRealPath())->resize(150, 150);
            $thumbnailSimpan = time() . '_thumbnail_' . $request->file('photo')->getClientOriginalName(); // penamaan
            $thumbnail->save(public_path() . '/storage/photos/' . $thumbnailSimpan);

            // resize ke square
            $square = Image::make($request->file('photo')->getRealPath())->resize(200, 200);
            $squareSimpan = time() . '_square_' . $request->file('photo')->getClientOriginalName(); // penamaan
            $square->save(public_path() . '/storage/photos/' . $squareSimpan);

            // Simpan path gambar baru ke dalam array data user
            $pathTumbnail = 'photos/' . $thumbnailSimpan;
            $pathSquare = 'photos/' . $squareSimpan;
        } else {
            // kalo gada file foto
        }

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'photo' => $path,
            'thumbnail' => $pathTumbnail,
            'square' => $pathSquare
        ]);

        $content = [
            'subject'   => $request->name,
            'body'      => $request->email
            ];

        Mail::to($request->email)->send(new SendEmail($content));

        $credentials = $request->only('email', 'password');
        Auth::attempt($credentials);
        $request->session()->regenerate();
        return redirect()->route('login')
            ->withSuccess('You have successfully registered & logged in!');
    }

    /**
     * Display a login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function login()
    {
        return view('auth.login');
    }

    /**
     * Authenticate the user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if(Auth::attempt($credentials))
        {
            $request->session()->regenerate();
            return redirect()->route('register')
                ->withSuccess('You have successfully registered and logged in!');
        }

        return back()->withErrors([
            'email' => 'Your provided credentials do not match in our records.',
        ])->onlyInput('email');

    }

    /**
     * Display a dashboard to authenticated users.
     *
     * @return \Illuminate\Http\Response
     */

     //verif ke dashboard harus login
    public function dashboard()
    {
        if(Auth::check())
        {
            return view('auth.dashboard')->withSuccess('You have loged in successfully!');

        }

        return redirect()->route('login')
            ->withErrors([
                'email' => 'Please login to access the dashboard.',
        ])->onlyInput('email');
    }

    /**
     * Log out the user from application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login')
            ->withSuccess('You have logged out successfully!');
    }
    // Controller

    public function index()
    {
        $users = User::all(); // Mengambil data dari model Post atau sumber data lainnya
        return view('users', ['users' => $users]);
    }

        /**
     * Log out the user from application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    //hapus data
    public function destroy($user)
    {
        $user = User::findOrFail($user);
        $user->delete();
        return redirect()->route('users')
            ->withSuccess('Data Deleted Successfully');
    }

    public function edit(string $id): View
    {
        //get post by ID
        $users = User::findOrFail($id);

        //render view with users
        return view('edit', compact('users'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        // Validate form

        // Validate form
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
            'image' => 'image|mimes:jpeg,jpg,png|max:2048', // aturan validasi untuk gambar
    ]);

    // Update user data
    $userData = [
        'name' => $request->name,
        'email' => $request->email,
    ];

    // Update gambar jika ada
    if ($request->hasFile('photo')) {
        // Hapus gambar lama
        File::delete(public_path() . 'photos/' . $user->photos);

        // Upload gambar baru ukuran normal
        $filenameWithExt = $request->file('photo')->getClientOriginalName();
        $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
        $extension = $request->file('photo')->getClientOriginalExtension();
        $filenameSimpan = $filename.'_'.time().'.'.$extension;
        $path = $request->file('photo')->storeAs('photos', $filenameSimpan);

        // resize ke thumbnail
        $thumbnail = Image::make($request->file('photo')->getRealPath())->resize(150, 150);
        $thumbnailSimpan = time() . '_thumbnail_' . $request->file('photo')->getClientOriginalName(); // penamaan
        $thumbnail->save(public_path() . '/storage/photos/' . $thumbnailSimpan);

        // resize ke square
        $square = Image::make($request->file('photo')->getRealPath())->resize(200, 200);
        $squareSimpan = time() . '_square_' . $request->file('photo')->getClientOriginalName(); // penamaan
        $square->save(public_path() . '/storage/photos/' . $squareSimpan);

        // Simpan path gambar baru ke dalam array data user
        $userData['photo'] = $path;
        $userData['thumbnail'] = 'photos/' . $thumbnailSimpan;
        $userData['square'] = 'photos/' . $squareSimpan;
    }

    // Lakukan pembaruan data
    $user->update($userData);

    return redirect()->route('users')
            ->withSuccess('Data Updated Successfully');
    }
}
