@extends('adminlte::page')

@section('title', 'Pembayaran')

@section('content_header')
<h1 class="d-inline">Pembayaran</h1>
@include('components/validation')
@stop

@section('content')
<div class="card mb-0">
  <div class="card-header">Pembayaran</div>
  <div class="card-body">
    <table class=" table table-striped table-responsive-sm" id="invoiceTable">
      <thead>
        <tr>
          <th>No.</th>
          <th>Nama Tim</th>
          <th>Kompetisi</th>
          <th>Bukti</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        @forelse($invoices as $invoice)
        <tr>
          <td>{{ $loop->iteration }}</td>
          <td>{{$invoice['team']['team_name'] . ' - ' . $invoice['team']['college_name']}}</td>
          <td>{{strtoupper($invoice['team']['competition']['name'])}}</td>
          <td>
            <a href="{{route('admin.pembayaran.berkas-bukti', $invoice['team_id'])}}" target="_blank"
              class="btn btn-primary">Lihat</a>
          </td>
          @if($invoice['approver_id'] and $invoice['approved_at'])
          <td>
            <p class="text-success">Terverifikasi</p>
          </td>
          @else
          @if($invoice['payment_proof'])
          <td>
            <a class="btn btn-success text-white"
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
          Tidak ada Data
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