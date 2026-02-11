<?php

namespace App\Http\Controllers;

use App\Models\Reservasi;
use App\Models\DataKamar;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ReservasiController extends Controller
{
    public function index(Request $request)
{
    $query = Reservasi::with('kamar');

    if ($request->search) {
        $query->where('id_reservasi', 'like', '%' . $request->search . '%')
              ->orWhere('nama_tamu', 'like', '%' . $request->search . '%');
    }

    $reservasi = $query->get();

    return view('admin.reservasi', compact('reservasi'));
}

   public function create(Request $request)
{
    $kamar = DataKamar::where('id_kamar', $request->id_kamar)->firstOrFail();
    return view('reservasi', compact('kamar'));
}


    public function store(Request $request)
    {
        $request->validate([
            'id_kamar' => 'required',
            'nama_tamu' => 'required',
            'no_hp' => 'required|regex:/^[0-9]+$/|digits_between:10,15',
            'check_in' => 'required|date',
            'check_out' => 'required|date|after:check_in',
            'jumlah_tamu' => 'required|integer|min:1'
        ]);

        $kamar = DataKamar::findOrFail($request->id_kamar);

        if ($kamar->status_kamar == 'Tidak Tersedia') {
            return back()->with('error','Kamar tidak tersedia');
        }

        $lama = (strtotime($request->check_out) - strtotime($request->check_in)) / 86400;
        $total = $lama * $kamar->harga_kamar;

        Reservasi::create([
            'id_reservasi' => Str::uuid(),
            'id_kamar' => $request->id_kamar,
            'nama_tamu' => $request->nama_tamu,
            'no_hp' => $request->no_hp,
            'check_in' => $request->check_in,
            'check_out' => $request->check_out,
            'jumlah_tamu' => $request->jumlah_tamu,
            'total_bayar' => $total,
            'status_reservasi' => 'Booking'
        ]);

        $kamar->update([
            'status_kamar' => 'Tidak Tersedia'
        ]);

        return redirect()->route('welcome')
            ->with('success', 'Reservasi berhasil dibuat');
    }

    public function updateStatus(Request $request, $id)
    {
        $reservasi = Reservasi::findOrFail($id);
        $status = $request->status;

        if ($reservasi->status_reservasi == 'Booking') {

            if ($status == 'Check-in') {
                $reservasi->update(['status_reservasi' => 'Check-in']);
            }

            elseif ($status == 'Batal') {
                $reservasi->update(['status_reservasi' => 'Batal']);
                DataKamar::where('id_kamar', $reservasi->id_kamar)
                    ->update(['status_kamar' => 'Tersedia']);
            }

        } elseif ($reservasi->status_reservasi == 'Check-in' && $status == 'Selesai') {

            $reservasi->update(['status_reservasi' => 'Selesai']);

            DataKamar::where('id_kamar', $reservasi->id_kamar)
                ->update(['status_kamar' => 'Tersedia']);
        }

        return redirect()->back()->with('success','Status berhasil diubah');
    }
}
