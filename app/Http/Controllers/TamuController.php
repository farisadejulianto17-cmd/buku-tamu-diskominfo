<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tamu;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class TamuController extends Controller
{
    /**
     * DASHBOARD: Menampilkan Statistik
     */
    public function index()
    {
        $stats = [
            'hari_ini'  => Tamu::whereDate('created_at', Carbon::today())->count(),
            'bulan_ini' => Tamu::whereMonth('created_at', Carbon::now()->month)->count(),
            'tahun_ini' => Tamu::whereYear('created_at', Carbon::now()->year)->count(),
            'total'     => Tamu::count(),
        ];

        // Data Grafik (7 Hari Terakhir)
        $grafik = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = now()->subDays($i)->format('Y-m-d');
            $label = now()->subDays($i)->translatedFormat('d M');
            $count = Tamu::whereDate('created_at', $date)->count();
            
            $grafik['labels'][] = $label;
            $grafik['data'][] = $count;
        }
    
        return view('admin.dashboard', compact('stats', 'grafik'));
    }

    /**
     * DATA TAMU: Daftar tamu hari ini dengan fitur Pencarian
     */
    public function dataTamu(Request $request)
    {
        $query = Tamu::query();

        // Logika Pencarian
        if ($request->has('search') && $request->search != '') {
            $search = $request->get('search');
            $query->where(function($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                  ->orWhere('instansi', 'like', "%{$search}%")
                  ->orWhere('no_hp', 'like', "%{$search}%");
            });
        }

        // Ambil data tamu hari ini saja, urutkan yang terbaru
        $tamus = $query->whereDate('created_at', today())
                       ->latest()
                       ->get();

        return view('admin.data-tamu', compact('tamus'));
    }

    public function edit($id)
    {
        $tamu = Tamu::where('unique_id', $id)->firstOrFail();
        return view('admin.edit-tamu', compact('tamu'));
    }

    public function update(Request $request, $id)
    {
        $tamu = Tamu::where('unique_id', $id)->firstOrFail();
        
        $request->validate([
            'nama' => 'required|max:25',
            'no_hp' => 'required|max:15',
            'instansi' => 'required|max:50',
            'kebutuhan' => 'required|max:100',
        ]);

        $tamu->update($request->all());

        return redirect()->route('admin.data-tamu')->with('success', 'Data tamu berhasil diperbarui.');
    }

    public function rekap(Request $request)
    {
        $query = Tamu::query();

        if ($request->has('start_date') && $request->has('end_date')) {
            $query->whereBetween('created_at', [
                $request->start_date . ' 00:00:00', 
                $request->end_date . ' 23:59:59'
            ]);
        }

        $tamus = $query->orderBy('created_at', 'desc')->get();
        return view('admin.rekap', compact('tamus'));
    }

    public function verifikasi($id)
    {
        $tamu = Tamu::where('unique_id', $id)->firstOrFail();
        
        if ($tamu->waktu_keluar) {
            return redirect()->route('admin.data-tamu')
                             ->with('info', 'Tamu ini sudah melakukan checkout sebelumnya.');
        }

        return view('admin.verifikasi-scan', compact('tamu'));
    }

    public function konfirmasiKeluar(Request $request, $id)
    {
        $tamu = Tamu::where('unique_id', $id)->firstOrFail();
        
        $tamu->update([
            'waktu_keluar' => now()
        ]);

        return redirect()->route('admin.data-tamu')
                         ->with('success', 'Kunjungan ' . $tamu->nama . ' berhasil dikonfirmasi selesai.');
    }

    // --- BAGIAN TAMU / PENGUNJUNG ---

    public function create()
    {
        return view('form-tamu'); 
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|max:25',
            'no_hp' => 'required|max:15',
            'instansi' => 'required|max:50',
            'kebutuhan' => 'required|max:100',
        ]);

        $tamu = Tamu::create([
            'nama' => $request->nama,
            'no_hp' => $request->no_hp,
            'instansi' => $request->instansi,
            'kebutuhan' => $request->kebutuhan,
            'waktu_kedatangan' => now(),
        ]);

        return redirect()->route('tamu.status', $tamu->unique_id)
                         ->with('success', 'Check-in Berhasil!');
    }

    public function status($id)
    {
        $tamu = Tamu::where('unique_id', $id)->firstOrFail();
        
        if ($tamu->waktu_keluar) {
            return redirect()->route('home')->with('info', 'Kunjungan Anda sudah selesai.');
        }

        return view('status-tamu', compact('tamu'));
    }

    public function checkout($id)
    {
        $tamu = Tamu::where('unique_id', $id)->firstOrFail();
        
        if ($tamu->waktu_keluar) {
            return redirect()->route('home');
        }

        $tamu->update([
            'waktu_keluar' => now() 
        ]);

        return redirect()->route('home')->with('success', 'Terima kasih, kunjungan Anda di Diskominfo telah selesai.');
    }

    public function manualCheckout($id)
    {
        $tamu = Tamu::where('unique_id', $id)->firstOrFail();
        
        $tamu->update([
            'waktu_keluar' => now()
        ]);

        return redirect()->back()->with('success', 'Tamu ' . $tamu->nama . ' berhasil di-checkout secara manual.');
    }

    public function destroy($id)
    {
        $tamu = Tamu::where('unique_id', $id)->firstOrFail();
        $tamu->delete();
        return redirect()->back()->with('success', 'Data tamu berhasil dihapus.');
    }
}