<!DOCTYPE html>
<html>
<head>
    <title>Booking Kamar Hotel</title>
    <style>
        body{
            background:linear-gradient(120deg,#f8fbff,#eef2ff);
            font-family:'Segoe UI',Arial,sans-serif;
            padding:40px;
            color:#334155;
        }
        h2{
            text-align:center;
            margin-bottom:25px;
            color:#475569;
            letter-spacing:1px;
        }
        form{
            max-width:480px;
            margin:auto;
            background:white;
            padding:30px;
            border-radius:22px;
            box-shadow:0 20px 45px rgba(0,0,0,.06);
            animation:fade .6s ease;
        }
        label{
            display:block;
            margin-top:14px;
            font-size:14px;
            color:#64748b;
        }
        input, select{
            width:100%;
            padding:12px 14px;
            margin-top:6px;
            border-radius:14px;
            border:1px solid #e2e8f0;
            outline:none;
            transition:.3s;
            background:#fbfdff;
        }
        input:focus, select:focus{
            border-color:#a5b4fc;
            box-shadow:0 0 0 3px rgba(165,180,252,.3);
        }
        .info{
            margin:10px 0;
            padding:12px;
            background:#eef2ff;
            border-radius:14px;
            font-size:14px;
            color:#3730a3;
        }
        .btn-group{
            display:flex;
            gap:12px;
            margin-top:24px;
        }
        button{
            flex:1;
            padding:12px;
            border:none;
            border-radius:16px;
            background:#c7d2fe;
            color:#3730a3;
            font-size:15px;
            cursor:pointer;
            transition:.3s;
            font-weight:600;
        }
        button:hover{
            background:#a5b4fc;
            transform:translateY(-3px);
            box-shadow:0 12px 25px rgba(165,180,252,.4);
        }
        .btn-cancel{
            background:#fde2e2;
            color:#7f1d1d;
            text-decoration:none;
            display:flex;
            align-items:center;
            justify-content:center;
            border-radius:16px;
            transition:.3s;
            font-weight:600;
        }
        .btn-cancel:hover{
            background:#fecaca;
            transform:translateY(-3px);
        }
        .error{
            margin-top:12px;
            color:#dc2626;
            font-size:14px;
            text-align:center;
            display:none;
        }
        @keyframes fade{
            from{opacity:0; transform:translateY(15px)}
            to{opacity:1; transform:translateY(0)}
        }
    </style>
</head>
<body>

<h2>FORM BOOKING KAMAR</h2>

<form action="{{ route('reservasi.store') }}" method="POST" onsubmit="return validasiTanggal()">
@csrf

<label>Pilih Kamar</label>
<select name="id_kamar" required>
    <option value="">-- Pilih Kamar --</option>
    @foreach($kamar as $k)
        <option value="{{ $k->id_kamar }}">
            No {{ $k->nomor_kamar }} - {{ $k->tipe_kamar }} (Rp {{ number_format($k->harga_kamar,0,',','.') }}/malam)
        </option>
    @endforeach
</select>

<label>Nama Tamu</label>
<input type="text" name="nama_tamu" placeholder="Masukkan nama lengkap" required>

<label>No Handphone</label>
<input type="text" name="no_hp" pattern="[0-9]+" inputmode="numeric" required>

<label>Tanggal Check In</label>
<input type="date" id="check_in" name="check_in" required>

<label>Tanggal Check Out</label>
<input type="date" id="check_out" name="check_out" required>

<label>Jumlah Tamu</label>
<input type="number" name="jumlah_tamu" min="1" required>

<div id="error" class="error">
Tanggal check-out tidak boleh lebih awal dari check-in
</div>

<div class="btn-group">
    <button type="submit">Booking Sekarang</button>
    <a href="{{ route('welcome') }}" class="btn-cancel">Batalkan</a>
</div>

</form>

<script>
function validasiTanggal(){
    const checkin = document.getElementById('check_in').value
    const checkout = document.getElementById('check_out').value
    const error = document.getElementById('error')

    if(checkin && checkout && checkout <= checkin){
        error.style.display = 'block'
        return false
    }
    error.style.display = 'none'
    return true
}
</script>

</body>
</html>
