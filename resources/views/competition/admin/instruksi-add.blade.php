@extends('adminlte::page')

@section('title', 'Instruksi')

@section('content_header')
<h1 class="d-inline">Buat Instruksi</h1>
@include('components/validation')
@stop

@section('content')
<div class="card mb-0">
  <div class="card-header">Instruksi</div>
  <div class="card-body">
    <div class="row justify-content-center">
      <div class="col-12 col-md-8">
        <form action="{{route('admin.instruksi.tambah')}}" method="POST">
          @csrf
          <div class="form-group">
              <label for="judul">Judul</label>
              <input type="text" class="form-control" name="title" placeholder="Judul Instruksi" id="judul" autofocus required>
          </div>
          <div class="form-group">
            <label for="content" class="form-label">Instruksi</label>
            <textarea class="form-control" id="content" name="content" rows="5" placeholder="Isi Instruksi"></textarea>
          </div>
          <div class="form-group">
            <label for="competition" class="form-label">Kompetisi</label>
            <select class="custom-select" id="competition" name="competition_id">
              @foreach ($competitions as $item)
              <option value="{{$item['id']}}">{{strtoupper($item['name'])}}</option>
              @endforeach
            </select>
          </div>

          <div class="form-group">
            <label for="competition" class="form-label">Ketergantungan Kelulusan</label>
            <select class="custom-select" id="competition" name="dependency_id">
              <option value="" selected>Tidak ada</option>
              @foreach ($instructions as $item)
              <option value="{{$item['id']}}">{{$item['title']}}</option>
              @endforeach
            </select>
          </div>
          <div class=" text-right mb-2">
              <br>
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
              <button class="btn btn-primary" type="submit">Tambahkan</button>
          </div>
      </form> 
      </div>
    </div> 
  </div>
</div>

@stop

@section('js')
<script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
<script>
  tinymce.init({
      selector: 'textarea#content',
      height : 300,
      plugins : 'advlist link lists',
      relative_urls : false,
      convert_urls : false
  });
</script>
@stop