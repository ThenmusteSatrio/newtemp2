<?php

namespace App\Livewire;

use App\Models\Member as ModelsMember;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Member extends Component
{
    public $members;
    public $modalMember = false;
    public $updateMember = false;

    #[Validate('required', message: 'NIK is Required.')]
    public $nik = '';
    #[Validate('required', message: 'Nama is Required.')]
    public $nama = '';
    #[Validate('required', message: 'Username is Required.')]
    public $username = '';
    #[Validate('required', message: 'Please select Jenis Kelamin.')]
    public $jk = '';
    #[Validate('required', message: 'Please enter phone number.')]
    public $notelp = '';
    #[Validate('required', message: 'Please enter password.')]
    public $password = '';
    #[Validate('required', message: 'Alamat is Required.')]
    public $alamat = '';

    protected $listeners = ['delete', 'getUpdateData'];

    public function getUpdateData($nik)
    {
        $member = ModelsMember::find($nik);
        $this->nik = $member->nik;
        $this->nama = $member->nama;
        $this->username = $member->user;
        $this->jk = $member->jk;
        $this->notelp = $member->telp;
        $this->alamat = $member->alamat;
        $this->modalMember = true;
        $this->updateMember = true;
    }
    public function update()
    {
        $this->validate();
        $member = ModelsMember::where('nik', $this->nik)->update([
            "nik" => $this->nik,
            "nama" => $this->nama,
            "user" => $this->username,
            "jk" => $this->jk,
            "telp" => $this->notelp,
            "alamat" => $this->alamat,
            "password" => bcrypt($this->password),
        ]);
        if ($member) {
            $this->modalMember = false;
            $this->clearData();
        } else {
            session()->flash('error', 'terjadi kesalahan, coba lagi nanti');
        }
    }
    public function delete($nik)
    {
        $member = ModelsMember::find($nik);
        $member->delete();
        $this->getAllMembers();
    }
    public function clearData()
    {
        $this->reset(["username", "password", "nik", "nama", "jk", "notelp", "alamat"]);
        $this->getAllMembers();
    }

    public function register()
    {
        $this->validate();
        $member = ModelsMember::create([
            "nik" => $this->nik,
            "nama" => $this->nama,
            "user" => $this->username,
            "jk" => $this->jk,
            "telp" => $this->notelp,
            "alamat" => $this->alamat,
            "password" => bcrypt($this->password),
        ]);
        if ($member) {
            $this->modalMember = false;
            $this->clearData();
        } else {
            session()->flash('error', 'terjadi kesalahan, coba lagi nanti');
        }
    }

    public function getAllMembers()
    {
        $this->members = ModelsMember::all();
        $this->dispatch("reload");
    }
    public function mount()
    {
        $this->getAllMembers();
    }
    public function render()
    {
        return view('livewire.member')->extends('layouts.master')->section('content');
    }
}
