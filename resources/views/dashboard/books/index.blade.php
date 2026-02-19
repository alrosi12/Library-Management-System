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

                        <form action="{{ route('books.destroy', $book->id) }}" method="POST" style="display:inline-block;">
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

    {{ $books->links() }}
    <p> Total Records: {{ $books->total() }}</p>
    {{-- withQueryString()->->appends(['search' => 1]) --}}
@endsection
