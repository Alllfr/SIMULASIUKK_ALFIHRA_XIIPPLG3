<!DOCTYPE html>
<html>
<head>
    <title>Data Reservasi</title>
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

        .menunggu{background:#fef9c3;color:#854d0e;}
        .selesai{background:#dcfce7;color:#166534;}
        .batal{background:#fee2e2;color:#991b1b;}
    </style>
</head>
<body>

<div class="navbar">
    <div class="nav-left">
        <a href="{{ route('admin.dashboard') }}" class="nav-link">Dashboard</a>
        <a href="{{ route('welcome') }}" class="nav-link">Beranda</a>
    </div>

    <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button class="logout-btn">Logout</button>
    </form>
</div>

<div class="container">

<h2>DATA RESERVASI HOTEL</h2>

<div class="card">

<table>
<thead>
<tr>
    <th>ID Reservasi</th>
    <th>Nama Tamu</th>
    <th>No HP</th>
    <th>Kamar</th>
    <th>Check In</th>
    <th>Check Out</th>
    <th>Jumlah Tamu</th>
    <th>Total Bayar</th>
    <th>Status</th>
</tr>
</thead>

<tbody>
@foreach($reservasi as $r)
<tr>
    <td>{{ $r->id_reservasi }}</td>
    <td>{{ $r->nama_tamu }}</td>
    <td>{{ $r->no_hp }}</td>
    <td>{{ $r->kamar->nomor_kamar ?? '-' }}</td>
    <td>{{ $r->check_in }}</td>
    <td>{{ $r->check_out }}</td>
    <td>{{ $r->jumlah_tamu }}</td>
    <td>Rp {{ number_format($r->total_bayar,0,',','.') }}</td>
    <td>
        <span class="badge 
            {{ $r->status_reservasi == 'Menunggu' ? 'menunggu' : 
               ($r->status_reservasi == 'Selesai' ? 'selesai' : 'batal') }}">
            {{ $r->status_reservasi }}
        </span>
    </td>
</tr>
@endforeach
</tbody>

</table>

</div>
</div>

</body>
</html>
