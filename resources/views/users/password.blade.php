@extends('adminlte::page')

@section('title', 'Halaman Ganti Password')

@section('content_header')
<h1 class="d-inline">Halaman Ganti Password</h1>
@include('components/validation')
@stop

@section('content')

<div class="container d-flex justify-content-center">
  <div class="row">
    <div class="card">
      <div class="card-body">
        <form action="{{route('pengguna.password.update')}}" method="POST">
          @csrf
          @method('PUT')
          <div class="form-group">
            <label for="oldPassword">Password Lama</label>
            <input type="password" class="form-control" name="old_password" id="oldPassword" placeholder="password lama"
              required autofocus>
          </div>
          <div class="form-group">
            <label for="newPassword">Password Baru</label>
            <input type="password" class="form-control" name="new_password" id="newPassword" placeholder="password baru"
              required>
          </div>
          <div class="form-group">
            <label for="confirmPassword">Konfirmasi Password</label>
            <input type="password" class="form-control" name="confirm_password" id="confirmPassword"
              placeholder="konfirmasi password" required>
          </div>
          <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
      </div>
    </div>
  </div>
</div>

@stop