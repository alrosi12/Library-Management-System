<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Borrowing;
use App\Models\Member;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $books = Book::all();
        $members = Member::all();
        $borrowings = Borrowing::orderBy('created_at', 'desc')->paginate(5);
        $borroweds  = Borrowing::all()->where('status', 'borrowed');
        $overdue  = Borrowing::all()->where('status', 'overdue');
        return view('dashboard', compact([
            'books',
            'members',
            'borroweds',
            'overdue',
            'borrowings'
        ]));
    }
}
