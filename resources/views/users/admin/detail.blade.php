@extends('adminlte::page')

@section('title', 'Detail')

@section('content_header')
<h1 class="d-inline">Detail</h1>
@include('components/validation')
@stop

@section('content')
<div class="card mb-0">
  <div class="card-header">Detail</div>
  <div class="card-body">
    <div class="row justify-content-center">
      <div class="col-12 col-md-6">
          <h4 class="text-center">Detail Tim {{$peserta['team_name']}}</h4>
          <div class="mb-3">
            <label class="form-label" for="email">Alamat Email</label>
            <input type="email" class="form-control" id="email" value="{{$peserta['user']['email']}}" required disabled>
          </div>
          <div class="mb-3">
            <label class="form-label" for="namaTim">Nama Tim</label>
            <input type="text" class="form-control" id="namaTim" value="{{$peserta['team_name']}}" required
              disabled>
          </div>
          <div class="mb-3">
            <label class="form-label" for="namaPt">Asal Perguruan Tinggi</label>
            <input type="text" class="form-control" id="namaPt" value="{{$peserta['college_name']}}" required
              disabled>
          </div>
          <div class="mb-3">
            <label class="form-label" for="competition">Kompetisi</label>
            <select class="form-control form-select" id="competition" disabled>
              <option>{{strtoupper($peserta['competition']['name'])}}</option>
            </select>
          </div>
          <hr>
          <h4 class="text-center">Ketua</h4>
          <div id="ketua">
            <div class="mb-3">
              <label class="form-label" for="namaKetua">Nama</label>
              <input type="text" class="form-control" id="namaKetua" name="ketua[nama]"
                value="{{$peserta['ketua']['name']}}" required disabled>
            </div>
            <div class="mb-3">
              <label class="form-label" for="jurusanKetua">Jurusan / Departemen / Program Studi</label>
              <input type="text" class="form-control" id="jurusanKetua" name="ketua[jurusan]"
                     value="{{$peserta['ketua']['majors']}}" required disabled>
            </div>
            <div class="mb-3">
              <label class="form-label" for="angkatanKetua">Tahun Angkatan</label>
              <input type="text" class="form-control" id="angkatanKetua" name="ketua[angkatan]"
                     value="{{$peserta['ketua']['year']}}" required disabled>
            </div>
            <div class="mb-3">
              <label class="form-label" for="nomorKetua">Nomor Telepon</label>
              <input type="text" class="form-control" id="nomorKetua" name="ketua[phone]"
                value="{{$peserta['ketua']['phone']}}" disabled>
            </div>
            <div class="mb-3">
              <label class="form-label" for="idLine">Id Line</label>
              <input type="text" class="form-control" id="idLine" name="ketua[line]"
                value="{{$peserta['ketua']['line']}}" disabled>
            </div>
    
            @if(!$peserta['ketua']['photo_path'])
            <div class="mb-3">
              <label class="form-label" for="fotoKetua">Foto Ketua</label>
              <input type="text" class="form-control" id="fotoKetua" name="ketua[line]"
                value="Tidak ada foto" disabled>
            </div>
            @else
            <form action="{{route('admin.berkas.biodata')}}" method="POST">
              @csrf
              <input type="hidden" name="berkas" value="{{$peserta['ketua']['photo_path']}}">
              <div class="mb-3">
                <label class="form-label" for="fotoKetua">Foto Ketua</label>
                <button class="btn btn-block btn-primary" id="fotoKetua" formtarget="_blank">Lihat Foto</button>
              </div>
            </form>
            @endif
    
            @if(!$peserta['ketua']['ktm_path'])
            <div class="mb-3">
              <label class="form-label" for="ktmKetua">KTM</label>
              <input type="text" class="form-control" id="ktmKetua" name="ketua[line]"
                value="Tidak ada foto" disabled>
            </div>
            @else
            <form action="{{route('admin.berkas.biodata')}}" method="POST">
              @csrf
              <input type="hidden" name="berkas" value="{{$peserta['ketua']['ktm_path']}}">
              <div class="mb-3">
                <label class="form-label" for="ktmKetua">KTM</label>
                <button class="btn btn-block btn-primary" id="ktmKetua"  formtarget="_blank">Lihat KTM</button>
              </div>
            </form>
            @endif
    
          @if($peserta['anggotaPertama'])
          <div id="anggotaPertama">
            <hr>
            <h4 class="text-center">Anggota Pertama</h4>
            <div class="mb-3">
              <label class="form-label" for="namaAnggotaPertama">Nama</label>
              <input type="text" class="form-control" id="namaAnggotaPertama" name="anggota_pertama[nama]"
                value="{{$peserta['anggotaPertama']['name']}}" required disabled>
            </div>
            <div class="mb-3">
              <label class="form-label" for="jurusanAnggotaPertama">Jurusan / Departemen / Program Studi</label>
              <input type="text" class="form-control" id="jurusanAnggotaPertama" name="anggota_pertama[jurusan]"
                     value="{{$peserta['anggotaPertama']['majors']}}" required disabled>
            </div>
            <div class="mb-3">
              <label class="form-label" for="angkatanAnggotaPertama">Tahun Angkatan</label>
              <input type="text" class="form-control" id="angkatanAnggotaPertama" name="anggota_pertama[angkatan]"
                     value="{{$peserta['anggotaPertama']['year']}}" required disabled>
            </div>
            <div class="mb-3">
              <label class="form-label" for="nomorAnggotaPertama">Nomor Telepon</label>
              <input type="text" class="form-control" id="nomorAnggotaPertama" name="anggota_pertama[phone]"
                value="{{$peserta['anggotaPertama']['phone']}}" disabled>
            </div>
            <div class="mb-3">
              <label class="form-label" for="idLine">Id Line</label>
              <input type="text" class="form-control" id="idLine" name="anggota_pertama[line]"
                value="{{$peserta['anggotaPertama']['line']}}" disabled>
            </div>
    
            @if(!$peserta['anggotaPertama']['photo_path'])
            <div class="mb-3">
              <label class="form-label" for="fotoAnggotaPertama">Foto</label>
              <input type="text" class="form-control" id="fotoAnggotaPertama" name="ketua[line]"
                value="Tidak ada foto" disabled>
            </div>
            @else
            <form action="{{route('admin.berkas.biodata')}}" method="POST">
              @csrf
              <input type="hidden" name="berkas" value="{{$peserta['anggotaPertama']['photo_path']}}">
              <div class="mb-3">
                <label class="form-label" for="fotoAnggotaPertama">Foto</label>
                <button class="btn btn-block btn-primary" id="fotoAnggotaPertama" formtarget="_blank">Lihat Foto</button>
              </div>
            </form>
            @endif
    
            @if(!$peserta['anggotaPertama']['ktm_path'])
            <div class="mb-3">
              <label class="form-label" for="ktmAnggotaPertama">KTM</label>
              <input type="text" class="form-control" id="ktmAnggotaPertama" name="ketua[line]"
                value="Tidak ada foto" disabled>
            </div>
            @else
            <form action="{{route('admin.berkas.biodata')}}" method="POST">
              @csrf
              <input type="hidden" name="berkas" value="{{$peserta['anggotaPertama']['ktm_path']}}">
              <div class="mb-3">
                <label class="form-label" for="ktmAnggotaPertama">KTM</label>
                <button class="btn btn-block btn-primary" id="ktmAnggotaPertama"  formtarget="_blank">Lihat KTM</button>
              </div>
            </form>
            @endif
    
          </div>
          @endif
    
          @if($peserta['anggotaKedua'])
          <div class="anggotaKedua">
            <hr>
            <h4 class="text-center">Anggota Kedua</h4>
            <div class="mb-3">
              <label class="form-label" for="namaAnggotaKedua">Nama</label>
              <input type="text" class="form-control" id="namaAnggotaKedua" name="anggota_kedua[nama]"
                value="{{$peserta['anggotaKedua']['name']}}" required disabled>
            </div>
            <div class="mb-3">
              <label class="form-label" for="jurusanAnggotaKedua">Jurusan / Departemen / Program Studi</label>
              <input type="text" class="form-control" id="jurusanAnggotaKedua" name="anggota_kedua[jurusan]"
                     value="{{$peserta['anggotaKedua']['majors']}}" required disabled>
            </div>
            <div class="mb-3">
              <label class="form-label" for="angkatanAnggotaKedua">Tahun Angkatan</label>
              <input type="text" class="form-control" id="angkatanAnggotaKedua" name="anggota_kedua[angkatan]"
                     value="{{$peserta['anggotaKedua']['year']}}" required disabled>
            </div>
            <div class="mb-3">
              <label class="form-label" for="nomorAnggotaKedua">Nomor Telepon</label>
              <input type="text" class="form-control" id="nomorAnggotaKedua" name="anggota_kedua[phone]"
                value="{{$peserta['anggotaKedua']['phone']}}" disabled>
            </div>
            <div class="mb-3">
              <label class="form-label" for="idLine">Id Line</label>
              <input type="text" class="form-control" id="idLine" name="anggota_kedua[line]"
                value="{{$peserta['anggotaKedua']['line']}}" disabled>
            </div>
    
            @if(!$peserta['anggotaKedua']['photo_path'])
            <div class="mb-3">
              <label class="form-label" for="fotoAnggotaKedua">Foto</label>
              <input type="text" class="form-control" id="fotoAnggotaKedua" name="ketua[line]"
                value="Tidak ada foto" disabled>
            </div>
            @else
            <form action="{{route('admin.berkas.biodata')}}" method="POST">
              @csrf
              <input type="hidden" name="berkas" value="{{$peserta['anggotaKedua']['photo_path']}}">
              <div class="mb-3">
                <label class="form-label" for="fotoAnggotaKedua">Foto</label>
                <button class="btn btn-block btn-primary" id="fotoAnggotaKedua" formtarget="_blank">Lihat Foto</button>
              </div>
            </form>
            @endif
    
            @if(!$peserta['anggotaKedua']['ktm_path'])
            <div class="mb-3">
              <label class="form-label" for="ktmAnggotaKedua">KTM</label>
              <input type="text" class="form-control" id="ktmAnggotaKedua" name="ketua[line]"
                value="Tidak ada foto" disabled>
            </div>
            @else
            <form action="{{route('admin.berkas.biodata')}}" method="POST">
              @csrf
              <input type="hidden" name="berkas" value="{{$peserta['anggotaKedua']['ktm_path']}}">
              <div class="mb-3">
                <label class="form-label" for="ktmAnggotaKedua">KTM</label>
                <button class="btn btn-block btn-primary" id="ktmAnggotaKedua"  formtarget="_blank">Lihat KTM</button>
              </div>
            </form>
            @endif
    
          </div>
          @endif

          @if($peserta['invoice'])
          <div>
            <hr>
            <h4 class="text-center">Pembayaran</h4>
            <div class="mb-3">
              <label class="form-label" for="bayar">Jumlah Bayar</label>
              @if($peserta['invoice']['promo'])
              <input type="text" class="form-control" id="bayar" name="anggota_kedua[nama]"
                value="{{"Rp " . number_format($peserta['competition']['price'] - $peserta['invoice']['promo']['discount'],2,',','.') . ' (' . $peserta['invoice']['promo']['name'] .')'}}" required disabled>
              @else
              <input type="text" class="form-control" id="bayar" name="anggota_kedua[nama]"
                    value="{{"Rp " . number_format($peserta['competition']['price'],2,',','.') . '-' . ' (tanpa promo)'}}" required disabled>
              @endif
            </div>

            <div class="mb-3">
              <label class="form-label" for="bayar">Status</label>
              @if($peserta['invoice']['approver_id'] and $peserta['invoice']['approved_at'])

              <input type="text" class="form-control" id="bayar" name="anggota_kedua[nama]"
              value="Terverifikasi" required disabled>
              @if($peserta['invoice']['payment_proof'])
              <a href="{{route('admin.pembayaran.berkas-bukti', $peserta['id'])}}" target="_blank"
              class="btn bg-lime btn-block my-2">Lihat bukti</a>
              <a class="btn btn-danger btn-block"
              href="{{route('admin.pembayaran.unverif', $peserta['invoice']['id'])}}">Un-Verifikasi</a>
              @endif
              @else
              <input type="text" class="form-control" id="bayar" name="anggota_kedua[nama]"
              value="Belum diverifikasi" required disabled>
              @if($peserta['invoice']['payment_proof'])
              <a href="{{route('admin.pembayaran.berkas-bukti', $peserta['id'])}}" target="_blank"
              class="btn bg-lime btn-block my-2">Lihat bukti</a>
              <a class="btn btn-warning btn-block"
                href="{{route('admin.pembayaran.verif', $peserta['invoice']['id'])}}">Verifikasi</a>
              </a>
              @else
              <input type="text" class="form-control" id="bayar" name="anggota_kedua[nama]"
              value="Tidak ada bukti" required disabled>
              @endif

              @endif
            </div>
          </div>
          @else
          <div>
            <hr>
            <h4 class="text-center">Pembayaran</h4>
            <div class="mb-3">
              <label class="form-label" for="bayar">Data invoice belum ada (Peserta belum pernah masuk ke hamalaman pembayaran)</label>
            </div>
          </div>
          @endif

      </div>
    </div>
  </div>

</div>
</div>

@stop

