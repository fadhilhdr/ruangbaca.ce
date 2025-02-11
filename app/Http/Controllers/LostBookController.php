<?php
namespace App\Http\Controllers;

use App\Models\LostBook;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class LostBookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = LostBook::query()
            ->with(['bookLoan.user', 'bookLoan.book']);

        if ($request->has('search')) {
            $query->whereHas('bookLoan.user', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%');
            });
        }

        $lostBooks = $query->latest('date_reported')->get();

        return view('admin.lost_book.index', compact('lostBooks'));
    }
    public function updateStatus(Request $request, LostBook $lostBook)
    {
        $request->validate([
            'replacement_status' => 'required|in:awaiting_verif,verified,decline',
        ]);

        $lostBook->update([
            'replacement_status' => $request->replacement_status,
        ]);
        Alert::success('success', 'status berhasil dirubah!');
        return redirect()->route('admin.lost-books.index'); // Redirect back for better UX
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
    public function show(LostBook $lostBook)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(LostBook $lostBook)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, LostBook $lostBook)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(LostBook $lostBook)
    {
        //
    }
}
