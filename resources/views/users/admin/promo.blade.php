@extends('adminlte::page')

@section('title', 'Promo')

@section('content_header')
<h1 class="d-inline">Daftar Promo</h1>
@include('components/validation')
@stop

@section('content')
<div class="card mb-0">
  <div class="card-header">Daftar Promo <button class="btn btn-primary float-right"  data-toggle="modal" data-target="#addPromo">Tambah</button></div>
  <div class="card-body">
    <table class=" table table-striped table-responsive-sm" id="promoTable">
      <thead>
        <tr>
          <th>No.</th>
          <th>Kode</th>
          <th>Nilai</th>
          <th>Mulai</th>
          <th>Akhir</th>
          <th>Jumlah Pemakai</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        @forelse($promos as $promo)
        <tr>
          <td>{{ $loop->iteration }}</td>
          <td>{{ $promo->name }}</td>
          <td>{{ $promo->discount }}</td>
          <td>{{ $promo->start->locale('id')->isoFormat('dddd, LL') }}</td>
          <td>{{ $promo->end->locale('id')->isoFormat('dddd, LL') }}</td>
          <td>
            {{ $promo->invoice_count }}
          </td>
          <td>
            <button class="btn btn-success" onclick="editPromo(this)" data-id="{{ $promo['id']}}" data-promo="{{$promo['name']}}" data-discount="{{$promo['discount']}}" data-start="{{$promo['start']->format('Y-m-d')}}" data-end="{{$promo['end']->format('Y-m-d')}}">Edit</button>
            <button class="btn btn-danger" onclick="deletePromo(this)" data-id="{{ $promo['id']}}">Hapus</button>
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

<form action="" method="POST" id="deleteForm" class="d-none">
  @csrf
  @method('DELETE')
</form>

<div class="modal fade" id="addPromo" tabindex="-1" role="dialog" aria-labelledby="addPromo" aria-hidden="true">
  <div class="modal-dialog" role="document">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title" id="addPromo">Tambah Promo</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
          </div>
          <div class="modal-body">
              <form action="{{route('admin.promo.tambah')}}" method="POST">
                  @csrf
                  <div class="form-group">
                      <label for="kode">Kode Promo</label>
                      <input type="text" class="form-control" name="name" placeholder="ex: earlybird113" id="kode" autofocus required>
                      <small class="form-text text-primary">Gunakan kata non kapital tanpa spasi. Contoh: earlybird113.</small>
                  </div>
                  <div class="form-group">
                    <label for="nilai">Nilai Promo</label>
                    <input type="number" class="form-control" name="discount" id="nilai" placeholder="ex: 100000" min="1000" required>
                </div>
                <div class="form-group">
                  <label for="mulai">Tanggal Mulai</label>
                  <input type="date" class="form-control" name="start" id="mulai" required>
                </div>
                <div class="form-group">
                  <label for="end">Tanggal Selesai</label>
                  <input type="date" class="form-control" name="end" id="end" required>
                </div>
                <div class=" text-right mb-2">
                    <br>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button class="btn btn-success" type="submit">Tambah Promo</button>
                </div>
              </div>
              </form>
          </div>
      </div>
  </div>
</div>


<div class="modal fade" id="editPromo" tabindex="-1" role="dialog" aria-labelledby="editPromo" aria-hidden="true">
  <div class="modal-dialog" role="document">
      <div class="modal-content">
          <div class="modal-header">
              <div>
                  <h5 class="modal-title" id="editPromo">Ubah Promo</h5>
              </div>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
          </div>
          <div class="modal-body">
              <form action="" method="POST" id="editForm">
                  @csrf
                  @method('PUT')
                  <input type="hidden" name="id" id="editId">
                  <div class="form-group">
                    <label for="editKode">Kode Promo</label>
                    <input type="text" class="form-control" placeholder="ex: earlybird113" id="editKode" required disabled>
                  </div>
                  <div class="form-group">
                    <label for="editNilai">Nilai Promo</label>
                    <input type="number" class="form-control" id="editNilai" placeholder="ex: 100000" min="1000" required disabled>
                  </div>
                  <div class="form-group">
                    <label for="editMulai">Tanggal Mulai</label>
                    <input type="date" class="form-control" name="start" id="editMulai" autofocus required>
                  </div>
                  <div class="form-group">
                    <label for="editEnd">Tanggal Selesai</label>
                    <input type="date" class="form-control" name="end" id="editEnd" required>
                  </div>
                  <div class=" text-right mb-2">
                      <br>
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                      <button class="btn btn-success" type="submit">Simpan</button>
                  </div>
              </form>
          </div>
      </div>
  </div>
</div>


@stop
@section('js')
<script>
  $(document).ready(function() {
    $('#promoTable').DataTable();
  });
  const deleteForm = document.getElementById('deleteForm');
  const editForm = document.getElementById('editForm');

  function deletePromo(e) {
        if (confirm('Anda yakin ingin menghapus promo ini?')) {
            deleteForm.action = "{{route('admin.promo')}}" + '/' + e.dataset.id;
            deleteForm.submit();
        }
    }

  function editPromo(e) {
        editForm.action = "{{route('admin.promo')}}" + '/' + e.dataset.id;
        editForm.querySelector('#editId').value = e.dataset.id;
        editForm.querySelector('#editKode').value = e.dataset.promo;
        editForm.querySelector('#editNilai').value = e.dataset.discount;
        editForm.querySelector('#editMulai').value = e.dataset.start;
        editForm.querySelector('#editEnd').value = e.dataset.end;
        $('#editPromo').modal()
  }
</script>
@stop
@section('plugins.Datatables', true)