<?php

namespace App\Http\Controllers;

use App\Models\DataKamar;
use Illuminate\Http\Request;

class DataKamarController extends Controller
{
    public function index()
    {
        $kamar = DataKamar::latest()->get();
        return view('admin.dashboard', compact('kamar'));
    }

    public function search(Request $request)
    {
        $query = DataKamar::query();

        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('nomor_kamar', 'like', '%' . $request->search . '%')
                  ->orWhere('tipe_kamar', 'like', '%' . $request->search . '%');
            });
        }

        $kamar = $query->get();

        return view('admin.dashboard', compact('kamar'));
    }

    public function create()
    {
        return view('admin.create');
    }

   public function store(Request $request)
{
    $request->validate([
        'id_kamar' => 'required|unique:data_kamar,id_kamar',
        'nomor_kamar' => 'required|unique:data_kamar,nomor_kamar',
        'tipe_kamar' => 'required',
        'harga_kamar' => 'required|numeric|min:0',
        'status_kamar' => 'required'
    ]);

    DataKamar::create([
        'id_kamar' => $request->id_kamar,
        'nomor_kamar' => $request->nomor_kamar,
        'tipe_kamar' => $request->tipe_kamar,
        'harga_kamar' => $request->harga_kamar,
        'status_kamar' => $request->status_kamar
    ]);

    return redirect()->route('admin.dashboard')
        ->with('success', 'Kamar berhasil ditambahkan');
}

    public function edit($id)
    {
        $kamar = DataKamar::findOrFail($id);
        return view('admin.edit', compact('kamar'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nomor_kamar' => 'required|unique:data_kamar,nomor_kamar,' . $id . ',id_kamar',
            'tipe_kamar' => 'required',
            'harga_kamar' => 'required|numeric|min:0',
            'status_kamar' => 'required'
        ]);

        $kamar = DataKamar::findOrFail($id);

        $kamar->update([
            'nomor_kamar' => $request->nomor_kamar,
            'tipe_kamar' => $request->tipe_kamar,
            'harga_kamar' => $request->harga_kamar,
            'status_kamar' => $request->status_kamar
        ]);

        return redirect()->route('admin.dashboard')->with('success', 'Kamar berhasil diupdate');
    }

  public function destroy($id)
{
    $kamar = DataKamar::with('reservasi')->findOrFail($id);

    $aktif = $kamar->reservasi()
        ->whereIn('status_reservasi', ['Booking', 'Check-in'])
        ->exists();

    if ($aktif) {
        return redirect()->route('admin.dashboard')
            ->with('error', 'Kamar tidak bisa dihapus karena masih dalam status Booking atau Check-in');
    }

    $kamar->delete();

    return redirect()->route('admin.dashboard')
        ->with('success', 'Kamar berhasil dihapus');
}

}
