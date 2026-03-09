<?php

namespace App\Http\Controllers;

use App\Models\Borrowing;
use Illuminate\Http\Request;

class BorrowingController extends Controller
{
    public function store(Request $request)
    {
        $request =  $request->validate([
            'member_id' => 'required|string|exists:members,id',
            'book_id' => 'required|string|exists:books,id',
            'borrowed_at' => 'required|date',
            'due_date' => 'required|date'
        ]);

        $create =  Borrowing::create($request);
        // dd($create);
        return redirect()->back();
    }

    public function update(Request $request, $id) 
    {
        
    }
}
