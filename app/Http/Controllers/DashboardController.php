<?php

namespace App\Http\Controllers;

use App\Models\Tamu; // Pastikan Anda sudah punya Model Tamu
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Menampilkan halaman dashboard admin dengan data tamu.
     */
    public function index()
    {
        // Mengambil semua data dari tabel 'tamus' urut dari yang terbaru
        $tamus = Tamu::latest()->get();

        // Mengirim data tamu ke view 'dashboard'
        return view('dashboard', compact('tamus'));
    }

    /**
     * Menghapus data tamu tertentu.
     */
    public function destroy($id)
    {
        $tamu = Tamu::findOrFail($id);
        $tamu->delete();

        return redirect()->route('dashboard')->with('success', 'Data tamu berhasil dihapus.');
    }
}