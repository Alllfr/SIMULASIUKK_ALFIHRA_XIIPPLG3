<!DOCTYPE html>
<html>
<head>
    <title>Reservasi Kamar Hotel</title>
    <style>
        html{scroll-behavior:smooth;}

        body{
            margin:0;
            font-family:'Segoe UI',Arial,sans-serif;
            background:linear-gradient(120deg,#fffdf5,#f0fdfa);
            color:#334155;
        }

        section{padding:80px 10%;}

        ::-webkit-scrollbar{width:14px;}
        ::-webkit-scrollbar-track{background:#fef3c7;}
        ::-webkit-scrollbar-thumb{
            background:linear-gradient(to bottom,#facc15 50%,#5eead4 50%);
            border-radius:20px;
            border:3px solid #fef3c7;
        }

        .hero{
            display:flex;
            align-items:center;
            justify-content:space-between;
            gap:60px;
            min-height:90vh;
        }

        .hero img{
            width:38%;
            height:340px;
            object-fit:cover;
            border-radius:25px;
            box-shadow:0 20px 40px rgba(0,0,0,.08);
            animation:fadeLeft 1s ease;
        }

        .hero-text{width:50%;animation:fadeRight 1s ease;}

        .hero-text h1{
            font-size:40px;
            margin-bottom:20px;
            color:#ca8a04;
        }

        .hero-text p{
            font-size:18px;
            margin-bottom:30px;
            color:#475569;
        }

        .stats{
            display:flex;
            gap:40px;
            margin:30px 0;
        }

        .stat-box{
            text-align:center;
        }

        .stat-number{
            font-size:32px;
            font-weight:700;
            color:#0f766e;
        }

        .stat-label{
            font-size:14px;
            color:#64748b;
        }

        .btn-hero{
            position:relative;
            padding:12px 32px;
            border:2px solid #facc15;
            background:#0f766e;
            border-radius:30px;
            cursor:pointer;
            font-weight:600;
            overflow:hidden;
            color:white;
            transition:.3s;
        }

        .btn-hero::before{
            content:"";
            position:absolute;
            left:0;
            top:0;
            width:0%;
            height:100%;
            background:#facc15;
            transition:.4s ease;
            z-index:0;
        }

        .btn-hero span{position:relative;z-index:1;}

        .btn-hero:hover::before{width:100%;}

        .section-table{
            background:linear-gradient(120deg,#fef9c3,#ccfbf1);
            border-top-left-radius:60px;
            border-top-right-radius:60px;
            animation:fadeUp 1s ease;
        }

        h2{text-align:center;margin-bottom:30px;color:#0f766e;}

        form{text-align:center;margin-bottom:30px;}

        select{
            padding:10px 14px;
            border-radius:20px;
            border:1px solid #a7f3d0;
            background:white;
            margin-right:10px;
        }

        button{
            padding:10px 20px;
            border:none;
            border-radius:20px;
            background:#facc15;
            color:white;
            cursor:pointer;
            transition:.3s;
        }

        button:hover{
            background:#eab308;
            transform:translateY(-2px);
        }

        table{
            width:100%;
            border-collapse:separate;
            border-spacing:0 15px;
        }

        th{padding:12px;color:#0f766e;}

        td{
            background:white;
            padding:16px;
            text-align:center;
            border-radius:20px;
            box-shadow:0 10px 30px rgba(0,0,0,.05);
            transition:.3s;
        }

        tr:hover td{transform:scale(1.03);}

        .status-tersedia{color:#16a34a;font-weight:600;}
        .status-tidak{color:#dc2626;font-weight:600;}

        .btn-pesan{
            background:#99f6e4;
            padding:8px 18px;
            border-radius:20px;
            text-decoration:none;
            color:#065f46;
            font-size:14px;
            transition:.3s;
            display:inline-block;
        }

        .btn-pesan:hover{
            background:#2dd4bf;
            color:white;
            transform:translateY(-2px);
        }

        @keyframes fadeLeft{
            from{opacity:0;transform:translateX(-40px)}
            to{opacity:1;transform:translateX(0)}
        }

        @keyframes fadeRight{
            from{opacity:0;transform:translateX(40px)}
            to{opacity:1;transform:translateX(0)}
        }

        @keyframes fadeUp{
            from{opacity:0;transform:translateY(50px)}
            to{opacity:1;transform:translateY(0)}
        }
    </style>
</head>
<body>

<section class="hero">
    <img src="{{ asset('assets/backgroundhotel3.jpg') }}" alt="Hotel">

    <div class="hero-text">
        <h1>Nikmati Pengalaman Menginap Terbaik</h1>
        <p>Temukan kamar dengan kenyamanan premium, harga terbaik, dan pelayanan profesional untuk liburan maupun perjalanan bisnis Anda.</p>

        <div class="stats">
            <div class="stat-box">
                <div class="stat-number" data-target="120">0</div>
                <div class="stat-label">Kamar Tersedia</div>
            </div>
            <div class="stat-box">
                <div class="stat-number" data-target="3500">0</div>
                <div class="stat-label">Tamu Puas</div>
            </div>
            <div class="stat-box">
                <div class="stat-number" data-target="15">0</div>
                <div class="stat-label">Tahun Beroperasi</div>
            </div>
        </div>

        <a href="#daftar">
            <button class="btn-hero"><span>See Details</span></button>
        </a>
    </div>
</section>

<section class="section-table" id="daftar">
<h2>DAFTAR KAMAR HOTEL</h2>

<form method="GET" action="{{ route('welcome') }}">
    <select name="tipe_kamar">
        <option value="">Semua Tipe</option>
        <option value="Standard">Standard</option>
        <option value="Deluxe">Deluxe</option>
        <option value="Suite">Suite</option>
    </select>
    <button type="submit">Filter</button>
</form>

<table>
<tr>
    <th>Nomor Kamar</th>
    <th>Tipe</th>
    <th>Harga / Malam</th>
    <th>Status</th>
    <th>Pesan di Sini</th>
</tr>

@foreach($kamar as $k)
<tr>
    <td>{{ $k->nomor_kamar }}</td>
    <td>{{ $k->tipe_kamar }}</td>
    <td>Rp {{ number_format($k->harga_kamar,0,',','.') }}</td>
    <td>
        @if($k->status_kamar == 'Tersedia')
            <span class="status-tersedia">Tersedia</span>
        @else
            <span class="status-tidak">Tidak Tersedia</span>
        @endif
    </td>
    <td>
        @if($k->status_kamar == 'Tersedia')
            <a href="{{ route('reservasi.create',['id_kamar'=>$k->id_kamar]) }}" class="btn-pesan">Pesan</a>
        @else
            <span style="color:#f87171">Tidak Bisa Dipesan</span>
        @endif
    </td>
</tr>
@endforeach
</table>
</section>

<script>
const counters = document.querySelectorAll('.stat-number');
const speed = 200;

const startCount = (counter) => {
    const target = +counter.getAttribute('data-target');
    let count = 0;
    const increment = target / speed;

    const update = () => {
        count += increment;
        if(count < target){
            counter.innerText = Math.floor(count);
            requestAnimationFrame(update);
        } else {
            counter.innerText = target;
        }
    };
    update();
};

const observer = new IntersectionObserver(entries=>{
    entries.forEach(entry=>{
        if(entry.isIntersecting){
            startCount(entry.target);
            observer.unobserve(entry.target);
        }
    });
},{threshold:0.7});

counters.forEach(counter=>{
    observer.observe(counter);
});
</script>

</body>
</html>
