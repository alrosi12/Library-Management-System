@extends('layout.app')

@section('content')
    <div class="row">
        <div class="card card-info col-md-8 ml-2">
            <div class="card-header">
                <h3 class="card-title">Book Info</h3>
            </div>
            <div class="card-body">
                <div>
                    <p><b>Book Title :</b> {{ $book->title }} </p>
                    <p><b>Page Edition :</b> {{ $book->edition }}</p>
                    <p><b>Page Describtion :</b> {{ $book->description }}</p>
                    <p><b>Page Language :</b> {{ $book->language }}</p>
                    <p><b>Page Total Copies :</b> {{ $book->total_copies }}</p>
                </div>
            </div>

        </div>

        <div class="card card-info col-md-3 ml-4">
            <div class="card-header">
                <h3 class="card-title">Author Info</h3>
            </div>
            <div class="card-body">
                <div>
                    <p><b>Author Name :</b> {{ $book->author->name }} </p>
                    <p><b>Bio :</b> {{ $book->author->bio }}</p>
                    <p><b>Nationality :</b> {{ $book->author->nationality }}</p>
                </div>
            </div>
        </div>

    </div>
    <div class="card card-primary  ">
        <div class="card-header">
            <h3 class="card-title">Borrowing History</h3>

        </div>
        <div class="card-body">
            <div>
                <span class=""> <b> Count : </b>{{ $book->borrowings->count() }}</span>

                <table class="table table-bordered table-hover">
                    <header>
                        <th>Member Name</th>
                        <th>Borrowed At</th>
                        <th>Due Date</th>
                        <th>Status</th>
                    </header>
                    <tbody>
                        @if ($book->borrowings->count() > 0)
                            @foreach ($book->borrowings as $borrowing)
                                <tr data-widget="expandable-table" aria-expanded="false">
                                    <td>{{ $borrowing->member->name }}</td>
                                    <td>{{ $borrowing->borrowed_at }}</td>
                                    <td>{{ $borrowing->due_date }}</td>
                                    <td>{{ $borrowing->status }}</td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>

            </div>
        </div>
    </div>
    <div class="card card-secondary">
        <div class="card-header">
            <h3 class="card-title">Reviews </h3>
        </div>
        <div class="card-body">
            <div>
               
            </div>
        </div>
    </div>
@endsection
