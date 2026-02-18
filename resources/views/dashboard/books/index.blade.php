@extends('layouts.dashboard')

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
                    <td>{{ $book->quantity }}</td>
                    <td>

                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{-- {{ $books->withQueryString()->appends(['search' => 1])->links() }} --}}

@endsection
