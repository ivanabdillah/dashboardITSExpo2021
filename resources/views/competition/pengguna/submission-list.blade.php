@extends('adminlte::page')

@section('title', 'Berkas Dikumpulkan')

@section('content_header')
<h1 class="d-inline">Berkas Dikumpulkan</h1>
@include('components/validation')
@stop

@section('content')
<div class="card mb-0">
  <div class="card-header">Berkas Dikumpulkan</div>
  <div class="card-body">
    <div class="accordion" id="accordionSubmissions">
    @forelse ($submissions as $s)
      <div class="card">
        <div class="card-header" id="headingOne">
          <h2 class="mb-0">
            <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapse{{$s->id}}" aria-expanded="true" aria-controls="collapse{{$s->id}}">
              {{$s->name}}
            </button>
          </h2>
        </div>
        
        <div id="collapse{{$s->id}}" class="collapse" aria-labelledby="headingOne" data-parent="#accordionSubmissions">
          <div class="card-body">
            <div>
              <p>
                Deskripsi: {{$s->description}}
              </p>
            </div>
            <div class>
              @if($s['path'])
              <form action="{{route('pengguna.submission.berkas')}}" method="POST">
                @csrf
                <input type="hidden" name="berkas" value="{{$s['path']}}">
                <div class="mb-3">
                  <button class="btn btn-primary" id="ktmAnggotaPertama"  formtarget="_blank">Unduh Submisi</button>
                </div>
              </form>
              @endif
            </div>
          </div>
        </div>
      </div>
      @empty
      <p>Tidak ada berkas</p>
      @endforelse
      
    </div>
  </div>
</div>
@stop