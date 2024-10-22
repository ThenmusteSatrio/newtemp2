<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Login extends Component
{
    public $username;
    public $password;

    public function login()
    {
        $this->validate([
            "username" => "required",
            "password" => "required",
        ]);

        if (Auth::guard("inspector")->attempt(["username" => $this->username, "password" => $this->password])) {
            if (Auth::guard("inspector")->user()->lvl == "admin") {
                return redirect("/admin/control/panel/dashboard");
            } else {
                return redirect("/petugas/control/panel/dashboard");
            }
        } else if (Auth::guard("member")->attempt(["user" => $this->username, "password" => $this->password])) {
            return redirect("/home");
        } else {
            session()->flash("error", "Username atau Password tidak ditemukan.");
        }
    }
    public function render()
    {
        return view('auth.login')->extends('layouts.master')->section('content');
    }
}
