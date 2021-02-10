<!doctype html>
<html lang="en">
  <head>
    <title>Beasiswa Fair - ITS Expo 2021</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Rubik:wght@300;400;500&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('vendor/icofont/icofont.min.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bs-stepper/dist/css/bs-stepper.min.css">
    <style>
        body{
            font-family: 'Rubik', sans-serif;
        }
        .wrap{
            overflow-x:hidden;
        }
        .bg-kiri{
            background: linear-gradient(159.96deg, #F53B4B -20.42%, #FFB953 93.03%);
            min-height:80vh;
        }
        .requirement-list{
            list-style: none;
        }
        .requirement-list li h4{
            font-weight:300;
            margin:0;
            color: #3F0A3E;
        }
        .requirement-list li::before{
            content: "\2022"; 
            color: #F96C4F;
            font-weight: 900; 
            font-size:3em;
            width: 1em; 
            line-height:40px;
        }
        .step-trigger{
            display: flex;
            flex-direction: column;
            padding:0;
        }
        .bs-stepper-header .line{
            flex:1;
            margin:0;
            margin-top:-25px;
            background-color:#F96C4F;
        }
        .bs-stepper-circle{
            background: #F96C4F;
        }
        .active .bs-stepper-circle{
            background: #F96C4F;
        }
        .bs-stepper-label{
            font-family: 'Rubik', sans-serif;
            font-weight:400;
            color:#3F0A3E;
            
        }
    </style>
  </head>
  <body>
      <div class="container-fluid p-0 wrap">
          <nav class="navbar sticky-top navbar-expand-sm navbar-light" style="background-color:#0f0f0f00;position:absolute">
              <a class="navbar-brand" href="{{url('/')}}"><img src="{{asset('/img/logo_putih.png')}}" width="100" class="m-3 img-fluid d-none d-lg-block" alt="Logo"><img src="{{asset('/img/logo.svg')}}" width="100" class="m-3 img-fluid d-block d-lg-none" alt="Logo"></a>
          </nav>
          <main>
            <div class="row" style="min-height:80vh;">
                <div class="col-lg-4 d-none d-lg-flex flex-column align-items-center justify-content-center text-white bg-kiri">
                    <img src="{{asset('/img/beasiswa_fair.png')}}" style="width:30%" class="img-fluid" alt="Beasiswa Fair">
                    <h1 class="mt-3 text-center" style="font-family: 'Raleway', sans-serif;font-weight:800">Beasiswa Fair</h1>
                    <h3 class="mt-3 text-center" style="font-weight:300">ITS EXPO 2021</h3>
                </div>
                <div class="col-lg-8 p-3">
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
                                    <li class="d-flex align-items-lg-center"><h4>Peserta wajib mengikuti akun instagram @its_expo</h4></li>
                                    <li class="d-flex align-items-lg-center"><h4>Peserta mengunggah twibbon di instagram</h4></li>
                                    <li class="d-flex align-items-lg-center"><h4>Peserta mengunggah story instagram</h4></li>
                                </ul>
                                <div class="row px-5 px-lg-0 mt-5 pt-5">
                                    <button type="button" class="col-lg-3 mt-3 btn btn-primary badge-pill badge-primary p-3" style="background: #3F0A3E;font-weight:300;">Unduh Twibbon</button>
                                    <button type="button" class="col-lg-3 mt-3 offset-lg-6 btn btn-primary badge-pill badge-primary p-3" style="background: #3F0A3E;font-weight:300;" onclick="toStepper(2)">Selanjutnya</button>
                                </div>
                              </div>
                              <div id="personal-info-part" class="content pt-5" role="tabpanel" aria-labelledby="personal-info-part-trigger">
                                    <div class="px-2 px-lg-5 mx-2 mx-lg-5">
                                        <div class="form-group">
                                            <input type="text" class="form-control border-left-0 border-top-0 border-right-0" name="nama" placeholder="Nama" required>
                                        </div>
                                        <div class="form-group mt-5">
                                            <input type="email" class="form-control border-left-0 border-top-0 border-right-0" name="email" placeholder="Email" required>
                                        </div>
                                        <div class="form-group mt-5">
                                            <input type="text" class="form-control border-left-0 border-top-0 border-right-0" name="instansi" placeholder="Instansi" required>
                                        </div>
                                        <div class="form-group mt-5">
                                            <input type="text" class="form-control border-left-0 border-top-0 border-right-0" name="no_wa" placeholder="Nomor WhatsApp" required>
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
                                                <input type="file" name="file_follow" id="file_follow" class="d-none" accept="image/*" required/>
                                            </div>
                                        </div>
                                        <div class="row my-5">
                                            <label for="file_twibbon" class="col-lg-6" style="font-weight:400;color:#000000;opacity:0.5">Bukti unggah Twibbon</label>
                                            <div class="col-lg-6">
                                                <button type="button" class="float-lg-right btn btn-primary badge-pill badge-primary p-2 px-lg-5" style="background: #3F0A3E;font-weight:400;" onclick="$('#file_twibbon').click()">Tambahkan File</button>
                                                <input type="file" name="file_twibbon" id="file_twibbon" class="d-none" accept="image/*" required/>
                                            </div>
                                        </div>
                                        <div class="row my-5">
                                            <label for="file_story" class="col-lg-6" style="font-weight:400;color:#000000;opacity:0.5">Bukti story instagram</label>
                                            <div class="col-lg-6">
                                                <button type="button" class="float-lg-right btn btn-primary badge-pill badge-primary p-2 px-lg-5" style="background: #3F0A3E;font-weight:400;" onclick="$('#file_story').click()">Tambahkan File</button>
                                                <input type="file" name="file_story" id="file_story" class="d-none" accept="image/*" required/>
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
                </div>
            </div>
          </main>
          <footer>
              <div class="container-fluid p-5" style="background: #3F0A3E; color:white;min-height:20vh">
                <div class="row">
                    <div class="col-lg-4">
                        <p style="font-weight: 300"><span style="font-weight: 500">Sekretariat ITS Expo</span><br/>Ruang 204 Gedung SCC lt 2, Kampus Sukolilo Institut Teknologi Sepuluh Nopember Surabaya 60111, Jawa Timur</p> 
                    </div>
                    <div class="col-lg-4 offset-lg-4 text-lg-right d-flex flex-column justify-content-center">
                        <p style="font-weight: 300">Ikuti kami di sosial media</p> 
                        <div><i class="icofont-line-messenger icofont-lg mr-3"></i><i class="icofont-instagram icofont-lg mr-3"></i> <i class="icofont-youtube-play icofont-lg mr-3"></i></div>
                    </div>
                </div>
              </div>
          </footer>
      </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/bs-stepper/dist/js/bs-stepper.min.js"></script>
    <script>
        $(document).ready(function () {
            var stepper = new Stepper($('.bs-stepper')[0])
        })
        

        function toStepper(number){
            var stepper = new Stepper($('.bs-stepper')[0])
            stepper.to(number)
        }
    </script>
  </body>
</html>