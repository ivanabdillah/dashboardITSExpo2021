@extends('adminlte::page')

@section('title', 'Instruksi')

@section('content_header')
<h1 class="d-inline">Edit Instruksi</h1>
@include('components/validation')
@stop

@section('content')
<div class="card mb-0">
  <div class="card-header">Instruksi</div>
  <div class="card-body">
    <div class="row justify-content-center">
      <div class="col-12 col-md-8">
        <form action="{{route('admin.instruksi.update', $instruction->id)}}" method="POST">
          @csrf
          @method('PUT')
          <div class="form-group">
              <label for="judul">Judul</label>
              <input type="text" class="form-control" name="title" placeholder="Judul Instruksi" id="judul" value="{{$instruction->title}}" autofocus required>
          </div>
          <div class="form-group">
            <label for="content" class="form-label">Instruksi</label>
            <textarea class="form-control" id="content" name="content" rows="5" placeholder="Isi Instruksi">{!!$instruction->content!!}</textarea>
          </div>
          <div class="form-group">
            <label for="competition" class="form-label">Kompetisi</label>
            <select class="custom-select" id="competition" name="competition_id">
              @foreach ($competitions as $item)
              @if($item['id'] == $instruction['competition_id'])
              <option value="{{$item['id']}}" selected>{{strtoupper($item['name'])}}</option>
              @else
              <option value="{{$item['id']}}">{{strtoupper($item['name'])}}</option>
              @endif
              @endforeach
            </select>
          </div>

          <div class="form-group">
            <label for="competition" class="form-label">Ketergantungan Kelulusan</label>
            <select class="custom-select" id="competition" name="dependency_id">
              <option value="" selected>Tidak ada</option>
              @foreach ($instructions as $item)
              @if($item['id'] == $instruction['dependency_id'])
              <option value="{{$item['id']}}" selected>{{strtoupper($item['title'])}}</option>
              @else
              <option value="{{$item['id']}}">{{$item['title']}}</option>
              @endif
              @endforeach
            </select>
          </div>
          <div class=" text-right mb-2">
              <br>
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
              <button class="btn btn-primary" type="submit">Simpan</button>
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