<?php

namespace App\Livewire;

use App\Models\Pinjam;
use App\Models\Pengembalian;
use Livewire\Component;
use Livewire\WithPagination;

class KembaliComponent extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $id, $judul, $member, $tglkembali, $selisihString, $status, $lama;
    public function render()
{
    $pinjam = Pinjam::where('status', 'pinjam')->paginate(10);
    $pengembalian = Pengembalian::paginate(10); // Mengambil data pengembalian
    
    return view('livewire.kembali-component', compact('pinjam', 'pengembalian')) // Mengirim kedua variabel ke view
        ->with('tittle', 'Pengembalian Buku');
}
    public function pilih($id)
    {
        $pinjam = Pinjam::find($id);
        $this->judul = $pinjam->buku->judul;
        $this->member = $pinjam->user->nama;
        $this->tglkembali = $pinjam->tgl_kembali;
        $this->id=$pinjam->id;
        
        $kembali = new \DateTime($this->tglkembali);
        $today = new \DateTime();
        $selisih = $today->diff($kembali);
        // $this->status=$selisih->invert;
        if($selisih->invert== 1){
            $this->status=true;
        }
        else{
            $this->status= false;
        }
        $this->lama= $selisih->d;
    }
    public function store(){
        // Cek apakah pengembalian sudah ada untuk pinjam_id ini
        $existingPengembalian = Pengembalian::where('pinjam_id', $this->id)->first();
    
        if ($existingPengembalian) {
            session()->flash('error', 'Buku ini sudah dikembalikan sebelumnya!');
            return;
        }
    
        // Jika status terlambat, hitung denda
        if ($this->status == true) {
            $denda = $this->lama * 2000;
        } else {
            $denda = 0;
        }
    
        // Buat pengembalian baru
        Pengembalian::create([
            'pinjam_id' => $this->id,
            'tgl_kembali' => date('Y-m-d'),
            'denda' => $denda,
        ]);
    
        // Update status pinjam menjadi 'kembali'
        $pinjam = Pinjam::find($this->id);
        $pinjam->update([
            'status' => 'kembali'
        ]);
    
        // Reset data dan beri pesan sukses
        $this->reset();
        session()->flash('success', 'Berhasil Proses Data');
        return redirect()->route('kembali');
    }
    
}