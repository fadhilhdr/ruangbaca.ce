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
    public function index(Request $request)
    {
        $query = Fine::with(['transaction.bookLoan.user', 'transaction.type'])->orderBy('created_at', 'desc');

        if ($request->has('search') && ! empty($request->search)) {
            $search = $request->search;

            $query->whereHas('transaction.bookLoan.user', function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%");
            });
        }

        $denda = $query->get();

        return view('admin.denda.index', compact('denda'));
    }

    public function updateStatus(Request $request, $id)
    {
        $fine = Fine::findOrFail($id);

        // Validasi status yang diperbolehkan
        $request->validate([
            'status' => 'required|in:awaiting_verif,verified,decline',
        ]);

        $fine->status = $request->status;

        if ($request->status === 'verified') {
            $fine->verified_at = now();
        } else {
            $fine->verified_at = null;
        }

        $fine->save();

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
