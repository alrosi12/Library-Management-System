@extends('layout.app')
@push('style')
    <link rel="stylesheet" href="https://cdnjs.com/libraries/bootstrap-modal">
@endpush
@section('content')
    <div class="row">
        <div class="card card-info col-md-8 ml-2">
            <div class="card-header">
                <h3 class="card-title">Book Info</h3>

            </div>

            <div class="card-body">
                <div>
                    <p><b>Book Title :</b> {{ $book->title }} </p>
                    <p><b> Edition :</b> {{ $book->edition }}</p>
                    <p><b> Describtion :</b> {{ $book->description }}</p>
                    <p><b> Language :</b> {{ $book->language }}</p>
                    <p><b> Total Copies :</b> {{ $book->total_copies }}</p>
                </div>
                <div class="float-right">
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                        Borrow this book
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="{{ route('borrowing.store') }}" method="POST">
                                    @csrf
                                    <div class="modal-body">
                                        <label>Select Member</label>
                                        <select name="member_id" class="form-control select2" style="width: 100%;">
                                            <option>Select Member</option>
                                            @foreach ($members as $member)
                                                <option value="{{ $member->id }}">{{ $member->name }}</option>
                                            @endforeach

                                        </select>
                                        <input type="text" name="book_id" value="{{ $book->id }}" hidden>
                                        <div class="form-group">
                                            <label for="disabledTextInput">Borroweda Date</label>
                                            <input type="date" id="borrowed_at" name="borrowed_at">
                                        </div>
                                        <div class="form-group">
                                            <label for="disabledTextInput">Due Date</label>
                                            <input type="date" id="due_date" name="due_date">
                                        </div>

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Save changes</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
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
            <span class="badge bg-warning float-right">{{ $book->borrowings->count() }}</span>


        </div>
        <div class="card-body">
            <div>
                {{-- <span class=""> <b> Count : </b>{{ $book->borrowings->count() }}</span> --}}

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
                        @else
                            <td colspan="4">No Borrowings</td>
                        @endif
                    </tbody>
                </table>

            </div>
        </div>
    </div>
    <div class="card card-secondary">
        <div class="card-header">
            <h3 class="card-title">Reviews </h3>
            <span class="badge bg-warning float-right">{{ $book->reviews->count() }}</span>
        </div>

        <div class="card-body">
            <div>
                {{-- <span class=""> <b> Count : </b></span> --}}

                <table class="table table-bordered table-hover">
                    <header>
                        <th>Member Name</th>
                        <th>Rating</th>
                        <th>Comment</th>
                    </header>
                    <tbody>
                        @if ($book->reviews->count() > 0)
                            @foreach ($book->reviews as $review)
                                <tr data-widget="expandable-table" aria-expanded="false">
                                    <td>{{ $review->member->name }}</td>
                                    <td>{{ $review->rating }}/5</td>
                                    <td>{{ $review->comment }}</td>
                                </tr>
                            @endforeach
                        @else
                            <td colspan="3">No Reviews</td>
                        @endif
                    </tbody>
                </table>

            </div>
        </div>
    </div>

@endsection
