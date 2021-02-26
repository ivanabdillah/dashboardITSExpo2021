@extends('adminlte::page')

@section('title', 'Berkas Dikumpulkan')

@section('content_header')
<h1 class="d-inline">Berkas Dikumpulkan</h1>
@include('components/validation')
@stop

@section('content')
@if(is_null($id))
<div class="card mb-0">
  <div class="card-header">Pilih Instruksi</div>
  <div class="card-body">
    <div class="mb-3">
      <label class="form-label" for="instruksi">Instruksi</label>
      <select class="form-control form-select" id="instruksi" @if(!$instructions) disabled @endif onchange="gantiLaman(this)">
        <option disabled selected>Pilih salah satu instruksi</option>  
        @forelse ($instructions as $i)
          <option value="{{$i['id']}}">{{$i['title']}}</option>
        @empty
        @endforelse()
      </select>
    </div>
  </div>
</div>
@elseif($id)
<div class="card mb-0">
  <div class="card-header">Daftar Berkas Dikumpulkan</div>
  <div class="card-body">
    <div class="mb-3">
      <label class="form-label" for="instruksi">Instruksi</label>
      <select class="form-control form-select" id="instruksi" @if(!$instructions) disabled @endif>
        @forelse ($instructions as $i)
        @if($i['id'] == $id)
          <option value="{{$i['id']}}" selected>{{$i['title']}}</option>
        @else  
          <option value="{{$i['id']}}">{{$i['title']}}</option>
        @endif
        @empty
          <option disabled selected>Belum ada instruksi</option>  
        @endforelse()
      </select>
    </div>
    <table class=" table table-striped table-responsive-sm" id="submissionTable">
      <thead>
        <tr>
          <th>No.</th>
          <th>Tim</th>
          <th>Kompetisi</th>
          <th>Judul</th>
          <th>Deskripsi</th>
          <th>Unduh</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        @forelse($submission as $s)
        <tr>
          <td>{{ $loop->iteration }}</td>
          <td>{{ $s->team->team_name }}</td>
          <td>{{ $s->team->competition->name }}</td>
          <td>{{ $s->name }}</td>
          <td><button type="button" class="btn btn-secondary" data-toggle="tooltip" data-placement="top" title="{{$s->description}}">
            Deskripsi
          </button></td>
          <td>
            @if($s['path'])
              <form action="{{route('admin.submission.berkas')}}" method="POST">
                @csrf
                <input type="hidden" name="berkas" value="{{$s['path']}}">
                <div class="mb-3">
                  <button class="btn btn-primary" id="submissionDownload"  formtarget="_blank">Unduh Submisi</button>
                </div>
              </form>
              @endif
          </td>
          <td>
            @if($s->status == 'lolos')
              <a href="{{route('admin.submission.tidak-lolos', [$id, 'submissionId' => $s->id])}}" class="btn btn-danger">Batalkan</a>
            @elseif($s->status == 'tidak lolos')
              <a href="{{route('admin.submission.lolos', [$id, 'submissionId' => $s->id])}}" class="btn btn-success">Loloskan</a>
            @else 
              <a href="{{route('admin.submission.tidak-lolos', [$id, 'submissionId' => $s->id])}}" class="btn btn-danger">Tidak Loloskan</a>
              <a href="{{route('admin.submission.lolos', [$id, 'submissionId' => $s->id])}}" class="btn btn-success">Loloskan</a>
            @endif
          </td>
        </tr>
        @empty
        <tr>
          <td colspan="7">
            Kosong
          </td>
        </tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>

@endif

@stop
@section('js')
<script>
  $(document).ready(function() {
    $('#submissionTable').DataTable();
    $(function () {
      $('[data-toggle="tooltip"]').tooltip()
    });
  });

  function gantiLaman(e) {
    console.log(e)
    window.location.href = "{{route('admin.submission.index')}}" + '/' + e.value;
  }
</script>
@stop
@section('plugins.Datatables', true)