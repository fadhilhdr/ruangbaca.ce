<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;

class BookLoanController extends Controller
{
    public function showTransaction()
    {

    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Transaction::with(['bookLoan.book', 'bookLoan.user', 'type'])->orderBy("created_at", "desc");

        if ($request->has('search') && ! empty($request->search)) {
            $search = $request->search;

            $query->whereHas('bookLoan.user', function ($q) use ($search) {
                $q->where('userid', $search)              // Mencari berdasarkan user_id
                    ->orWhere('name', 'like', "%{$search}%"); // Mencari berdasarkan nama
            });
        }

        $transactions = $query->get();

        return view('admin.transaksi.index', compact('transactions'));
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
