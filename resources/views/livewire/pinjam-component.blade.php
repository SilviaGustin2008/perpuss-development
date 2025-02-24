<div>
<div class="card">
  <div class="card-header">
    Pinjam Buku
  </div>
  <div class="card-body">
    @if (session()->has('success'))
    <div class="alert alert-success" role="alert">
      {{session('success')}}
</div>
    @endif
  <div class="table-responsive">
  <table class="table">
  <thead>
    <tr>
      <th scope="col">No</th>
      <th scope="col">Buku</th>
      <th scope="col">Member</th>
      <th scope="col">Tanggal Pinjam</th>
      <th scope="col">Tanggal Kembali</th>
      <th scope="col">Status</th>
      <th>Proses</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($pinjam as $data)
    <tr>
      <th scope="row">{{ $loop->iteration }}</th>
      <td>{{ $data->buku->judul }}</td>
      <td>{{ $data->user->nama }}</td>
      <td>{{ $data->tgl_pinjam }}</td>
      <td>{{ $data->tgl_kembali }}</td>
      <td>{{ $data->status }}</td>
      <td>
      <a href="#" wire:click="edit({{ $data->id }})" class="btn btn-sm btn-info" data-toggle="modal" data-target="#editPage">Ubah</a>
          <a href="#" wire:click="confirm({{ $data->id }})" data-toggle="modal" data-target="#deletePage"
           class="btn btn-sm btn-danger">Hapus</a>
      </td>
    </tr>
    @endforeach
    
  </tbody>
</table>
{{ $pinjam->links() }}
</div>
     <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#addPage">Tambah</a>
  </div>
</div>
{{-- Tambah --}}
<div wire:ignore.self class="modal fade" id="addPage" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Pinjam Buku</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form>
        <div class="form-group">
            <label>Judul Buku</label>
            <select wire:model="buku" class="form-control">
                <option value="">--Pilih--</option>
                @foreach ( $book as $data)
                <option value="{{$data->id}}">{{ $data->judul }}</option>
                @endforeach
            </select>
            @error('buku')
            <small class="form-text text-danger">{{ $message }}</small>
            @enderror
          </div>
<div class="form-group">
            <label>Member</label>
            <select wire:model="user" class="form-control">
                <option value="">--Pilih--</option>
                @foreach ( $member as $data)
                <option value="{{$data->id}}">{{ $data->nama }}</option>
                @endforeach
            </select>
            @error('user')
            <small class="form-text text-danger">{{ $message }}</small>
            @enderror
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" wire:click="store" class="btn btn-primary">Save</button>
      </div>
    </div>
  </div>
</div>
{{-- Edit --}}
<div wire:ignore.self class="modal fade" id="editPage" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Ubah Pinjam Buku</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form>
        <div class="form-group">
            <label>Judul Buku</label>
            <select wire:model="buku" class="form-control">
                <option value="">--Pilih--</option>
                @foreach ( $book as $data)
                <option value="{{$data->id}}">{{ $data->judul }}</option>
                @endforeach
            </select>
            @error('buku')
            <small class="form-text text-danger">{{ $message }}</small>
            @enderror
          </div>
<div class="form-group">
            <label>Member</label>
            <select wire:model="user" class="form-control">
                <option value="">--Pilih--</option>
                @foreach ( $member as $data)
                <option value="{{$data->id}}">{{ $data->nama }}</option>
                @endforeach
            </select>
            @error('user')
            <small class="form-text text-danger">{{ $message }}</small>
            @enderror
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" wire:click="update" class="btn btn-primary">Save</button>
      </div>
    </div>
  </div>
</div>
{{-- Delete --}}
<div wire:ignore.self class="modal fade" id="deletePage" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Hapus Pinjam Buku</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Yakin Hapus Data?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" wire:click="destroy" class="btn btn-primary"
        data-dismiss="modal">Yes</button>
      </div>
    </div>
  </div>
</div>
</div>
