@extends('adminlte::page')

@section('title', 'Pengumuman')

@section('content_header')
<h1 class="d-inline">Pengumuman</h1>
@include('components/validation')
@stop

@section('content')
<div class="card mb-0">
  <div class="card-header">Pengumuman</div>
  <div class="card-body">
    @forelse ($announcements as $a)
    <div class="callout callout-info">
      <h5>@if($a['competition']) {{strtoupper($a['competition']['name'])}} @else Semua @endif - {{$a['title']}}</h5>
      <p>{{$a['content']}}</p>
    </div>
    @empty
        <p>Tidak ada pengumuman</p>
    @endforelse
      
  </div>
</div>
@stop