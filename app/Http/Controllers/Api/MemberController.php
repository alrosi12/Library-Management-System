<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\MemberResource;
use App\Models\Member;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return MemberResource::collection(Member::paginate(1));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        // 'name'            => 'required|string|max:255',
        // 'eamil'           => 'requierd|string|max:255|unique:members,email',
        // 'phone'           => 'nullable|int|max:12',
        // 'membership_date' => 'nullable|date',
        // 'is_active'       => 'boolean|in:true,false',
    }

    /**
     * Display the specified resource.
     */
    public function show(Member $member)
    {
        return new MemberResource($member);
        
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
