@extends('adminlte::page')

@section('title', 'Biodata')

@section('content_header')
<h1 class="d-inline">Biodata</h1>
@include('components/validation')
@stop

@section('content')
<div class="card mb-0">
  <div class="card-header">Biodata</div>
  <div class="card-body">
    <form action="{{route('pengguna.biodata.update')}}" method="POST" enctype="multipart/form-data">
      @csrf
      @method('PUT')
      <h4 class="text-center">Biodata Tim</h4>
      <div class="mb-3">
        <label class="form-label" for="email">Alamat Email</label>
        <input type="email" class="form-control" id="email" value="{{$biodata['email']}}" required disabled>
      </div>
      <div class="mb-3">
        <label class="form-label" for="namaTim">Nama Tim</label>
        <input type="text" class="form-control" id="namaTim" value="{{$biodata['userable']['team_name']}}" required
          disabled>
      </div>
      <div class="mb-3">
        <label class="form-label" for="namaPt">Asal Perguruan Tinggi</label>
        <input type="text" class="form-control" id="namaPt" value="{{$biodata['userable']['college_name']}}" required
          disabled>
      </div>
      <div class="mb-3">
        <label class="form-label" for="competition">Kompetisi</label>
        <select class="form-control form-select" id="competition" disabled>
          <option>{{$biodata['userable']['competition']['name']}}</option>
        </select>
      </div>
      <hr>
      <h4 class="text-center">Biodata Ketua</h4>
      <div id="ketua">
        <div class="mb-3">
          <label class="form-label" for="namaKetua">Nama</label>
          <input type="text" class="form-control" id="namaKetua" name="ketua[nama]"
            value="{{$biodata['userable']['ketua']['name']}}" required>
        </div>
        <div class="mb-3">
          <label class="form-label" for="jurusanKetua">Jurusan / Departemen / Program Studi</label>
          <input type="text" class="form-control" id="jurusanKetua" name="ketua[jurusan]"
                 value="{{$biodata['userable']['ketua']['majors']}}" required>
        </div>
        <div class="mb-3">
          <label class="form-label" for="angkatanKetua">Tahun Angkatan</label>
          <input type="text" class="form-control" id="angkatanKetua" name="ketua[angkatan]"
                 value="{{$biodata['userable']['ketua']['year']}}" required>
        </div>
        <div class="mb-3">
          <label class="form-label" for="nomorKetua">Nomor Telepon</label>
          <input type="text" class="form-control" id="nomorKetua" name="ketua[phone]"
            value="{{$biodata['userable']['ketua']['phone']}}">
        </div>
        <div class="mb-3">
          <label class="form-label" for="idLine">Id Line</label>
          <input type="text" class="form-control" id="idLine" name="ketua[line]"
            value="{{$biodata['userable']['ketua']['line']}}">
        </div>

        @if(!$biodata['userable']['ketua']['photo_path'])
        <label class="form-label">Foto</label>
        <div class="mb-3 custom-file">
          <input type="file" class="custom-file-input" id="fotoKetua" name="ketua[foto]" accept="image/*">
          <label class="custom-file-label" for="fotoKetua">Pilih Foto</label>
        </div>
        @endif

        @if(!$biodata['userable']['ketua']['ktm_path'])
        <label class="form-label">KTM</label>
        <div class="mb-3 custom-file">
          <input type="file" class="custom-file-input" id="ktmKetua" name="ketua[ktm]" accept="image/*">
          <label class="custom-file-label" for="ktmKetua">Pilih KTM</label>
        </div>
        @endif
      </div>

      @if($biodata['userable']['anggotaPertama'])
      <div id="anggotaPertama">
        <hr>
        <h4 class="text-center">Biodata Anggota Pertama</h4>
        <div class="mb-3">
          <label class="form-label" for="namaAnggotaPertama">Nama</label>
          <input type="text" class="form-control" id="namaAnggotaPertama" name="anggota_pertama[nama]"
            value="{{$biodata['userable']['anggotaPertama']['name']}}" required>
        </div>
        <div class="mb-3">
          <label class="form-label" for="jurusanAnggotaPertama">Jurusan / Departemen / Program Studi</label>
          <input type="text" class="form-control" id="jurusanAnggotaPertama" name="anggota_pertama[jurusan]"
                 value="{{$biodata['userable']['anggotaPertama']['majors']}}" required>
        </div>
        <div class="mb-3">
          <label class="form-label" for="angkatanAnggotaPertama">Tahun Angkatan</label>
          <input type="text" class="form-control" id="angkatanAnggotaPertama" name="anggota_pertama[angkatan]"
                 value="{{$biodata['userable']['anggotaPertama']['year']}}" required>
        </div>
        <div class="mb-3">
          <label class="form-label" for="nomorAnggotaPertama">Nomor Telepon</label>
          <input type="text" class="form-control" id="nomorAnggotaPertama" name="anggota_pertama[phone]"
            value="{{$biodata['userable']['anggotaPertama']['phone']}}">
        </div>
        <div class="mb-3">
          <label class="form-label" for="idLine">Id Line</label>
          <input type="text" class="form-control" id="idLine" name="anggota_pertama[line]"
            value="{{$biodata['userable']['anggotaPertama']['line']}}">
        </div>

        @if(!$biodata['userable']['anggotaPertama']['photo_path'])
        <label class="form-label">Foto</label>
        <div class="mb-3 custom-file">
          <input type="file" class="custom-file-input" id="fotoAnggotaPertama" name="anggota_pertama[foto]"
            accept="image/*">
          <label class="custom-file-label" for="fotoAnggotaPertama">Pilih
            Foto</label>
        </div>
        @endif

        @if(!$biodata['userable']['anggotaPertama']['ktm_path'])
        <label class="form-label">KTM</label>
        <div class="mb-3 custom-file">
          <input type="file" class="custom-file-input" id="ktmAnggotaPertama" name="anggota_pertama[ktm]"
            accept="image/*">
          <label class="custom-file-label" for="ktmAnggotaPertama">Pilih
            KTM</label>
        </div>
        @endif

      </div>
      @else
      <button type="button" class="btn btn-outline-primary d-block mb-1" id="addAnggotaPertama"
        onclick="tambahAnggotaPertama()">Tambah Anggota
        Pertama</button>
      @endif

      @if($biodata['userable']['anggotaKedua'])
      <div class="anggotaKedua">
        <hr>
        <h4 class="text-center">Biodata Anggota Kedua</h4>
        <div class="mb-3">
          <label class="form-label" for="namaAnggotaKedua">Nama</label>
          <input type="text" class="form-control" id="namaAnggotaKedua" name="anggota_kedua[nama]"
            value="{{$biodata['userable']['anggotaKedua']['name']}}" required>
        </div>
        <div class="mb-3">
          <label class="form-label" for="jurusanAnggotaKedua">Jurusan / Departemen / Program Studi</label>
          <input type="text" class="form-control" id="jurusanAnggotaKedua" name="anggota_kedua[jurusan]"
                 value="{{$biodata['userable']['anggotaKedua']['majors']}}" required>
        </div>
        <div class="mb-3">
          <label class="form-label" for="angkatanAnggotaKedua">Tahun Angkatan</label>
          <input type="text" class="form-control" id="angkatanAnggotaKedua" name="anggota_kedua[angkatan]"
                 value="{{$biodata['userable']['anggotaKedua']['year']}}" required>
        </div>
        <div class="mb-3">
          <label class="form-label" for="nomorAnggotaKedua">Nomor Telepon</label>
          <input type="text" class="form-control" id="nomorAnggotaKedua" name="anggota_kedua[phone]"
            value="{{$biodata['userable']['anggotaKedua']['phone']}}">
        </div>
        <div class="mb-3">
          <label class="form-label" for="idLine">Id Line</label>
          <input type="text" class="form-control" id="idLine" name="anggota_kedua[line]"
            value="{{$biodata['userable']['anggotaKedua']['line']}}">
        </div>

        @if(!$biodata['userable']['anggotaKedua']['photo_path'])
        <label class="form-label">Foto</label>
        <div class="mb-3 custom-file">
          <input type="file" class="custom-file-input" id="fotoAnggotaKedua" name="anggota_kedua[foto]"
            accept="image/*">
          <label class="custom-file-label" for="fotoAnggotaKedua">Pilih
            Foto</label>
        </div>
        @endif

        @if(!$biodata['userable']['anggotaKedua']['ktm_path'])
        <label class="form-label">KTM</label>
        <div class="mb-3 custom-file">
          <input type="file" class="custom-file-input" id="ktmAnggotaKedua" name="anggota_kedua[ktm]" accept="image/*">
          <label class="custom-file-label" for="ktmAnggotaKedua">Pilih
            KTM</label>
        </div>
        @endif

      </div>
      @else
      <button type="button" class="btn btn-outline-primary d-block mb-1" id="addAnggotaKedua"
        onclick="tambahAnggotaKedua()">Tambah Anggota
        Kedua</button>
      @endif

      <button type="submit" class="btn btn-primary" id="submitButton">Simpan</button>
    </form>
  </div>

</div>
</div>

@stop


@section('js')
<script>
  setInputFile();
  function setInputFile() {
    $('input[type="file"]').change(function(e){
          var fileName = e.target.files[0].name;
          $(e.target.nextElementSibling).html(fileName);
      });
  }
  function tambahAnggotaPertama() {
    document.querySelector('button#addAnggotaPertama').remove();
    let anggotaPertamaEl = document.createElement('div');
    anggotaPertamaEl.setAttribute('id', 'AnggotaPertama');
    anggotaPertamaEl.innerHTML = `
        <hr>
        <h4 class="text-center">Biodata Anggota Pertama</h4>
        <div class="mb-3">
          <label class="form-label" for="namaAnggotaPertama">Nama</label>
          <input type="text" class="form-control" id="namaAnggotaPertama" name="baru[anggota_pertama][nama]"
             required>
        </div>
        <div class="mb-3">
          <label class="form-label" for="jurusanAnggotaPertama">Jurusan / Departemen / Program Studi</label>
          <input type="text" class="form-control" id="jurusanAnggotaPertama" name="baru[anggota_pertama][jurusan]"
             required>
        </div>
        <div class="mb-3">
          <label class="form-label" for="angkatanAnggotaPertama">Tahun Angkatan</label>
          <input type="text" class="form-control" id="angkatanAnggotaPertama" name="baru[anggota_pertama][angkatan]"
             required>
        </div>
        <div class="mb-3">
          <label class="form-label" for="nomorAnggotaPertama">Nomor Telepon</label>
          <input type="text" class="form-control" id="nomorAnggotaPertama" name="baru[anggota_pertama][phone]"
            >
        </div>
        <div class="mb-3">
          <label class="form-label" for="idLineAnggotaPertama">Id Line</label>
          <input type="text" class="form-control" id="idLineAnggotaPertama" name="baru[anggota_pertama][line]"
            >
        </div>

        <label class="form-label">Foto</label>
        <div class="mb-3 custom-file">
          <input type="file" class="custom-file-input" id="fotoAnggotaPertama" name="baru[anggota_pertama][foto]" accept="image/*">
          <label class="custom-file-label" for="fotoAnggotaPertama"
            >Pilih
            Foto</label>
        </div>

        <label class="form-label">KTM</label>
        <div class="mb-3 custom-file">
          <input type="file" class="custom-file-input" id="ktmAnggotaPertama" name="baru[anggota_pertama][ktm]"  accept="image/*">
          <label class="custom-file-label" for="ktmAnggotaPertama">Pilih
            KTM</label>
        </div>
    `
    insertAfter(anggotaPertamaEl, document.querySelector('#ketua'));
    setInputFile();
  }
  function tambahAnggotaKedua() {
    document.querySelector('button#addAnggotaKedua').remove();
    let anggotaKedua = document.createElement('div');
    anggotaKedua.setAttribute('id', 'AnggotaKedua');
    anggotaKedua.innerHTML = `
        <hr>
        <h4 class="text-center">Biodata Anggota Kedua</h4>
        <div class="mb-3">
          <label class="form-label" for="namaAnggotaKedua">Nama</label>
          <input type="text" class="form-control" id="namaAnggotaKedua" name="baru[anggota_kedua][nama]"
             required>
        </div>
        <div class="mb-3">
          <label class="form-label" for="jurusanAnggotaKedua">Jurusan / Departemen / Program Studi</label>
          <input type="text" class="form-control" id="jurusanAnggotaKedua" name="baru[anggota_kedua][jurusan]"
             required>
        </div>
        <div class="mb-3">
          <label class="form-label" for="angkatanAnggotaKedua">Tahun Angkatan</label>
          <input type="text" class="form-control" id="angkatanAnggotaKedua" name="baru[anggota_kedua][angkatan]"
             required>
        </div>
        <div class="mb-3">
          <label class="form-label" for="nomorAnggotaKedua">Nomor Telepon</label>
          <input type="text" class="form-control" id="nomorAnggotaKedua" name="baru[anggota_kedua][phone]"
            >
        </div>
        <div class="mb-3">
          <label class="form-label" for="idLineAnggotaKedua">Id Line</label>
          <input type="text" class="form-control" id="idLineAnggotaKedua" name="baru[anggota_kedua][line]"
            >
        </div>

        <label class="form-label">Foto</label>
        <div class="mb-3 custom-file">
          <input type="file" class="custom-file-input" id="fotoAnggotaKedua"  name="baru[anggota_kedua][foto]" accept="image/*">
          <label class="custom-file-label" for="fotoAnggotaKedua"
            >Pilih
            Foto</label>
        </div>

        <label class="form-label">KTM</label>
        <div class="mb-3 custom-file">
          <input type="file" class="custom-file-input" id="ktmAnggotaKedua" name="baru[anggota_kedua][ktm]"  accept="image/*">
          <label class="custom-file-label" for="ktmAnggotaKedua">Pilih
            KTM</label>
        </div>
    `
    document.querySelector('.card-body form').insertBefore(anggotaKedua, document.querySelector('#submitButton'));
    setInputFile();
  }

  function insertAfter(newNode, referenceNode) {
    referenceNode.parentNode.insertBefore(newNode, referenceNode.nextSibling);
}
</script>
@stop
