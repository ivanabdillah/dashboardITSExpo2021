@extends('adminlte::page')

@section('title', 'Pembayaran')

@section('content_header')
<h1 class="d-inline">Pembayaran</h1>
@include('components/validation')
@stop

@section('content')
<div class="card mb-0">
  <div class="card-header">Pembayaran</div>
  <div class="text-center">
    <div class="btn-group mx-3 my-2" role="group">
      <a href="{{route('admin.pembayaran')}}" class="btn btn-outline-primary @if(!$filter) active @endif">Semua</a>
      <a href="{{route('admin.pembayaran', 'sudah')}}"
          class="btn btn-outline-primary @if($filter && $filter == 'sudah') active @endif">Terverifikasi</a>
      <a href="{{route('admin.pembayaran', 'belum')}}"
          class="btn btn-outline-primary @if($filter && $filter == 'belum') active @endif">Belum Diverifikasi</a>
    </div>
  </div>
  <div class="card-body pt-0">
    <table class=" table table-striped table-responsive-sm" id="invoiceTable">
      <thead>
        <tr>
          <th>No.</th>
          <th>Nama Tim</th>
          <th>Email</th>
          <th>Kompetisi</th>
          <th>Jumlah Dibayar</th>
          <th>Detail</th>
          <th>Bukti</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        @forelse($invoices as $invoice)
        <tr>
          <td>{{ $loop->iteration }}</td>
          <td>{{$invoice['team']['team_name'] . ' - ' . $invoice['team']['college_name']}}</td>
          <td>{{$invoice['team']['user']['email']}}</td>
          <td>{{strtoupper($invoice['team']['competition']['name'])}}</td>
          @if($invoice['promo'])
          <td>{{"Rp " . number_format($invoice['team']['competition']['price'] - $invoice['promo']['discount'],2,',','.') . ' (' . $invoice['promo']['name'] .')'}}</td>
          @else
          <td>{{"Rp " . number_format($invoice['team']['competition']['price'],2,',','.') . '-' . ' (tanpa promo)'}}</td>
          @endif
          <td><a href="{{route('admin.peserta', $invoice['team']['id'])}}" class="btn btn-primary">Detail</a></td>
          <td>
            <a href="{{route('admin.pembayaran.berkas-bukti', $invoice['team_id'])}}" target="_blank"
              class="btn btn-success">Lihat</a>
          </td>
          @if($invoice['approver_id'] and $invoice['approved_at'])
          <td>
            <a class="btn btn-danger"
              href="{{route('admin.pembayaran.unverif', $invoice['id'])}}">Un-Verifikasi</a>
          </td>
          @else
          @if($invoice['payment_proof'])
          <td>
            <a class="btn btn-warning"
              href="{{route('admin.pembayaran.verif', $invoice['id'])}}">Verifikasi</a>
          </td>
          @else
          <td>
            <p>Tidak ada bukti</p>
          </td>
          @endif
          @endif
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

@stop
@section('js')
<script>
  $(document).ready(function() {
    $('#invoiceTable').DataTable();
  });
</script>
@stop
@section('plugins.Datatables', true)