<table>
  <thead>
    <tr>
      <th><strong>ID Tim</strong></th>
      <th><strong>Nama Tim</strong></th>
      <th><strong>Asal PT</strong></th>
      <th><strong>Email Tim</strong></th>
      <th><strong>Biaya Pendaftaran</strong></th>
      <th><strong>Nama</strong></th>
      <th><strong>Sebagai</strong></th>
      <th><strong>Jurusan</strong></th>
      <th><strong>Angkatan</strong></th>
      <th><strong>Nomor Telepon</strong></th>
      <th><strong>ID Line</strong></th>
    </tr>
  </thead>
  <tbody>
    @foreach ($users as $user)
      @if($user->ketua)
      <tr>
        <td>{{$user->id}}</td>
        <td>{{$user->team_name}}</td>
        <td>{{$user->college_name}}</td>
        <td>{{$user->user->email}}</td>
        @if($user->invoice and $user->invoice->promo)
          <td>{{"Rp " . number_format($user->competition->price - $user->invoice->promo->discount,2,',','.') . ' (' . $user->invoice['promo']['name'] .')'}}</td>
        @else
        <td>{{"Rp " . number_format($user->competition->price ,2,',','.') . '-' . ' (tanpa promo)'}}</td>
        @endif
        <td>{{$user->ketua->name}}</td>
        <td>Ketua</td>
        <td>{{$user->ketua->majors}}</td>
        <td>{{$user->ketua->year}}</td>
        <td>{{$user->ketua->phone}}</td>
        <td>{{$user->ketua->line}}</td>
      </tr>
      @endif

      @if($user->anggotaPertama)
      <tr>
        <td>{{$user->id}}</td>
        <td>{{$user->team_name}}</td>
        <td>{{$user->college_name}}</td>
        <td>{{$user->user->email}}</td>
        @if($user->invoice and $user->invoice->promo)
          <td>{{"Rp " . number_format($user->competition->price - $user->invoice->promo->discount,2,',','.') . ' (' . $user->invoice['promo']['name'] .')'}}</td>
        @else
        <td>{{"Rp " . number_format($user->competition->price ,2,',','.') . '-' . ' (tanpa promo)'}}</td>
        @endif
        <td>{{$user->anggotaPertama->name}}</td>
        <td>Anggota 1</td>
        <td>{{$user->anggotaPertama->majors}}</td>
        <td>{{$user->anggotaPertama->year}}</td>
        <td>{{$user->anggotaPertama->phone}}</td>
        <td>{{$user->anggotaPertama->line}}</td>
      </tr>
      @endif

      @if($user->anggotaKedua)
      <tr>
        <td>{{$user->id}}</td>
        <td>{{$user->team_name}}</td>
        <td>{{$user->college_name}}</td>
        <td>{{$user->user->email}}</td>
        @if($user->invoice and $user->invoice->promo)
          <td>{{"Rp " . number_format($user->competition->price - $user->invoice->promo->discount,2,',','.') . ' (' . $user->invoice['promo']['name'] .')'}}</td>
        @else
        <td>{{"Rp " . number_format($user->competition->price ,2,',','.') . '-' . ' (tanpa promo)'}}</td>
        @endif
        <td>{{$user->anggotaKedua->name}}</td>
        <td>Anggota 2</td>
        <td>{{$user->anggotaKedua->majors}}</td>
        <td>{{$user->anggotaKedua->year}}</td>
        <td>{{$user->anggotaKedua->phone}}</td>
        <td>{{$user->anggotaKedua->line}}</td>
      </tr>
      @endif
    @endforeach
  </tbody>
</table>