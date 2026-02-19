<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Book;
use App\Models\Borrowing;
use App\Models\Member;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_books'     => Book::count(),
            'total_members'   => Member::count(),
            'active_borrows'  => Borrowing::where('status', 'borrowed')->count(),
            'overdue_borrows' => Borrowing::where('status', 'overdue')->count(),
        ];

        // جلب آخر 5 عمليات استعارة مع بيانات الكتاب والعضو (Eager Loading)
        $recentBorrowings = Borrowing::with(['book', 'member'])
            ->latest('borrowed_at')
            ->take(5)
            ->get();

        return view('dashboard.dashboard', compact('stats', 'recentBorrowings'));
    }
}
