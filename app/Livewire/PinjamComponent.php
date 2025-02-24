<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\User;
use App\Models\Buku;
use App\Models\Pinjam;

class PinjamComponent extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $id, $user, $buku, $tgl_pinjam, $tgl_kembali;

    public function render()
    {
        $data['member'] = User::where('jenis', 'member')->get();
        $data['book'] = Buku::all();
        $data['pinjam'] = Pinjam::paginate(10);
        $layout['title'] = 'Pinjam Buku';
        return view('livewire.pinjam-component', $data)->with($layout);
    }
    public function store()
    {
        $this->validate([
            'buku' => 'required',
            'user' => 'required',
        ], [
            'buku.required' => 'Buku Harus Dipilih',
            'user.required' => 'Member Harus Dipilih'
        ]);
        $this->tgl_pinjam = date('Y-m-d');
        $this->tgl_kembali = date('Y-m-d', strtotime($this->tgl_pinjam . ' +7 days'));

        Pinjam::create([
            'user_id' => $this->user,
            'buku_id' => $this->buku,
            'tgl_pinjam' => $this->tgl_pinjam,
            'tgl_kembali' => $this->tgl_kembali,
            'status' => 'pinjam'
        ]);
        $this->reset();
        session()->flash('success', 'Berhasil Proses Data!');
        return redirect()->route('pinjam');
    }
    public function update()
    {
        $pinjam = Pinjam::find($this->id);
        $this->tgl_pinjam = date('Y-m-d');
        $this->tgl_kembali = date('Y-m-d', strtotime($this->tgl_pinjam . ' +7 days'));

        $pinjam->update([
            'user_id' => $this->user,
            'buku_id' => $this->buku,
            'tgl_pinjam' => $this->tgl_pinjam,
            'tgl_kembali' => $this->tgl_kembali,
            'status' => 'pinjam'
        ]);
        $this->reset();
        session()->flash('success', 'Berhasil Ubah Data!');
        return redirect()->route('pinjam');
    }
    public function confirm($id)
    {
        $this->id = $id;
    }
    public function destroy()
    {
        $pinjam = Pinjam::find($this->id);
        $pinjam->delete();
        $this->reset();
        session()->flash('success', 'Berhasil Hapus Data!');
        return redirect()->route('pinjam');
    }
    public function edit($id)
    {
        $pinjam = Pinjam::find($id);
        $this->id = $pinjam->id;
        $this->user = $pinjam->user_id;
        $this->buku = $pinjam->buku_id;
        $this->tgl_pinjam = $pinjam->tgl_pinjam;
        $this->tgl_kembali = $pinjam->tgl_kembali;
    }
}
