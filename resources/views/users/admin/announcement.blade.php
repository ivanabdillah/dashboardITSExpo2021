@extends('adminlte::page')

@section('title', 'Pengumuman')

@section('content_header')
<h1 class="d-inline">Daftar Pengumuman</h1>
@include('components/validation')
@stop

@section('content')
<div class="card mb-0">
  <div class="card-header">Pengumuman <button class="btn btn-primary float-right"  data-toggle="modal" data-target="#addPengumuman">Buat Pengumuman</button></div>
  <div class="card-body">
    @forelse ($announcements as $a)
    <div class="callout callout-info">
      <h5>@if($a['competition']) {{strtoupper($a['competition']['name'])}} @else Semua @endif - {{$a['title']}}</h5>
      <p>{{$a['content']}}</p>
      <button class="btn btn-sm btn-danger" onclick="deletePromo(this)" data-id="{{ $a['id']}}">Hapus</button>
    </div>
    @empty
        <p>Tidak ada pengumuman</p>
    @endforelse
      
  </div>
</div>

<form action="" method="POST" id="deleteForm" class="d-none">
  @csrf
  @method('DELETE')
</form>

<div class="modal fade" id="addPengumuman" tabindex="-1" role="dialog" aria-labelledby="addPengumuman" aria-hidden="true">
  <div class="modal-dialog" role="document">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title" id="addPengumuman">Buat Pengumuman</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
          </div>
          <div class="modal-body">
              <form action="{{route('admin.pengumuman.tambah')}}" method="POST">
                  @csrf
                  <div class="form-group">
                      <label for="judul">Judul</label>
                      <input type="text" class="form-control" name="title" placeholder="Judul Pengumuman" id="judul" autofocus required>
                  </div>
                  <div class="form-group">
                    <label for="content" class="form-label">Isi pengumuman</label>
                    <textarea class="form-control" id="content" name="content" rows="5" placeholder="Isi Pengumuman" required></textarea>
                  </div>
                  <div class="form-group">
                    <label for="competition" class="form-label">Kompetisi</label>
                    <select class="custom-select" id="competition" name="competition_id">
                      <option value="" selected>Semua</option>
                      @foreach ($competitions as $item)
                      <option value="{{$item['id']}}">{{strtoupper($item['name'])}}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class=" text-right mb-2">
                      <br>
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                      <button class="btn btn-primary" type="submit" onclick="return confirm('Pastikan isian benar, pengumuman tidak dapat diedit setelah dipublikasikan')">Publikasikan</button>
                  </div>
              </form>
          </div>
      </div>
  </div>
</div>

<form action="" method="POST" id="deleteForm" class="d-none">
  @csrf
  @method('DELETE')
</form>

@stop

@section('js')
<script>
  const deleteForm = document.getElementById('deleteForm');

  function deletePromo(e) {
        if (confirm('Anda yakin ingin menghapus pengumuman ini?')) {
            deleteForm.action = "{{route('admin.pengumuman')}}" + '/' + e.dataset.id;
            deleteForm.submit();
        }
    }
</script>
@stop