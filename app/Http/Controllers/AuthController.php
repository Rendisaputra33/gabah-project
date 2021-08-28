<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    /**
     * function geting user
     * @param id
     */
    public function getUser($id)
    {
        $user = User::where('email', $id)->first();

        return ['status' => 'ok', 'data' => $user];
    }

    /**
     * function call viewregister
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function viewLogin()
    {
        return view('register', ['title' => 'Halaman | Login']);
    }

    /**
     * function proceesing login
     * @param Request
     */
    public function Login(Request $req)
    {
        $validate = $this->getUser($req->email);

        if ($validate['data'] == null) {
            return response()->json(['pesan' => 'email tidak terdaftar']);
        }

        $this->createSession($req, $validate['data']);

        return password_verify($req->password, $validate['data']['password'])
            ? response()->json(['pesan' => 'login sukses', 'role' => $validate['data']['level']])
            : response()->json(['pesan' => 'login gagal']);
    }

    /**
     * function proceesing register
     * @param Request
     * @return json data
     */
    public function Register($req)
    {
        $validate = User::insert($req);

        return $validate
            ? redirect('/admin')->with('success', 'user berhasil di tambahkan')
            : redirect('/admin')->with('error', 'user gagal ditambahkan');
    }

    /**
     * function create session
     * @param Request
     * @return void
     */
    public function createSession($req, $validate)
    {
        $req->session()->put('username', $validate['name']);
        $req->session()->put('email', $validate['email']);
        $req->session()->put('user_id', $validate['id']);
        $req->session()->put('level', $validate['level']);
    }
    /**
     * @return redirect
     */
    public function Logout()
    {
        if (session()->has('username')) {
            session()->pull('username');
            session()->pull('email');
            session()->pull('user_id');
            session()->pull('level');
        }
        return redirect('/');
    }
}
