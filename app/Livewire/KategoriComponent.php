<?php

namespace App\Livewire;

use App\models\Kategori;
use Livewire\Component;
use Livewire\WithPagination;

class KategoriComponent extends Component
{
    use WithPagination;
    protected $paginationTheme='bootstrap';
    public $nama,$id,$deskripsi,$cari;
    public function render()
    {
        if($this->cari!=""){
            $data['kategori']=Kategori::where('nama','like','%'.$this->cari.'%')->paginate(10);
        }
        else{
            $data['kategori']=Kategori::paginate(10);
        }
        $layout['tittle']='Kelola Kategori Buku';
        return view('livewire.kategori-component',$data)->with($layout);
    }
    public function store(){
        $this->validate([
            'nama' =>'required',
            'deskripsi' =>'required'
        ],[
            'nama.required'=>'Nama Kategori Tidak Boleh Kosong!',
            'deskripsi.required'=>'Deskripsi Tidak Boleh Kosong!'
        ]);
        Kategori::create([
            'nama'=>$this->nama,
            'deskripsi'=>$this->deskripsi
        ]);
        $this->reset();
        session()->flash('success','Berhasil Simpan!');
        return redirect()->route('kategori');
    }
    public function edit($id){
        $kategori=Kategori::find($id);
        $this->id=$kategori->id;
        $this->nama=$kategori->nama;
        $this->deskripsi=$kategori->deskripsi;
    }
    public function update(){
        $kategori=Kategori::find($this->id);
        $kategori->update([
            'nama'=>$this->nama,
            'deskripsi'=>$this->deskripsi
        ]);
        $this->reset();
        session()->flash('succes','Berhasil Ubah!');
        return redirect()->route('kategori');
    }
    public function confirm($id){
        $this->id= $id;
    }public function destroy(){
     $kategori=Kategori::find($this->id);
     $kategori->delete();
     $this->reset();
     session()->flash('success','Berhasil Hapus!');
     return redirect()->route('kategori');
    }
}
