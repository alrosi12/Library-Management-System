@extends('layouts.app')

@section('name', 'Member Profile')

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item"><a href="{{ route('members.index') }}">Members</a></li>
    <li class="breadcrumb-item active">{{ $member->name }}</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <!-- Member Information Card -->
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-member"></i> Member Information
                    </h3>
                    <div class="card-tools">
                        <a href="{{ route('members.index') }}" class="btn btn-sm btn-secondary">
                            <i class="fas fa-arrow-left"></i> Back to List
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <table class="table table-bordered">
                                <tr>
                                    <th width="30%">Title:</th>
                                    <td>{{ $member->name }}</td>
                                </tr>

                                <tr>
                                    <th>IsActive :</th>
                                    {{-- <td>{{ $member->is_active }}</td> --}}
                                    @if ($member->is_active == 1)
                                        <td>
                                            <span class="badge badge-success">
                                                Active
                                            </span>
                                        </td>
                                    @else
                                        <td class="">
                                            <span class="badge badge-danger">
                                                inActive
                                            </span>
                                        </td>
                                    @endif
                                </tr>
                            </table>
                        </div>

                    </div>
                </div>
            </div>



            <!-- Borrowing History Card -->
            <div class="card card-danger card-outline mt-3">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-history"></i> Borrowing History
                        <span class="badge badge-danger">{{ $member->borrowings->count() }}</span>
                    </h3>
                </div>
                <div class="card-body">
                    {{-- @if ($member->borrowings->count() > 0) --}}
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Book</th>
                                    <th>Borrowed at</th>
                                    <th>Due Date</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    @foreach ($member->borrowings as $borrowings)
                                        <td>
                                            {{ $borrowings->book->title }}
                                        </td>
                                        <td>
                                            {{ $borrowings->borrowed_at }}
                                        </td>
                                        <td>
                                            {{ $borrowings->due_date }}
                                        </td>
                                        <td>
                                            {{ $borrowings->status }}
                                        </td>
                                    @endforeach

                                </tr>
                            </tbody>
                        </table>
                    </div>
                    {{-- @else
                        <p class="text-muted">No borrowing history available for this member</p>
                    @endif --}}
                </div>
            </div>

        </div>
    </div>
@endsection
