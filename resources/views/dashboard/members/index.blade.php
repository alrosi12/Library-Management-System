@extends('layouts.app')

@section('title', 'Members')

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">
        Members</li>
@endsection

@section('content')

    <div class="mb-5">
        <a href="{{ route('members.create') }}" class="btn btn-sm btn-outline-primary mr-2">Create</a>
    </div>

    {{-- <x-alert type="success" />
    <x-alert type="info" /> --}}

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-2"></i>
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fas fa-exclamation-circle me-2"></i>
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif


    <form action="{{ URL::current() }}" method="get">
        <div class="row mb-3">
            <div class="col-sm-12 col-md-6">
                <input type="text" name="name" value="{{ request('name') }}" class="form-control"
                    placeholder="Search by Name">
            </div>
            <div class="col-sm-12 col-md-5">
                <select name="is_active" class="form-control">
                    <option value="">All Statuses</option>
                    {{-- $member->is_active == 0 --}}
                    <option value="1" {{ request('is_active') == '1' ? 'selected' : '' }}>
                        Active
                    </option>

                    <option value="0" {{ request('is_active') == '0' ? 'selected' : '' }}>
                        inActive
                    </option>

                </select>
            </div>
            <button type="submit" class="btn btn-primary  md-2">Filter</button>
        </div>
    </form>

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($members as $member)
                <tr>
                    <td>{{ $member->name }}</td>
                    <td>{{ $member->email }}</td>
                    <td>
                        @if ($member->is_active == 1)
                            <span class="badge bg-success"> Active</span>
                        @else
                            <span class="badge bg-danger"> inActive</span>
                        @endif

                    </td>
                    <td>
                        <a href="{{ route('members.show', $member->id) }}" class="btn btn-sm btn-info" title="View Details">
                            <i class="fas fa-eye"></i> View
                        </a>

                        <form action="{{ route('members.destroy', $member->id) }}" method="POST"
                            style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">
                                <i class="fa fa-trash"></i> Delete
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $members->links() }}
    <p> Total Records: {{ $members->total() }}</p>
    {{-- withQueryString()->->appends(['search' => 1]) --}}
@endsection
