<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;

class Petugas extends Component
{
    protected $listeners = ["delete" => "delete", "getUpdateData" => "getUpdateData", "clearData" => "clearData"];
    public $petugas;
    public $id;
    public $user = '';
    public $password = '';
    public $level = "petugas";

    public $modalPetugas = false;
    public $updatePetugas = false;


    public function update($id)
    {
        $petugas = User::where("id", $id)->first();
        $alreadyUsed = User::where('username', $this->user)->first();
        if ($alreadyUsed) {
            session()->flash("error", "Username sudah digunakan");
        } else {
            if ($this->password == "*" || $this->password == "**" || $this->password == "***") {
                $petugas->update([
                    "username" => $this->user
                ]);
            } else {
                $petugas->update([
                    "username" => $this->user,
                    "password" => $this->password
                ]);
            }
            $this->modalPetugas = false;
            $this->updatePetugas = false;
            $this->getAllPetugas();
        }
    }
    public function delete($id)
    {
        $petugas = User::find($id);
        $petugas->delete();
        $this->getAllPetugas();
    }
    public function store()
    {
        $this->updatePetugas = false;
        $this->validate([
            "user" => "required",
            "password" => "required",
        ]);

        $alreadyUsed = User::where('username', $this->user)->first();
        if ($alreadyUsed) {
            session()->flash("error", "Username sudah digunakan");
        } else {
            $result = User::create([
                'username' => $this->user,
                'password' => $this->password,
                'lvl' => "petugas"
            ]);

            if ($result) {
                $this->modalPetugas = false;
                $this->reset(["user", "password"]);
                $this->getAllPetugas();
                $this->dispatch("reload");
            } else {
                session()->flash("error", "terjadi kesalahan, silahkan coba lagi nanti");
            }
        }
    }
    public function showTambahPetugas()
    {
        $this->modalPetugas = true;
        $this->updatePetugas = false;
        $this->dispatch("reload");
    }

    public function getUpdateData($id)
    {
        $petugas = User::where("id", $id)->first();
        $this->id = $petugas->id;
        $this->user = $petugas->username;
        $this->password = "***";
        $this->dispatch("reload");
        $this->modalPetugas = true;
        $this->updatePetugas = true;
    }

    public function clearData()
    {
        $this->reset(["user", "password"]);
        $this->getAllPetugas();
    }

    public function getAllPetugas()
    {
        $this->petugas = User::where('lvl', 'petugas')->get();
        $this->dispatch("reload");
    }
    public function mount()
    {
        $this->petugas = User::where('lvl', 'petugas')->get();
    }
    public function render()
    {
        return view('livewire.petugas')->extends('layouts.master')->section('content');
    }
}
