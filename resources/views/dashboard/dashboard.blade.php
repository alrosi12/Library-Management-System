@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">System Overview</h1>
    </div>

    {{-- Summary Cards --}}
    <div class="row">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2 bg-primary text-white">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-uppercase mb-1">Total Books</div>
                            <div class="h5 mb-0 font-weight-bold">{{ $stats['total_books'] }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-book fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2 bg-success text-white">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-uppercase mb-1">Total Members</div>
                            <div class="h5 mb-0 font-weight-bold">{{ $stats['total_members'] }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2 bg-info text-white">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-uppercase mb-1">Active Borrowings</div>
                            <div class="h5 mb-0 font-weight-bold">{{ $stats['active_borrows'] }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-hand-holding fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-danger shadow h-100 py-2 bg-danger text-white">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-uppercase mb-1">Overdue Borrowings</div>
                            <div class="h5 mb-0 font-weight-bold">{{ $stats['overdue_borrows'] }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clock fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Recent Borrowings Table --}}
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">5 Most Recently Borrowed Books</h6>
            <span class="badge bg-primary">{{ $recentBorrowings->count() }} Records</span>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover" width="100%" cellspacing="0">
                    <thead class="table-light">
                        <tr>
                            <th>Book Title</th>
                            <th>Member Name</th>
                            <th>Borrowed Date</th>
                            <th>Due Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($recentBorrowings as $borrow)
                        <tr>
                            <td><strong>{{ $borrow->book->title }}</strong></td>
                            <td>{{ $borrow->member->name }}</td>
                            <td>{{ \Carbon\Carbon::parse($borrow->borrowed_at)->format('M d, Y') }}</td>
                            <td>
                                <span class="{{ $borrow->status == 'overdue' ? 'text-danger fw-bold' : '' }}">
                                    {{ \Carbon\Carbon::parse($borrow->due_date)->format('M d, Y') }}
                                </span>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center">No recent borrowings found.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection