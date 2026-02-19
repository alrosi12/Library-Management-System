@extends('layouts.app')

@section('title', 'Books')

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Books</li>
@endsection

@section('content')

    <div class="mb-5">
        <a href="{{ route('books.create') }}" class="btn btn-sm btn-outline-primary mr-2">Create</a>
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
                <input type="text" name="title" value="{{ request('title') }}" class="form-control"
                    placeholder="Search by title">
            </div>
            <div class="col-sm-12 col-md-5">
                <select name="status" class="form-control">
                    <option value="">All Statuses</option>

                    <option value="available" {{ request('status') == 'available' ? 'selected' : '' }}>
                        Available
                    </option>

                    <option value="borrowed" {{ request('status') == 'borrowed' ? 'selected' : '' }}>
                        Borrowed
                    </option>

                    <option value="reserved" {{ request('status') == 'reserved' ? 'selected' : '' }}>
                        Reserved
                    </option>

                    <option value="archived" {{ request('status') == 'archived' ? 'selected' : '' }}>
                        Archived
                    </option>
                </select>
                
                </select>
            </div>
            <button type="submit" class="btn btn-primary  md-2">Filter</button>
        </div>
    </form>

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Title</th>
                <th>Author</th>
                <th>Status</th>
                <th>Available Copies</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($books as $book)
                <tr>
                    <td>{{ $book->title }}</td>
                    <td>{{ $book->author->name ?? '-' }}</td>
                    <td>{{ $book->status }}</td>
                    <td>{{ $book->total_copies }}</td>
                    <td>
                        <a href="{{ route('books.show', $book->id) }}" class="btn btn-sm btn-info" title="View Details">
                            <i class="fas fa-eye"></i> View
                        </a>
                        <a href="{{ route('books.edit', $book->id) }}" class="btn btn-sm btn-info text-white">
                            <i class="fa fa-edit"></i> Edit
                        </a>

                        <form action="{{ route('books.destroy', $book->id) }}" method="POST"
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

    {{ $books->withQueryString()->links() }}
    <p> Total Records: {{ $books->total() }}</p>
    {{-- withQueryString()->->appends(['search' => 1]) --}}
@endsection
