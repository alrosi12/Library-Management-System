@extends('layout.app')

@section('content')
    <div class="row">
        <div class="col-md-4">
            <!-- About Me Box -->
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">About Me</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <strong><i class="fas fa-book mr-1"></i>Name</strong>

                    <p class="text-muted">
                        {{ $member->name }}
                    </p>

                    <hr>

                    <strong><i class="fas fa-map-marker-alt mr-1"></i> Email</strong>

                    <p class="text-muted">
                        {{ $member->email }}
                    </p>

                    <hr>

                    <strong><i class="fas fa-pencil-alt mr-1"></i> Phone</strong>

                    <p class="text-muted">
                        {{ $member->phone }}
                    </p>

                    <hr>

                    <strong><i class="far fa-file-alt mr-1"></i>Age</strong>

                    <p class="text-muted">
                        {{ $member->membership_duration }}

                    </p>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Borrowing History</h3>
                <span class="badge bg-warning float-right">{{ $member->borrowings->count() }}</span>
            </div>
            <div class="card-body">
                <div>
                    <table class="table table-bordered table-hover">
                        <header>
                            <th>Borrowed At</th>
                            <th>Due Date</th>
                            <th>Book title</th>
                            <th>Status</th>
                            <th>Action</th>
                        </header>
                        <tbody>
                            @if ($member->borrowings->count() > 0)
                                @foreach ($member->borrowings as $borrowing)
                                    <tr data-widget="expandable-table" aria-expanded="false">
                                        <td>{{ $borrowing->borrowed_at }}</td>
                                        <td>{{ $borrowing->due_date }}</td>
                                        <td>{{ $borrowing->book->title }}</td>
                                        <td>{{ $borrowing->status }}</td>
                                        <td>
                                            <form action="{{ route('borrowing.update', $borrowing->id) }}" method="PUT">
                                                @csrf

                                                <button type="submit">Return</button>
                                            </form>

                                        </td>
                                @endforeach
                                </tr>
                            @else
                                <td colspan="4">No Borrowings</td>
                            @endif
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
        <div class="card card-secondary col-md-6 ml-2">
            <div class="card-header">
                <h3 class="card-title">Reviews </h3>
                <span class="badge bg-warning float-right">{{ $member->reviews->count() }}</span>
            </div>

            <div class="card-body">
                <div>
                    {{-- <span class=""> <b> Count : </b></span> --}}

                    <table class="table table-bordered table-hover">
                        <header>
                            <th>Rating</th> 
                            <th>Comment</th>
                        </header>
                        <tbody>
                            @if ($member->reviews->count() > 0)
                                @foreach ($member->reviews as $review)
                                    <tr data-widget="expandable-table" aria-expanded="false">
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
    </div>
@endsection
