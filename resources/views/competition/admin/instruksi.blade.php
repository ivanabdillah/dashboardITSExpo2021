@extends('adminlte::page')

@section('title', 'Instruksi')

@section('content_header')
<h1 class="d-inline">Daftar Instruksi</h1>
@include('components/validation')
@stop

@section('content')
<div class="card mb-0">
  <div class="card-header">Daftar Instruksi <a class="btn btn-primary text-white float-right" href="{{route('admin.instruksi.baru')}}">Buat</a></div>
  <div class="card-body">
    <table class=" table table-striped table-responsive-sm" id="instruksiTable">
      <thead>
        <tr>
          <th>No.</th>
          <th>Cabang</th>
          <th>Judul</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        @forelse($instructions as $i)
        <tr>
          <td>{{ $loop->iteration }}</td>
          <td>{{ strtoupper($i->competition->name) }}</td>
          <td>{{ $i->title }}</td>
          <td>
            <button class="btn btn-primary" onclick="togglePublikasi(this)" data-id="{{ $i->id}}">@if($i->is_open) Tutup @else Publikasikan @endif</button>
            <a class="btn btn-success text-white" href="{{route('admin.instruksi.edit', $i->id)}}">Edit</a>
            <button class="btn btn-danger" onclick="deleteInstruksi(this)" data-id="{{ $i->id}}">Hapus</button>
          </td>
        </tr>
        @empty
        <tr>
          <td colspan="4">
            Kosong
          </td>
        </tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>


<form action="" method="POST" id="deleteForm" class="d-none">
  @csrf
  @method('DELETE')
</form>


<form action="" method="POST" id="publishForm" class="d-none">
  @csrf
  @method('PUT')
</form>

@stop
@section('js')
<script>
  $(document).ready(function() {
    $('#instruksiTable').DataTable();
  });
  const deleteForm = document.getElementById('deleteForm');
  const publishForm = document.getElementById('publishForm');

  function togglePublikasi(e) {
          publishForm.action = "{{route('admin.instruksi')}}" + '/' + e.dataset.id + '/toggle';
          publishForm.submit();
    }
    function deleteInstruksi(e) {
        if (confirm('Anda yakin ingin menghapus instruksi ini? Tindakan ini akan menghapus seluruh submisi terkait instruksi ini')) {
            deleteForm.action = "{{route('admin.instruksi')}}" + '/' + e.dataset.id;
            deleteForm.submit();
        }
    }
</script>
@stop
@section('plugins.Datatables', true)