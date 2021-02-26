@extends('adminlte::page')

@section('title', 'Pengumpulan')

@section('content_header')
<h1 class="d-inline">Pengumpulan</h1>
@include('components/validation')
@stop

@section('content')
<div class="card mb-0">
  <div class="card-header">Pengumpulan</div>
  <div class="card-body">
    @if($belumBayar)
    <p>Pembayaran belum diverifikasi</p>
    @else
    <div class="accordion" id="accordionInstruction">
    @forelse ($instructions as $i)
      <div class="card">
        <div class="card-header" id="headingOne">
          <h2 class="mb-0">
            <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapse{{$i->id}}" aria-expanded="true" aria-controls="collapse{{$i->id}}">
              {{$i->title}}
            </button>
          </h2>
        </div>
        
        <div id="collapse{{$i->id}}" class="collapse" aria-labelledby="headingOne" data-parent="#accordionInstruction">
          <div class="card-body">
            <div>
              {!!$i->content!!}
            </div>
            @if(isset($submissions[$i->id]))
            <div class="">
              <h3>Submisi diunggah</h3>
              <p>
                Judul : {{$submissions[$i->id]['name']}}
              </p>
              <p>
                Deskripsi : {{$submissions[$i->id]['description']}}
              </p>
            </div>
            <div class>
              @if($submissions[$i->id]['path'])
              <form action="{{route('pengguna.submission.berkas')}}" method="POST">
                @csrf
                <input type="hidden" name="berkas" value="{{$submissions[$i->id]['path']}}">
                <div class="mb-3">
                  <button class="btn btn-primary" id="submissionDownload"  formtarget="_blank">Unduh Submisi</button>
                </div>
              </form>
              @endif
            </div>
            @endif

            <div class="text-center">
              @if(isset($submissions[$i->id]) && $submissions[$i->id]['path'])
                <button class="btn btn-primary" data-id="{{$i->id}}" onclick="addModal(this)" >Ganti</button>
              @else
              <button class="btn btn-primary" data-id="{{$i->id}}" onclick="addModal(this)" >Unggah</button>
              @endif
            </div>
            
          </div>
        </div>
      </div>
      @empty
      <p>Belum ada pengumpulan</p>
      @endforelse
      
    </div>
    @endif
  </div>
</div>

<div class="modal fade" id="addSubmisi" tabindex="-1" role="dialog" aria-labelledby="addSubmisi" aria-hidden="true">
  <div class="modal-dialog" role="document">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title" id="addSubmisi">Buat Submisi</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
          </div>
          <div class="modal-body">
              <form action="" method="POST" id="addSubmisiForm" enctype="multipart/form-data">
                  @csrf
                  <input type="hidden" name="instruction_id" id="instructionId">
                  <div class="form-group">
                      <label for="judul">Judul</label>
                      <input type="text" class="form-control" name="name" placeholder="Judul sesuai ketentuan" id="judul" autofocus required>
                  </div>
                  <div class="form-group">
                    <label for="description" class="form-label">Deskripsi</label>
                    <textarea class="form-control" id="description" name="description" rows="5" placeholder="Deskripsi sesuai ketentuan" required></textarea>
                  </div>
                  <label class="form-label">Submisi</label>
                  <div class="mb-3 custom-file">
                    <input type="file" class="custom-file-input" id="submisi" name="submission" accept=".zip,.pdf,image/*">
                    <label class="custom-file-label" for="submisi">Pilih Berkas</label>
                  </div>
                  <div class=" text-right mb-2">
                      <br>
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                      <button class="btn btn-success" type="submit">Submit</button>
                  </div>
              </div>
              </form>
          </div>
      </div>
  </div>
</div>
@stop

@section('js')
<script>
  function addModal(e) {
    let addForm = document.getElementById('addSubmisiForm');
    document.getElementById('instructionId').value = e.dataset.id;
    $('#addSubmisi').modal();
  }
  setInputFile();
  function setInputFile() {
    $('input[type="file"]').change(function(e){
          var fileName = e.target.files[0].name;
          $(e.target.nextElementSibling).html(fileName);
      });
  }
</script>
@stop