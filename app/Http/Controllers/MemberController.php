<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    public function index()
    {
        // Paginated table with name, email, status badge (active/inactive)
        // , and active borrows count.
        $members = Member::with('borrowings')->paginate(6);
        $activeBorrowings = Member::all()->where('is_active', '1');
        return view('members.index', compact('members', 'activeBorrowings'));
    }
    public function show($id)
    {
        $member = Member::with('borrowings', 'reviews')->findOrFail($id);
        return view('members.show', compact('member'));
    }
}
