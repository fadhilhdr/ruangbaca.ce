<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Fine;
use Illuminate\Http\Request;

class FinesBookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $denda = Fine::orderBy('created_at', 'desc')->get();
        return view('admin.denda.index', compact('denda'));
    }

    public function updateStatus($id)
    {
        // Ambil data Fine berdasarkan ID
        $fine = Fine::findOrFail($id);

        // Periksa apakah status sudah diverifikasi atau belum
        if ($fine->status === 'awaiting_verif') {
            $fine->status = 'verified';
            $fine->verified_at = now(); // Set waktu verifikasi
        } else {
            $fine->status = 'awaiting_verif';
            $fine->verified_at = null; // Reset waktu verifikasi
        }

        // Simpan perubahan
        $fine->save();

        // Redirect kembali ke halaman yang menampilkan daftar denda
        return redirect()->route('admin.fines.index')->with('status', 'Status denda berhasil diperbarui!');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}