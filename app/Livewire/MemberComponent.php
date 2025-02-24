<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class MemberComponent extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $nama, $telepon, $email, $alamat, $password, $cari, $id;

    public function render()
{
    if ($this->cari != "") {
        $members = User::where('jenis', 'member')
            ->where('nama', 'like', '%' . $this->cari . '%')
            ->paginate(10);
    } else {
        $members = User::where('jenis', 'member')->paginate(10);
    }

    $layout['title'] = 'Kelola Member';

    return view('livewire.member-component', [
        'member' => $members,
        'layout' => $layout,
    ]);
}
    public function store()
    {
        $this->validate([
            'nama' => 'required',
            'telepon' => 'required',
            'email' => 'required'. $this->id,
            'alamat' => 'required'
        ], [
            'nama.required' => 'Nama Lengkap Tidak Boleh Kosong!',
            'telepon.required' => 'Telepon Tidak Boleh Kosong!',
            'email.required' => 'Email Tidak Boleh Kosong!',
            'email.unique' => 'Email sudah terdaftar!',
            'alamat.required' => 'Alamat Tidak Boleh Kosong!'
        ]);        
        User::create([
            'nama' => $this->nama,
            'alamat' => $this->alamat,
            'telepon' => $this->telepon,
            'email' => $this->email,
            'jenis' => 'member'
        ]);

        session()->flash('success', 'Berhasil Simpan!');
        return redirect()->route('member');
    }
    public function edit($id)
{
    $member = User::find($id);
    if (!$member) {
        session()->flash('error', 'Member tidak ditemukan!');
        return redirect()->route('member');
    }

    $this->id = $member->id;
    $this->nama = $member->nama;
    $this->alamat = $member->alamat;
    $this->telepon = $member->telepon;
    $this->email = $member->email;
}
    public function update()
{
    $this->validate([
        'nama' => 'required',
        'telepon' => 'required',
        'email' => 'required|unique:users,email,' . $this->id,  // Perbaikan di sini
        'alamat' => 'required'
    ], [
        'nama.required' => 'Nama Lengkap Tidak Boleh Kosong!',
        'telepon.required' => 'Telepon Tidak Boleh Kosong!',
        'email.required' => 'Email Tidak Boleh Kosong!',
        'email.unique' => 'Email sudah terdaftar!',
        'alamat.required' => 'Alamat Tidak Boleh Kosong!'
    ]);

    $member = User::find($this->id);
    $member->update([
        'nama' => $this->nama,
        'alamat' => $this->alamat,
        'telepon' => $this->telepon,
        'email' => $this->email,
        'jenis' => 'member'
    ]);
    session()->flash('success', 'Berhasil Ubah!');
    return redirect()->route('member');
}
    public function confirm($id)
    {
        $this->id = $id;
    }
    public function destroy()
    {
        $member = User::find($this->id);
        $member->delete();
        session()->flash('success', 'Berhasil Hapus');
        return redirect()->route('member');
    }
}