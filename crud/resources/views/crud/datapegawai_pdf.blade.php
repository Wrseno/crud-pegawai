<!DOCTYPE html>
<html>
<head>
<style>
#customers {
  font-family: Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

#customers td, #customers th {
  border: 1px solid #ddd;
  padding: 8px;
}

#customers tr:nth-child(even){background-color: #f2f2f2;}

#customers tr:hover {background-color: #ddd;}

#customers th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
  background-color: #04AA6D;
  color: white;
}
</style>
</head>
<body>

<h1>Data Pegawai</h1>

<table id="customers">
  <tr>
    <th>#</th>
    <th>Nama</th>
    <th>Foto</th>
    <th>Jenis Kelamin</th>
    <th>Nomor Telepon</th>
  </tr>
  @php 
    $no = 1;
  @endphp
  @foreach($data as $d)
  <tr>
    <td>{{ $no++ }}</td>
    <td>{{ $d->nama }}</td>
    <td>{{ $d->jeniskelamin }}</td>
    <td>{{ $d->nomortelepon }}</td>
  </tr>
  @endforeach
</table>

</body>
</html>
