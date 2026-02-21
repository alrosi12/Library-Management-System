<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Member;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

    // dd(true == 0);
        $request = request();
        $members = Member::filter($request->query())->paginate(5);

        return view('dashboard.members.index', compact('members'));
    }

    /**
     * Show the form for creating a new resource.
     */
   
    public function show($id)
    {
    
        // Member profile with borrowing history and reviews they wrote.
        
        $member = Member::with('borrowings', 'reviews')->findOrFail($id) ;
        // ->where('borrowings') ;
        // select 
        return view('dashboard.members.show', compact('member'));
        
    }

    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Member $member)
    {
        
        $member->delete();
        return redirect()->route('members.index');
    }
}
