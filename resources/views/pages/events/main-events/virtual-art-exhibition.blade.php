@extends('pages.events.main')
@section('title','Virtual Art Exhibition')
@section('css')
    @parent
    <style>
        .bg-kiri{
            background: linear-gradient(212.7deg, #009298 25.08%, #FFBA53 135.23%);
            min-height:80vh;
        }
    </style>
@endsection
@section('image_kiri',asset('img/virtual_art_exhibition.png'))
@section('section_kanan')

                    <div id="requirement-section">
                        <h2 class="mt-5 pt-5 pt-lg-0 text-center" style="font-family: 'Raleway', sans-serif;font-weight:700;color: #3F0A3E;">Syarat Pendaftaran</h2>
                        @if ($errors->any())
                        <div class="alert alert-danger" role="alert">
                            <ul>
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
                            <h4 style="font-weight: 300;color: #3F0A3E;">Ini mewakili kesepakatan antara Seniman dan Virtual Art Exhibition ITS EXPO 2021. Sebelum anda mengirimkan form pendaftaran, anda setuju bahwa jika karya seni anda dipilih, anda akan memberikan izin ITS EXPO untuk menggunakan hak penggunaan karya seni.</h4>
                            <ul class="mt-5 mr-3 requirement-list">
                                <li><h4>Seniman memiliki hak cipta atas gambar karya seni yang dikirimkan.</h4></li>
                                <li><h4>Karya seni terpilih dapat digunakan untuk mempromosikan pameran, pameran di masa mendatang, video, media sosial, dan pameran virtual.</h4></li>
                            </ul>
                            <div class="row px-5 px-lg-0 mt-5 pt-5">
                                <button type="button" class="col-lg-6 mt-3 offset-lg-6 btn btn-primary badge-pill badge-primary p-3" style="background: #3F0A3E;font-weight:300;" onclick="showHideElement('#requirement-section','#registration-section')">Saya Menerima dan Menyetujui Syarat dan Ketentuan</button>
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
                                    <span class="bs-stepper-label">Ketua</span>
                                    </button>
                                </div>
                                <div class="line"></div>
                                <div class="step" data-target="#personal-info-part">
                                    <button type="button" class="step-trigger" role="tab" aria-controls="personal-info-part" id="personal-info-part-trigger">
                                    <span class="bs-stepper-circle"></span>
                                    <span class="bs-stepper-label">Anggota</span>
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
                                <form action="{{route('vae.post')}}" method="POST">
                                    @csrf
                                <div id="account-creation-part" class="content" role="tabpanel" aria-labelledby="account-creation-part-trigger">
                                    <div class="px-2 px-lg-5 mx-2 mx-lg-5">
                                        <div class="form-group">
                                            <input type="text" class="form-control border-left-0 border-top-0 border-right-0" name="nama_ketua" placeholder="Nama Ketua" required>
                                        </div>
                                        <div class="form-group mt-5">
                                            <input type="email" class="form-control border-left-0 border-top-0 border-right-0" name="email" placeholder="Email" required>
                                        </div>
                                        <div class="form-group mt-5">
                                            <input type="text" class="form-control border-left-0 border-top-0 border-right-0" name="instagram" placeholder="Instagram" required>
                                        </div>
                                        <div class="form-group mt-5">
                                            <input type="text" class="form-control border-left-0 border-top-0 border-right-0" name="nomor_whatsapp" placeholder="Nomor WhatsApp Ketua" required>
                                        </div>
                                        <div class="form-group mt-5">
                                            <input type="text" class="form-control border-left-0 border-top-0 border-right-0" name="alamat" placeholder="Alamat" required>
                                        </div>
                                    </div>
                                    <div class="row px-5 px-lg-0 mt-5 pt-5">
                                        <button type="button" class="col-lg-3 mt-3 btn btn-primary badge-pill badge-primary p-3" style="background: #3F0A3E;font-weight:300;" onclick="showHideElement('#registration-section','#requirement-section')">Kembali</button>
                                        <button type="button" class="col-lg-3 mt-3 offset-lg-6 btn btn-primary badge-pill badge-primary p-3" style="background: #3F0A3E;font-weight:300;" onclick="toStepper(2)">Selanjutnya</button>
                                    </div>
                                </div>
                                <div id="personal-info-part" class="content pt-5" role="tabpanel" aria-labelledby="personal-info-part-trigger">
                                    <div id="anggota_1">
                                        <div class="px-2 px-lg-5 mx-2 mx-lg-5">
                                            <div class="form-group mt-5">
                                                <input type="text" class="form-control border-left-0 border-top-0 border-right-0" name="nama_anggota_1" placeholder="Nama Anggota 1">
                                            </div>
                                            <div class="form-group mt-5">
                                                <input type="text" class="form-control border-left-0 border-top-0 border-right-0" name="nomor_whatsapp_anggota_1" placeholder="Nomor WhatsApp Anggota 1">
                                            </div>
                                        </div>
                                        <p style="font-weight: 400;opacity:0.5"> Jika tidak ada anggota 1, bisa dilewati</p>
                                        <div class="row px-5 px-lg-0 mt-5 pt-5">
                                            <button type="button" class="col-lg-3 mt-3 btn btn-primary badge-pill badge-primary p-3" style="background: #3F0A3E;font-weight:300;" onclick="toStepper(1)">Sebelumnya</button>
                                            <button type="button" class="col-lg-3 mt-3 offset-lg-6 btn btn-primary badge-pill badge-primary p-3" style="background: #3F0A3E;font-weight:300;" onclick="showHideElement('#anggota_1','#anggota_2')">Selanjutnya</button>
                                        </div>
                                    </div>
                                    <div id="anggota_2" style="display: none">
                                        <div class="px-2 px-lg-5 mx-2 mx-lg-5">
                                            <div class="form-group mt-5">
                                                <input type="text" class="form-control border-left-0 border-top-0 border-right-0" name="nama_anggota_2" placeholder="Nama Anggota 2">
                                            </div>
                                            <div class="form-group mt-5">
                                                <input type="text" class="form-control border-left-0 border-top-0 border-right-0" name="nomor_whatsapp_anggota_2" placeholder="Nomor WhatsApp Anggota 2">
                                            </div>
                                        </div>
                                        <p style="font-weight: 400;opacity:0.5"> Jika tidak ada anggota 2, bisa dilewati</p>
                                        <div class="row px-5 px-lg-0 mt-5 pt-5">
                                            <button type="button" class="col-lg-3 mt-3 btn btn-primary badge-pill badge-primary p-3" style="background: #3F0A3E;font-weight:300;" onclick="showHideElement('#anggota_2','#anggota_1')">Sebelumnya</button>
                                            <button type="submit" class="col-lg-3 mt-3 offset-lg-6 btn btn-primary badge-pill badge-primary p-3" style="background: #3F0A3E;font-weight:300;">Selanjutnya</button>
                                        </div>
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
                                            Terima kasih telah mendaftar Virtual Art Exhibition ITS EXPO 2021. Silahkan menuju dahsboard untuk melanjutkan proses pelengkapan berkas.
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