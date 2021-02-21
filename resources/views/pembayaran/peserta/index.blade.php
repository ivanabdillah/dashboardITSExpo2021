@extends('adminlte::page')

@section('title', 'Pembayaran')

@section('content_header')
<h1 class="d-inline">Pembayaran</h1>
@include('components/validation')
@stop

@section('content')
<div class="card mb-0">
  <div class="card-header">Pembayaran</div>
  <div class="card-body">
    <div class="row">
      <div class="col-12 col-md-6 mb-5">
        <h5>Biaya yang perlu dibayar </h5>
        @if($invoice['promo'])
        <s class="text-danger">{{"Rp " . number_format($invoice['team']['competition']['price'],2,',','.')}}</s>
        <h1 class="my-2 text-center">
          {{"Rp " . number_format( $invoice['team']['competition']['price'] - $invoice['promo']['discount'],2,',','.') . '-'}}
        </h1>
        @else
        <h1 class="my-4 text-center">{{"Rp " . number_format($invoice['team']['competition']['price'],2,',','.') . '-'}}
        </h1>
        @endif

        <div>
          <form onsubmit="return terapkanPromo()" action="{{route('pengguna.pembayaran.cek-promo')}}" method="POST">
            @csrf
            <label for="kodePromo">Kode Promo</label>
            <div class="input-group mb-3">
              <input type="text" class="form-control" id="kodePromo" aria-describedby="promoHelp"
                placeholder="Masukkan kode promo disni" name="kode_promo" onfocus="resetHelp()"
                @if($invoice['approver_id'] and $invoice['approved_at']) disabled @endif @if($invoice['promo'])
                value="{{$invoice['promo']['name']}}" @endif>
              <div class="input-group-append">
                <button class="btn btn-success" id="buttonPromo" @if($invoice['approver_id'] and
                  $invoice['approved_at']) disabled @endif>Gunakan</button>
              </div>
            </div>
          </form>
        </div>

        @if($invoice['approver_id'] and $invoice['approved_at'])
        <div class="text-center">
          <p class="text-success mb-1">Selamat pembayaranmu telah diverifikasi </p>
          <a href="{{route('pengguna.pembayaran.berkas-bukti', $invoice['team_id'])}}" target="_blank"
            class="btn-sm btn-primary">Lihat Bukti</a>
        </div>
        @else
        <small id="promoHelp" class="form-text text-danger d-none"></small>
        <form action="{{route('pengguna.pembayaran.unggah-bukti')}}" method="post" enctype="multipart/form-data"
          id="formBukti">
          @csrf
          <label for="buktiBayar">Bukti Pembayaran</label>
          @if($invoice['payment_proof'])
          <div>
            <p>Bukti telah diunggah, silahkan menunggu dikonfirmasi</p>
            <a href="{{route('pengguna.pembayaran.berkas-bukti', $invoice['team_id'])}}" target="_blank"
              class="btn btn-primary">Lihat Bukti</a>
            <button class="btn btn-secondary mx-2" type="button" onclick="buktiInput()">Ganti</button>
          </div>

          @else
          <div>
            <div class="mb-3 custom-file">
              <input type="file" class="custom-file-input" id="buktiBayar" name="bukti_bayar" accept="image/*, .pdf"
                onchange="inputSelect(this)">
              <label class="custom-file-label" for="buktiBayar">Pilih Bukti Pembayaran</label>
            </div>
            <div class="text-center">
              <button class="btn btn-primary">Unggah</button>
            </div>
          </div>
          @endif
        </form>
        @endif
      </div>


      <div class="col-12 col-md-6">
        <h5>Metode Pembayaran</h5>
        <ul class="nav nav-tabs" id="myTab" role="tablist">
          <li class="nav-item" role="presentation">
            <a class="nav-link active" id="bank-bri-tab" data-toggle="tab" href="#bank-bri" role="tab"
              aria-controls="bank-bri" aria-selected="true">Bank BRI</a>
          </li>
          <li class="nav-item" role="presentation">
            <a class="nav-link" id="qr-gpn-tab" data-toggle="tab" href="#qr-gpn" role="tab" aria-controls="qr-gpn"
              aria-selected="false">QRIS</a>
          </li>
        </ul>
        <div class="tab-content" id="myTabContent">
          <div class="tab-pane fade show active py-3" id="bank-bri" role="tabpanel" aria-labelledby="bank-bri-tab">
            <h6>Tata Cara Pembayaran</h6>
            <p>Silahkan melakukan transfer ke rekening
              di bawah ini</p>
            <div class="text-center">
              <img class="p-5 text-center" src="{{asset('img/logo_bri.png')}}" alt="Logo bank BRI" width="300px">
              <p class="lead text-bold m-0">124801004712505 </p>
              <p class="leadm-0">atas nama <strong>Sarenti Hanarum</strong></p>
            </div>
          </div>
          <div class="tab-pane fade py-3" id="qr-gpn" role="tabpanel" aria-labelledby="qr-gpn-tab">
            <h6>Tata Cara Pembayaran</h6>
            <p>Silahkan scan kode QR di bawah ini</p>
            <img class="img-fluid" src="{{asset('img/bayar_qris.png')}}" alt="Logo bank BRI">
          </div>
        </div>
      </div>
    </div>
  </div>

</div>
</div>

@stop

@section('js')
<script>
  function inputSelect(e) {
    let fileName=e.files[0].name;
    e.nextElementSibling.textContent = fileName;
  }
            
  function resetHelp() {
    let smallEl = document.querySelector('#promoHelp');
    if(smallEl) smallEl.classList.add('d-none');
  }

  function terapkanPromo() {
    let kodePromo = document.querySelector('#kodePromo').value

    if(!kodePromo) {
      let smallEl = document.querySelector('#promoHelp');
      if(smallEl) {
        smallEl.textContent = 'Masukkan terlebih dahulu kode promo!'
        smallEl.classList.remove('d-none');
      }
      return false;
    }

    return true;
  }

  function buktiInput(){
    let buktiEl = document.createElement('DIV');
    buktiEl.innerHTML = `<div>
            <div class="mb-3 custom-file">
              <input type="file" class="custom-file-input" id="buktiBayar" name="bukti_bayar" accept="image/*, .pdf"
                onchange="inputSelect(this)">
              <label class="custom-file-label" for="buktiBayar">Pilih Bukti Pembayaran</label>
            </div>
            <div class="text-center">
              <button class="btn btn-primary">Unggah</button>
            </div>
          </div>`
    let formBukti = document.querySelector('#formBukti');
    formBukti.querySelector('p').remove();
    formBukti.querySelector('.btn').remove();
    formBukti.querySelector('.btn').remove();
    document.querySelector('#formBukti').appendChild(buktiEl);
  }

</script>
@stop