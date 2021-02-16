@extends('components.main')
@section('css')
<link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Rubik:wght@300;400;500&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('vendor/icofont/icofont.min.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bs-stepper/dist/css/bs-stepper.min.css">
    <style>
        body{
            font-family: 'Rubik', sans-serif;
        }
        .wrap{
            overflow-x:hidden;
        }
        .requirement-list{
        }
        .requirement-list li h4{
            font-weight:300;
            margin:0;
            color: #3F0A3E;
        }
        .requirement-list li::marker{
            content: "•"; 
            color: #F96C4F;
            font-weight: 900; 
            font-size:2em;
            width: 1em; 
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
@endsection

@section('content')
<nav class="navbar sticky-top navbar-expand-sm navbar-light" style="background-color:#0f0f0f00;position:absolute">
    <a class="navbar-brand" href="{{url('/')}}"><img src="{{asset('/img/logo_putih.png')}}" width="100" class="m-3 img-fluid d-none d-lg-block" alt="Logo"><img src="{{asset('/img/logo.svg')}}" width="100" class="m-3 img-fluid d-block d-lg-none" alt="Logo"></a>
</nav>
<main>
  <div class="row" style="min-height:80vh;">
      <div class="col-lg-4 d-none d-lg-flex flex-column align-items-center justify-content-center text-white bg-kiri">
          <img src="@yield('image_kiri')" style="width:30%" class="img-fluid" alt="@yield('title')">
          <h1 class="mt-3 text-center" style="font-family: 'Raleway', sans-serif;font-weight:800">@yield('title')</h1>
          <h3 class="mt-3 text-center" style="font-weight:300">ITS EXPO 2021</h3>
      </div>
      <div class="col-lg-8 p-3">
          @yield('section_kanan')
      </div>
  </div>
</main>
@endsection

@section('js')
<script src="https://cdn.jsdelivr.net/npm/bs-stepper/dist/js/bs-stepper.min.js"></script>
    <script>
        $(document).ready(function () {
            var stepper = new Stepper($('.bs-stepper')[0])
            stepper.to(3)
        })
        

        function toStepper(number){
            var stepper = new Stepper($('.bs-stepper')[0])
            stepper.to(number)
        }
    </script>
@endsection