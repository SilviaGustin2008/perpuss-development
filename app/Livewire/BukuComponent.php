<?php

namespace App\Livewire;

use App\Models\Buku;
use App\Models\Kategori;
use Livewire\Component;
use Livewire\WithPagination;

class BukuComponent extends Component
{
    use WithPagination;
    protected $paginationTheme='bootstrap';
    public $id, $judul, $kategori, $penulis, $penerbit, $isbn, $jumlah, $tahun, $cari;
    public function render()
    {
        if($this->cari!=''){
            $data['buku']=Buku::where('judul','like','%'.$this->cari.'%')->paginate(10);
        }
        else{
            $data['buku']=Buku::paginate(10);
        }
        $data['category'] = Kategori::all();
        $layout['title']='Kelola Buku';
        return view('livewire.buku-component',$data)->with($layout);
    }
    public function store()
    {
        $this->validate([
            'judul' => 'required',
            'kategori' => 'required',
            'penulis' => 'required',
            'penerbit' => 'required',
            'isbn' => 'required',
            'jumlah' => 'required',
            'tahun' => 'required',
        ]);
    
        logger([
            'judul' => $this->judul,
            'kategori' => $this->kategori,
            'penulis' => $this->penulis,
            'penerbit' => $this->penerbit,
            'isbn' => $this->isbn,
            'jumlah' => $this->jumlah,
            'tahun' => $this->tahun,
        ]);
        
        Buku::create([
            'judul' => $this->judul,
            'kategori_id' => $this->kategori,
            'penulis' => $this->penulis,
            'penerbit' => $this->penerbit,
            'isbn' => $this->isbn,
            'jumlah' => $this->jumlah,
            'tahun' => $this->tahun,
        ]);
        $this->reset();  
        session()->flash('success', 'Buku berhasil ditambahkan!');
        return redirect()->route('buku');
    }    
    public function edit($id){
        $buku=Buku::find($id);
        $this->id=$buku->id;
        $this->judul=$buku->judul;
        $this->kategori=$buku->kategori->id;
        $this->penulis=$buku->penulis;
        $this->penerbit=$buku->penerbit;
        $this->tahun=$buku->tahun;
        $this->isbn=$buku->isbn;
        $this->jumlah=$buku->jumlah;
    }
    public function update(){
        $buku=Buku::find($this->id);
        $buku->update([
            'judul' => $this->judul,
            'kategori_id' => $this->kategori,
            'penulis' => $this->penulis,
            'penerbit' => $this->penerbit,
            'isbn' => $this->isbn,
            'jumlah' => $this->jumlah,
            'tahun' => $this->tahun,
        ]);
        $this->reset();
        session()->flash('success','Berhasil Ubah!');
        return redirect()->route('buku');
    }
    public function confirm($id)
    {
        $this->id=$id;
    }
    public function destroy(){
        $buku=Buku::find($this->id);
        $buku->delete();
        $this->reset();
        session()->flash('success','Berhasil Hapus!');
        return redirect()->route('buku');
    }
}
