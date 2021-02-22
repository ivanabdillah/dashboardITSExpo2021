@extends('pages.events.main')
@section('title','Business Case Competition')
@section('css')
    @parent
    <style>
        .bg-kiri{
            background: linear-gradient(6.94deg, #009197 -3.26%, #11354F 101.81%);
            min-height:80vh;
        }
    </style>
@endsection
@section('image_kiri',asset('img/business_case_competition.png'))
@section('section_kanan')

                    <div id="requirement-section">
                        <h2 class="mt-5 pt-5 pt-lg-0 text-center" style="font-family: 'Raleway', sans-serif;font-weight:700;color: #3F0A3E;">Syarat Pendaftaran</h2>
                        @if ($errors->any())
                        <div class="alert alert-danger" role="alert">
                            <ul style="list-style: none">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
                        @if(Session::has('status')&&Session::get('status')=='error')
                        <div class="alert alert-danger" role="alert">
                            {{Session::get('message')}}
                        </div>
                        @endif
                        <div class="mx-lg-5 px-lg-5 mt-5">
                            <ul class="mt-5 mr-3 requirement-list">
                                <li><h4 class="pl-3">Satu tim terdiri dari 3 orang peserta</h4></li>
                                <li><h4 class="pl-3">Peserta merupakan mahasiswa D3/D4/S1 (diperbolehkan dari universitas dan jurusan yang berbeda)</h4></li>
                                <li><h4 class="pl-3">Membayar biaya pendaftaran</h4></li>
                                <li><h4 class="pl-3">Peserta lomba yang terdaftar di suatu tim tidak diperkenankan terdaftar sebagai peserta lomba di tim lainnya</h4></li>
                            </ul>
                            <div class="row px-5 px-lg-0 mt-5 pt-5">
                                <button type="button" class="col-lg-3 mt-3 offset-lg-9 btn btn-primary badge-pill badge-primary p-3" style="background: #3F0A3E;font-weight:300;" onclick="showHideElement('#requirement-section','#registration-section')">Lanjut Daftar</button>
                            </div>
                        </div>
                    </div>
                    <div id="registration-section" style="display: none">
                        <h2 class="mt-5 pt-5 pt-lg-0 text-center" style="font-family: 'Raleway', sans-serif;font-weight:700;color: #3F0A3E;">Registrasi</h2>
                        <div class="mx-lg-5 px-lg-5 mt-5">
                            <div class="bs-stepper">
                                <div class="bs-stepper-header ml-lg-5 mr-lg-5 pl-lg-5 pr-lg-5" role="tablist">
                                <div class="step" data-target="#account-creation-part">
                                    <button type="button" class="step-trigger" role="tab" aria-controls="account-creation-part" id="account-creation-part-trigger">
                                    <span class="bs-stepper-circle"></span>
                                    <span class="bs-stepper-label">Buat Akun</span>
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
                                <div class="step" data-target="#success-part">
                                    <button type="button" class="step-trigger" role="tab" aria-controls="success-part" id="success-part-trigger">
                                    <span class="bs-stepper-circle"></span>
                                    <span class="bs-stepper-label">Selesai</span>
                                    </button>
                                </div>
                                </div>
                                <div class="bs-stepper-content">
                                <form action="{{route('bcc.post')}}" method="POST">
                                    @csrf
                                <div id="account-creation-part" class="content" role="tabpanel" aria-labelledby="account-creation-part-trigger">
                                    <div class="px-2 px-lg-5 mx-2 mx-lg-5">
                                        <div class="form-group mt-5">
                                            <input type="email" class="form-control border-left-0 border-top-0 border-right-0" name="email" placeholder="Email" >
                                        </div>
                                        <div class="form-group mt-5">
                                            <input type="password" class="form-control border-left-0 border-top-0 border-right-0" name="password" placeholder="Password" >
                                        </div>
                                        <div class="form-group mt-5">
                                            <input type="password" class="form-control border-left-0 border-top-0 border-right-0" name="password_confirmation" placeholder="Konfirmasi Password" >
                                        </div>
                                    </div>
                                    <div class="row px-5 px-lg-0 mt-5 pt-5">
                                        <button type="button" class="col-lg-3 mt-3 btn btn-primary badge-pill badge-primary p-3" style="background: #3F0A3E;font-weight:300;" onclick="showHideElement('#registration-section','#requirement-section')">Kembali</button>
                                        <button type="button" class="col-lg-3 mt-3 offset-lg-6 btn btn-primary badge-pill badge-primary p-3" style="background: #3F0A3E;font-weight:300;" onclick="toStepper(2)">Selanjutnya</button>
                                    </div>
                                </div>
                                <div id="personal-info-part" class="content pt-5" role="tabpanel" aria-labelledby="personal-info-part-trigger">
                                        <div class="px-2 px-lg-5 mx-2 mx-lg-5">
                                            <div class="form-group">
                                                <input type="text" class="form-control border-left-0 border-top-0 border-right-0" name="nama_tim" placeholder="Nama Tim" >
                                            </div>
                                            <div class="form-group mt-5">
                                                <input type="text" class="form-control border-left-0 border-top-0 border-right-0" name="nama_ketua" placeholder="Nama Ketua" >
                                            </div>
                                            <div class="form-group mt-5">
                                                <input type="text" class="form-control border-left-0 border-top-0 border-right-0" name="perguruan_tinggi" placeholder="Asal Perguruan Tinggi" >
                                            </div>
                                            <div class="form-group mt-5">
                                                <input type="text" class="form-control border-left-0 border-top-0 border-right-0" name="jurusan" placeholder="Jurusan / Departemen / Program Studi" >
                                            </div>
                                            <div class="form-group mt-5">
                                                <input type="number" class="form-control border-left-0 border-top-0 border-right-0" min="0" max="{{ date('Y')}}" name="tahun_angkatan" placeholder="Tahun Angkatan" >
                                            </div>
                                            <div class="form-group mt-5">
                                                <input type="text" class="form-control border-left-0 border-top-0 border-right-0" name="nomor_hp" placeholder="Nomor HP" >
                                            </div>
                                        </div>
                                        <div class="row px-5 px-lg-0 mt-5 pt-5">
                                            <button type="button" class="col-lg-3 mt-3 btn btn-primary badge-pill badge-primary p-3" style="background: #3F0A3E;font-weight:300;" onclick="toStepper(1)">Sebelumnya</button>
                                            <button type="submit" class="col-lg-3 mt-3 offset-lg-6 btn btn-primary badge-pill badge-primary p-3" style="background: #3F0A3E;font-weight:300;">Daftar</button>
                                        </div>
                                </div>
                                </form>
                                <div id="success-part" class="content" role="tabpanel" aria-labelledby="success-part-trigger">
                                        <h4 
                                        class="mt-5 pt-5"
                                        style="font-family: Rubik;
                                        font-style: normal;
                                        font-weight: 300;line-height: 48px;
                                        text-align: center;">
                                            Terima kasih telah mendaftar Bussiness Case Competiton ITS EXPO 2021. Silahkan menuju dahsboard untuk melanjutkan proses pelengkapan berkas.
                                        </h4>
                                        <div class="row px-5 px-lg-0 mt-5 pt-5">
                                            <a href="{{route('pengguna.biodata.form')}}" type="button" class="col-lg-4 mt-3 offset-lg-4 btn btn-primary badge-pill badge-primary p-3" style="background: #3F0A3E;font-weight:300;">Dashboard</a>
                                        </div>  
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>
@endsection

@section('js')
<script src="https://cdn.jsdelivr.net/npm/bs-stepper/dist/js/bs-stepper.min.js"></script>
<script>
    $(document).ready(function () {
        var stepper = new Stepper($('.bs-stepper')[0])
        @if(Session::has('status')&&Session::get('status')=='success')
        stepper.to(3)
        showHideElement('#requirement-section','#registration-section')
        @endif
    })
    
    function toStepper(number){
        var stepper = new Stepper($('.bs-stepper')[0])
        stepper.to(number)
    }

    function showHideElement(el_to_hide,el_to_show){
            $(el_to_hide).hide()
            $(el_to_show).show()
        }
</script>
@endsection