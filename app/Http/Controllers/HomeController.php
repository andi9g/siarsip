<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\arsipM;
use App\Models\bagikanM;
use App\Models\User;
use Auth;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $iduser = Auth::user()->iduser;
        $arsipku = arsipM::where("iduser", $iduser)->count();
        $bagikan = bagikanM::where("iduser", $iduser)->count();
        $arsip = arsipM::count();
        $user = User::count();
        return view('home', [
            "arsip" => $arsip,
            "user" => $user,
            "arsipku" => $arsipku,
            "bagikan" => $bagikan,
        ]);
    }
}
