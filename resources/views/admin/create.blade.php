<!DOCTYPE html>
<html>
<head>
    <title>Tambah Kamar</title>
    <style>
        body{
            margin:0;
            font-family:'Segoe UI',Arial,sans-serif;
            background:linear-gradient(120deg,#fffdf5,#f0fdfa);
        }

        .navbar{
            background:white;
            padding:18px 10%;
            display:flex;
            justify-content:space-between;
            align-items:center;
            box-shadow:0 4px 20px rgba(0,0,0,.05);
        }

        .nav-links a{
            margin-right:25px;
            text-decoration:none;
            font-weight:600;
            color:#0f766e;
            transition:.3s;
        }

        .nav-links a:hover{
            color:#ca8a04;
        }

        .logout-btn{
            padding:8px 16px;
            border-radius:20px;
            border:2px solid #facc15;
            background:#fef9c3;
            color:#92400e;
            font-weight:600;
            cursor:pointer;
            transition:.3s;
        }

        .logout-btn:hover{
            background:#fde047;
        }

        .container{
            display:flex;
            justify-content:center;
            align-items:center;
            min-height:85vh;
        }

        .card{
            background:white;
            padding:40px;
            width:450px;
            border-radius:25px;
            box-shadow:0 20px 40px rgba(0,0,0,.08);
        }

        h2{
            text-align:center;
            margin-bottom:30px;
            color:#ca8a04;
        }

        label{
            display:block;
            margin-top:15px;
            margin-bottom:6px;
            font-weight:600;
            color:#0f766e;
        }

        input, select{
            width:100%;
            padding:10px;
            border-radius:12px;
            border:1px solid #e2e8f0;
            outline:none;
            transition:.3s;
        }

        input:focus, select:focus{
            border-color:#facc15;
            box-shadow:0 0 0 3px rgba(250,204,21,.2);
        }

        .button-group{
            display:flex;
            gap:12px;
            margin-top:20px;
        }

        .btn{
            flex:1;
            padding:12px;
            border-radius:14px;
            border:2px solid #facc15;
            background:#fef9c3;
            color:#92400e;
            font-weight:600;
            cursor:pointer;
            transition:.3s;
        }

        .btn:hover{
            background:#fde047;
            transform:translateY(-2px);
        }

        .btn-cancel{
            flex:1;
            padding:12px;
            border-radius:14px;
            border:2px solid #d1d5db;
            background:#f8fafc;
            color:#475569;
            font-weight:600;
            text-align:center;
            text-decoration:none;
            transition:.3s;
        }

        .btn-cancel:hover{
            background:#e2e8f0;
            transform:translateY(-2px);
        }
    </style>
</head>
<body>

<div class="navbar">
    <div class="nav-links">
        <a href="{{ route('admin.dashboard') }}">Dashboard</a>
        <a href="{{ route('admin.reservasi') }}">Reservasi</a>
        <a href="{{ route('welcome') }}">Beranda</a>
    </div>
    <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button class="logout-btn">Logout</button>
    </form>
</div>

<div class="container">
<div class="card">
    <h2>Tambah Kamar</h2>

    <form action="{{ route('admin.store') }}" method="POST">
        @csrf

        <label>ID Kamar</label>
        <input type="text" name="id_kamar">

        <label>Nomor Kamar</label>
        <input type="number" name="nomor_kamar">

        <label>Tipe Kamar</label>
        <select name="tipe_kamar">
            <option value="Standard">Standard</option>
            <option value="Deluxe">Deluxe</option>
            <option value="Suite">Suite</option>
        </select>

        <label>Harga Kamar</label>
        <input type="number" name="harga_kamar">

        <label>Status</label>
        <select name="status_kamar">
            <option value="Tersedia">Tersedia</option>
            <option value="Tidak Tersedia">Tidak Tersedia</option>
        </select>

        <div class="button-group">
            <button type="submit" class="btn">Simpan</button>
            <a href="{{ route('admin.dashboard') }}" class="btn-cancel">Batalkan</a>
        </div>
    </form>
</div>
</div>

</body>
</html>
