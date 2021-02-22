@extends('pages.events.main')
@section('title','Beasiswa Fair')
@section('css')
    @parent
    <style>
        .bg-kiri{
            background: linear-gradient(159.96deg, #F53B4B -20.42%, #FFB953 93.03%);
            min-height:80vh;
        }
    </style>
@endsection
@section('image_kiri',asset('img/beasiswa_fair.png'))
@section('section_kanan')
@if(Session::has('status')&&Session::get('status')=='success')
                    <div class="d-flex flex-column align-items-center justify-content-center p-5" style="height:100%">
                        <h2 class="text-center pt-5" style="font-family: 'Raleway', sans-serif;font-weight:700;color: #3F0A3E;">Registrasi Berhasil</h2>
                        <h4 class="text-center mt-5" style="font-weight: 300;color: #3F0A3E;">Terima kasih telah mendaftar Beasiswa Fair ITS EXPO 2021
                            Silahkan gabung grup WhatsApp di bawah ini
                            untuk mempermudah komunikasi.</h4>
                            <button type="button" class="btn btn-success badge-success badge-pill p-3 px-lg-5 border-0 d-flex flex-row align-items-center mt-5" style="background: #4DCC5B;"><i class="icofont-brand-whatsapp icofont-lg"></i>&nbsp;&nbsp;&nbsp;<h4 class="m-0" style="font-weight:300;">Grup WhatsApp</h4></button>
                    </div>
                    @else
                    <h2 class="mt-5 pt-5 pt-lg-0 text-center" style="font-family: 'Raleway', sans-serif;font-weight:700;color: #3F0A3E;">Registrasi</h2>
                    @if ($errors->any())
                    <div class="alert alert-danger" role="alert">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    <div class="mx-lg-5 px-lg-5 mt-5">
                        <div class="bs-stepper">
                            <div class="bs-stepper-header ml-lg-5 mr-lg-5 pl-lg-5 pr-lg-5" role="tablist">
                              <div class="step" data-target="#informasi-part">
                                <button type="button" class="step-trigger" role="tab" aria-controls="informasi-part" id="informasi-part-trigger">
                                  <span class="bs-stepper-circle"></span>
                                  <span class="bs-stepper-label">Informasi</span>
                                </button>
                              </div>
                              <div class="line"></div>
                              <div class="step" data-target="#personal-info-part">
                                <button type="button" class="step-trigger" role="tab" aria-controls="personal-info-part" id="personal-info-part-trigger">
                                  <span class="bs-stepper-circle"></span>
                                  <span class="bs-stepper-label">Data Diri</span>
                                </button>
                              </div>
                              <div class="line"></div>
                              <div class="step" data-target="#file-part">
                                <button type="button" class="step-trigger" role="tab" aria-controls="file-part" id="file-part-trigger">
                                  <span class="bs-stepper-circle"></span>
                                  <span class="bs-stepper-label">Unggah Berkas</span>
                                </button>
                              </div>
                            </div>
                            <div class="bs-stepper-content">
                            <form action="{{route('beasiswa-fair.post')}}" method="POST" enctype="multipart/form-data">
                                @csrf
                              <div id="informasi-part" class="content" role="tabpanel" aria-labelledby="informasi-part-trigger">
                                <h3 class="mt-5 text-center" style="font-family: 'Raleway', sans-serif;font-weight:600;color: #3F0A3E;">Syarat Pendaftaran</h3>
                                <ul class="mt-5 mr-3 requirement-list">
                                    <li class="pl-3"><h4>Peserta wajib mengikuti akun instagram @its_expo</h4></li>
                                    <li class="pl-3"><h4>Peserta mengunggah twibbon di instagram</h4></li>
                                    <li class="pl-3"><h4>Peserta mengunggah story instagram</h4></li>
                                </ul>
                                <div class="row px-5 px-lg-0 mt-5 pt-5">
                                    <a href="{{asset('img/twibbon_beasiswa_fair.png')}}" target="_blank" type="button" class="col-lg-3 mt-3 btn btn-primary badge-pill badge-primary p-3" style="background: #3F0A3E;font-weight:300;">Unduh Twibbon</a>
                                    <button type="button" class="col-lg-3 mt-3 offset-lg-6 btn btn-primary badge-pill badge-primary p-3" style="background: #3F0A3E;font-weight:300;" onclick="toStepper(2)">Selanjutnya</button>
                                </div>
                              </div>
                              <div id="personal-info-part" class="content pt-5" role="tabpanel" aria-labelledby="personal-info-part-trigger">
                                    <div class="px-2 px-lg-5 mx-2 mx-lg-5">
                                        <div class="form-group">
                                            <input type="text" class="form-control border-left-0 border-top-0 border-right-0" name="nama" placeholder="Nama" >
                                        </div>
                                        <div class="form-group mt-5">
                                            <input type="email" class="form-control border-left-0 border-top-0 border-right-0" name="email" placeholder="Email" >
                                        </div>
                                        <div class="form-group mt-5">
                                            <input type="text" class="form-control border-left-0 border-top-0 border-right-0" name="instansi" placeholder="Instansi" >
                                        </div>
                                        <div class="form-group mt-5">
                                            <input type="text" class="form-control border-left-0 border-top-0 border-right-0" name="no_wa" placeholder="Nomor WhatsApp" >
                                        </div>
                                    </div>
                                    <div class="row px-5 px-lg-0 mt-5 pt-5">
                                        <button type="button" class="col-lg-3 mt-3 btn btn-primary badge-pill badge-primary p-3" style="background: #3F0A3E;font-weight:300;" onclick="toStepper(1)">Sebelumnya</button>
                                        <button type="button" class="col-lg-3 mt-3 offset-lg-6 btn btn-primary badge-pill badge-primary p-3" style="background: #3F0A3E;font-weight:300;" onclick="toStepper(3)">Selanjutnya</button>
                                    </div>
                              </div>
                              <div id="file-part" class="content" role="tabpanel" aria-labelledby="file-part-trigger">
                                    <div class="px-lg-5 mx-5">
                                        <div class="row my-5">
                                            <label for="file_follow" class="col-lg-6" style="font-weight:400;color:#000000;opacity:0.5">Bukti follow instagram @its_expo</label>
                                            <div class="col-lg-6">
                                                <button type="button" class="float-lg-right btn btn-primary badge-pill badge-primary p-2 px-lg-5" style="background: #3F0A3E;font-weight:400;" onclick="$('#file_follow').click()">Tambahkan File</button>
                                                <input type="file" name="file_follow" id="file_follow" class="d-none" accept="image/*" />
                                            </div>
                                        </div>
                                        <div class="row my-5">
                                            <label for="file_twibbon" class="col-lg-6" style="font-weight:400;color:#000000;opacity:0.5">Bukti unggah Twibbon</label>
                                            <div class="col-lg-6">
                                                <button type="button" class="float-lg-right btn btn-primary badge-pill badge-primary p-2 px-lg-5" style="background: #3F0A3E;font-weight:400;" onclick="$('#file_twibbon').click()">Tambahkan File</button>
                                                <input type="file" name="file_twibbon" id="file_twibbon" class="d-none" accept="image/*" />
                                            </div>
                                        </div>
                                        <div class="row my-5">
                                            <label for="file_story" class="col-lg-6" style="font-weight:400;color:#000000;opacity:0.5">Bukti story instagram</label>
                                            <div class="col-lg-6">
                                                <button type="button" class="float-lg-right btn btn-primary badge-pill badge-primary p-2 px-lg-5" style="background: #3F0A3E;font-weight:400;" onclick="$('#file_story').click()">Tambahkan File</button>
                                                <input type="file" name="file_story" id="file_story" class="d-none" accept="image/*" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row px-5 px-lg-0 mt-5 pt-5">
                                        <button type="button" class="col-lg-3 mt-3 btn btn-primary badge-pill badge-primary p-3" style="background: #3F0A3E;font-weight:300;" onclick="toStepper(2)">Sebelumnya</button>
                                        <button type="submit" class="col-lg-3 mt-3 offset-lg-6 btn btn-primary badge-pill badge-primary p-3" style="background: #3F0A3E;font-weight:300;">Daftar</button>
                                    </div>  
                              </div>
                            </form>
                            </div>
                        </div>
                    </div>
                    @endif
@endsection