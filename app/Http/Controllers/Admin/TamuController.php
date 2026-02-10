<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tamu;
use Illuminate\Http\Request;

class TamuController extends Controller
{
    public function index()
    {
        $tamus = Tamu::latest()->get(); // Mengambil semua data tamu
        return view('admin.dashboard', compact('tamus'));
    }

    public function destroy($id)
    {
        Tamu::findOrFail($id)->delete();
        return back()->with('success', 'Data tamu berhasil dihapus!');
    }
}