<?php

namespace App\Http\Controllers;

use App\Models\Fine;
use Illuminate\Http\Request;

class FineController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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

    public function pay(Request $request)
    {
        $fine = Fine::where('book_loan_id', $request->book_loan_id)
                    ->where('status', 'awaiting_verif')
                    ->firstOrFail();
    
        if ($fine->bookLoan->user_id != auth()->id()) {
            return back()->with('error', 'You do not have permission to pay this fine.');
        }
    
        $fine->status = 'verified';
        $fine->save();
    
        return redirect()->route('member.loans.history')->with('success', 'Fine paid successfully.');
    }
    
    

    /**
     * Display the specified resource.
     */
    public function show(Fine $fine)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Fine $fine)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Fine $fine)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Fine $fine)
    {
        //
    }
}
