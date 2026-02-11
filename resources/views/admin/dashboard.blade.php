<!DOCTYPE html>
<html>
<head>
    <title>Data Kamar</title>
    <style>
        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
            font-family:'Segoe UI', sans-serif;
        }

        body{
            background:linear-gradient(135deg,#fffdf5,#fef3c7);
        }

        .navbar{
            background:white;
            padding:18px 50px;
            display:flex;
            justify-content:space-between;
            align-items:center;
            box-shadow:0 8px 20px rgba(0,0,0,0.05);
            position:sticky;
            top:0;
            z-index:100;
        }

        .nav-left{
            display:flex;
            gap:25px;
        }

        .nav-link{
            text-decoration:none;
            font-weight:600;
            color:#b45309;
            position:relative;
            padding:6px 0;
        }

        .nav-link::after{
            content:"";
            position:absolute;
            left:0;
            bottom:0;
            height:2px;
            width:0%;
            background:#facc15;
            transition:.4s;
        }

        .nav-link:hover::after{
            width:100%;
        }

        .logout-btn{
            padding:8px 16px;
            border-radius:10px;
            border:2px solid #facc15;
            background:transparent;
            color:#b45309;
            font-weight:600;
            cursor:pointer;
            position:relative;
            overflow:hidden;
            transition:.3s;
        }

        .logout-btn::before{
            content:"";
            position:absolute;
            left:0;
            top:0;
            height:100%;
            width:0%;
            background:#facc15;
            z-index:-1;
            transition:.4s;
        }

        .logout-btn:hover{
            color:white;
        }

        .logout-btn:hover::before{
            width:100%;
        }

        .container{
            padding:50px;
        }

        h2{
            font-size:28px;
            margin-bottom:30px;
            color:#b45309;
            letter-spacing:1px;
        }

        .card{
            background:white;
            padding:35px;
            border-radius:20px;
            box-shadow:0 20px 40px rgba(0,0,0,0.08);
        }

        .top-bar{
            display:flex;
            justify-content:space-between;
            align-items:center;
            margin-bottom:30px;
            flex-wrap:wrap;
            gap:15px;
        }

        .group-btn{
            display:flex;
            gap:12px;
        }

        .btn{
            padding:10px 18px;
            border-radius:12px;
            border:2px solid #facc15;
            background:transparent;
            color:#b45309;
            font-weight:600;
            cursor:pointer;
            text-decoration:none;
            position:relative;
            overflow:hidden;
            transition:.3s;
        }

        .btn::before{
            content:"";
            position:absolute;
            left:0;
            top:0;
            height:100%;
            width:0%;
            background:#facc15;
            z-index:-1;
            transition:.4s;
        }

        .btn:hover{
            color:white;
        }

        .btn:hover::before{
            width:100%;
        }

        .search-box{
            display:flex;
            gap:10px;
        }

        .search-box input{
            padding:10px 15px;
            border-radius:10px;
            border:1px solid #fde68a;
            outline:none;
            width:260px;
            background:#fffdf7;
        }

        table{
            width:100%;
            border-collapse:collapse;
            border-radius:15px;
            overflow:hidden;
        }

        thead{
            background:#facc15;
            color:#78350f;
        }

        th, td{
            padding:14px;
            text-align:center;
        }

        tbody tr{
            border-bottom:1px solid #fef3c7;
            transition:.2s;
        }

        tbody tr:hover{
            background:#fff7d6;
        }

        .badge{
            padding:6px 12px;
            border-radius:20px;
            font-size:12px;
            font-weight:600;
        }

        .tersedia{background:#dcfce7;color:#166534;}
        .penuh{background:#fee2e2;color:#991b1b;}

        .action-btn{
            padding:6px 14px;
            border-radius:8px;
            border:none;
            font-size:12px;
            font-weight:600;
            cursor:pointer;
            transition:.3s;
        }

        .edit{
            background:#fef08a;
            color:#92400e;
        }

        .edit:hover{
            background:#fde047;
        }

        .delete{
            background:#fecaca;
            color:#7f1d1d;
        }

        .delete:hover{
            background:#f87171;
            color:white;
        }
    </style>
</head>
<body>

<div class="navbar">
    <div class="nav-left">
        <a href="{{ route('admin.dashboard') }}" class="nav-link">Dashboard</a>
        <a href="{{ route('admin.reservasi') }}" class="nav-link">Data Reservasi</a>
        <a href="{{ route('welcome') }}" class="nav-link">Beranda</a>
    </div>

    <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button class="logout-btn">Logout</button>
    </form>
</div>

<div class="container">

<h2>DATA KAMAR HOTEL</h2>

<div class="card">

<div class="top-bar">

    <div class="group-btn">
        <a href="{{ route('admin.create') }}" class="btn">Tambah Kamar</a>
    </div>

    <div class="search-box">
        <form action="{{ route('admin.search') }}" method="GET">
            <input type="text" name="search" placeholder="Cari nomor / tipe kamar">
            <button class="btn">Search</button>
        </form>
    </div>

</div>

<table>
<thead>
<tr>
    <th>ID Kamar</th>
    <th>Nomor Kamar</th>
    <th>Tipe</th>
    <th>Harga</th>
    <th>Status</th>
    <th>Aksi</th>
</tr>
</thead>

<tbody>
@foreach($kamar as $k)
<tr>
    <td>{{ $k->id_kamar }}</td>
    <td>{{ $k->nomor_kamar }}</td>
    <td>{{ $k->tipe_kamar }}</td>
    <td>Rp {{ number_format($k->harga_kamar,0,',','.') }}</td>
    <td>
        <span class="badge {{ $k->status_kamar == 'Tersedia' ? 'tersedia' : 'penuh' }}">
            {{ $k->status_kamar }}
        </span>
    </td>
    <td>
        <a href="{{ route('admin.edit',$k->id_kamar) }}">
            <button class="action-btn edit">Edit</button>
        </a>

        <form action="{{ route('admin.delete',$k->id_kamar) }}" method="POST" style="display:inline;">
            @csrf
            @method('DELETE')
            <button class="action-btn delete">Hapus</button>
        </form>
    </td>
</tr>
@endforeach
</tbody>

</table>

</div>
</div>

</body>
</html>
