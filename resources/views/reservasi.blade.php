<!DOCTYPE html>
<html>
<head>
    <title>Booking Kamar Hotel</title>
    <style>
        body{
            background:linear-gradient(120deg,#fffdf5,#f0fdfa);
            font-family:'Segoe UI',Arial,sans-serif;
            padding:50px;
            color:#334155;
        }

        h2{
            text-align:center;
            margin-bottom:30px;
            color:#0f766e;
            letter-spacing:1px;
        }

        form{
            max-width:520px;
            margin:auto;
            background:white;
            padding:35px;
            border-radius:25px;
            box-shadow:0 20px 45px rgba(0,0,0,.08);
        }

        label{
            display:block;
            margin-top:15px;
            font-size:14px;
            color:#64748b;
        }

        input{
            width:100%;
            padding:12px 14px;
            margin-top:6px;
            border-radius:14px;
            border:1px solid #e2e8f0;
            outline:none;
            transition:.3s;
            background:#fbfdff;
        }

        input:focus{
            border-color:#5eead4;
            box-shadow:0 0 0 3px rgba(94,234,212,.3);
        }

        .info-box{
            background:linear-gradient(120deg,#fef9c3,#ccfbf1);
            padding:16px;
            border-radius:18px;
            margin-bottom:20px;
            font-size:14px;
            color:#065f46;
        }

        .total-box{
            margin-top:20px;
            padding:16px;
            border-radius:18px;
            background:#dcfce7;
            color:#166534;
            font-weight:600;
            display:none;
        }

        .btn-group{
            display:flex;
            gap:15px;
            margin-top:25px;
        }

        button{
            flex:1;
            padding:12px;
            border:none;
            border-radius:18px;
            background:#facc15;
            color:#78350f;
            font-weight:600;
            cursor:pointer;
            transition:.3s;
        }

        button:hover{
            background:#eab308;
            transform:translateY(-3px);
        }

        .btn-cancel{
            flex:1;
            padding:12px;
            border-radius:18px;
            background:#ccfbf1;
            color:#065f46;
            text-align:center;
            text-decoration:none;
            font-weight:600;
            transition:.3s;
        }

        .btn-cancel:hover{
            background:#99f6e4;
            transform:translateY(-3px);
        }

        .error{
            margin-top:12px;
            color:#dc2626;
            font-size:14px;
            text-align:center;
            display:none;
        }
    </style>
</head>
<body>

<h2>FORM BOOKING KAMAR</h2>

<form action="{{ route('reservasi.store') }}" method="POST" oninput="hitungTotal()" onsubmit="return validasiTanggal()">
@csrf

<input type="hidden" name="id_kamar" value="{{ $kamar->id_kamar }}">

<div class="info-box">
    <strong>Kamar:</strong> No {{ $kamar->nomor_kamar }} - {{ $kamar->tipe_kamar }} <br>
    <strong>Harga per malam:</strong> Rp <span id="harga">{{ $kamar->harga_kamar }}</span>
</div>

<label>Nama Tamu</label>
<input type="text" name="nama_tamu" required>

<label>No Handphone</label>
<input type="text" name="no_hp" pattern="[0-9]+" required>

<label>Tanggal Check In</label>
<input type="date" id="check_in" name="check_in" required>

<label>Tanggal Check Out</label>
<input type="date" id="check_out" name="check_out" required>

<label>Jumlah Tamu</label>
<input type="number" name="jumlah_tamu" min="1" required>

<div id="totalBox" class="total-box">
    <div id="keterangan"></div>
    <div id="totalHarga"></div>
</div>

<div id="error" class="error">
Tanggal check-out tidak boleh lebih awal dari check-in
</div>

<div class="btn-group">
    <button type="submit">Booking Sekarang</button>
    <a href="{{ route('welcome') }}" class="btn-cancel">Batalkan</a>
</div>

</form>

<script>
function hitungTotal(){
    const harga = parseInt(document.getElementById('harga').innerText)
    const checkin = new Date(document.getElementById('check_in').value)
    const checkout = new Date(document.getElementById('check_out').value)
    const totalBox = document.getElementById('totalBox')

    if(checkin && checkout && checkout > checkin){
        const selisih = (checkout - checkin) / (1000*60*60*24)
        const total = selisih * harga

        document.getElementById('keterangan').innerText =
            "Rp " + harga.toLocaleString('id-ID') + " x " + selisih + " malam"

        document.getElementById('totalHarga').innerText =
            "Total Bayar: Rp " + total.toLocaleString('id-ID')

        totalBox.style.display = 'block'
    } else {
        totalBox.style.display = 'none'
    }
}

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
