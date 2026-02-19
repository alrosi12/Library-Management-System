@extends('layouts.app')

@section('title', 'Book Details')

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item"><a href="{{ route('books.index') }}">Books</a></li>
    <li class="breadcrumb-item active">{{ $book->title }}</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <!-- Book Information Card -->
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-book"></i> Book Information
                    </h3>
                    <div class="card-tools">
                        <a href="{{ route('books.index') }}" class="btn btn-sm btn-secondary">
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
                                    <td>{{ $book->title ?? 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <th>ISBN:</th>
                                    <td>{{ $book->isbn ?? 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <th>Description:</th>
                                    <td>{{ $book->description ?? 'No description available' }}</td>
                                </tr>
                                <tr>
                                    <th>Publisher Date:</th>
                                    <td>{{ $book->publisher_date  }}</td>
                                </tr>
                                <tr>
                                    <th>Page Count:</th>
                                    <td>{{ $book->page_count ?? 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <th>Language:</th>
                                    <td>{{ strtoupper($book->language ?? 'N/A') }}</td>
                                </tr>
                                <tr>
                                    <th>Edition:</th>
                                    <td>{{ $book->edition ?? '1' }}</td>
                                </tr>
                                <tr>
                                    <th>Total Copies:</th>
                                    <td>{{ $book->total_copies ?? '0' }}</td>
                                </tr>
                                <tr>
                                    <th>Status:</th>
                                    <td>
                                        @php
                                            $statusColors = [
                                                'available' => 'success',
                                                'borrowed' => 'warning',
                                                'reserved' => 'info',
                                                'archived' => 'secondary'
                                            ];
                                            $color = $statusColors[$book->status] ?? 'secondary';
                                        @endphp
                                        <span class="badge badge-{{ $color }}">{{ ucfirst($book->status) }}</span>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <!-- Author Information -->
                            <div class="card card-info">
                                <div class="card-header">
                                    <h3 class="card-title"><i class="fas fa-user"></i> Author Information</h3>
                                </div>
                                <div class="card-body">
                                    @if($book->author)
                                        <p><strong>Name:</strong> {{ $book->author->name }}</p>
                                        <p><strong>Bio:</strong> {{ $book->author->bio ?? 'No biography available' }}</p>
                                        <p><strong>Birth Date:</strong> {{ $book->author->birth_date ? $book->author->birth_date->format('Y-m-d') : 'N/A' }}</p>
                                        <p><strong>Nationality:</strong> {{ $book->author->nationality ?? 'N/A' }}</p>
                                    @else
                                        <p class="text-muted">No author information available</p>
                                    @endif
                                </div>
                            </div>

                            <!-- Publisher Information -->
                            @if($book->publisher)
                            <div class="card card-success mt-3">
                                <div class="card-header">
                                    <h3 class="card-title"><i class="fas fa-building"></i> Publisher Information</h3>
                                </div>
                                <div class="card-body">
                                    <p><strong>Name:</strong> {{ $book->publisher->name ?? 'N/A' }}</p>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Categories Card -->
            <div class="card card-warning card-outline mt-3">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-tags"></i> Categories
                    </h3>
                </div>
                <div class="card-body">
                    @if($book->categories->count() > 0)
                        <div class="d-flex flex-wrap">
                            @foreach($book->categories as $category)
                                <span class="badge badge-warning badge-lg mr-2 mb-2 p-2">
                                    {{ $category->name }}
                                </span>
                            @endforeach
                        </div>
                    @else
                        <p class="text-muted">No categories assigned to this book</p>
                    @endif
                </div>
            </div>

            <!-- Borrowing History Card -->
            <div class="card card-danger card-outline mt-3">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-history"></i> Borrowing History
                        <span class="badge badge-danger">{{ $book->borrowings->count() }}</span>
                    </h3>
                </div>
                <div class="card-body">
                    @if($book->borrowings->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Member</th>
                                        <th>Borrowed Date</th>
                                        <th>Due Date</th>
                                        <th>Returned Date</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($book->borrowings as $borrowing)
                                        <tr>
                                            <td>{{ $borrowing->member->name ?? 'N/A' }}</td>
                                            <td>{{ $borrowing->borrowed_at ? $borrowing->borrowed_at->format('Y-m-d H:i') : 'N/A' }}</td>
                                            <td>{{ $borrowing->due_date ? $borrowing->due_date->format('Y-m-d') : 'N/A' }}</td>
                                            <td>
                                                @if($borrowing->returned_at)
                                                    {{ $borrowing->returned_at->format('Y-m-d H:i') }}
                                                @else
                                                    <span class="text-danger">Not Returned</span>
                                                @endif
                                            </td>
                                            <td>
                                                @php
                                                    $statusColors = [
                                                        'borrowed' => 'warning',
                                                        'returned' => 'success',
                                                        'overdue' => 'danger'
                                                    ];
                                                    $color = $statusColors[$borrowing->status] ?? 'secondary';
                                                @endphp
                                                <span class="badge badge-{{ $color }}">{{ ucfirst($borrowing->status) }}</span>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <p class="text-muted">No borrowing history available for this book</p>
                    @endif
                </div>
            </div>

            <!-- Reviews Card -->
            <div class="card card-primary card-outline mt-3">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-star"></i> Reviews & Ratings
                        <span class="badge badge-primary">{{ $book->reviews->count() }}</span>
                    </h3>
                </div>
                <div class="card-body">
                    @if($book->reviews->count() > 0)
                        @php
                            $averageRating = $book->reviews->avg('rating');
                            $totalReviews = $book->reviews->count();
                        @endphp
                        <div class="mb-3">
                            <h5>Average Rating:
                                <span class="text-warning">
                                    @for($i = 1; $i <= 5; $i++)
                                        @if($i <= round($averageRating))
                                            <i class="fas fa-star"></i>
                                        @else
                                            <i class="far fa-star"></i>
                                        @endif
                                    @endfor
                                </span>
                                <strong>{{ number_format($averageRating, 1) }}</strong> / 5.0
                                ({{ $totalReviews }} {{ $totalReviews == 1 ? 'review' : 'reviews' }})
                            </h5>
                        </div>
                        <hr>
                        @foreach($book->reviews as $review)
                            <div class="card mb-3">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between mb-2">
                                        <div>
                                            <strong>{{ $review->member->name ?? 'Anonymous' }}</strong>
                                            <span class="text-warning ml-2">
                                                @for($i = 1; $i <= 5; $i++)
                                                    @if($i <= $review->rating)
                                                        <i class="fas fa-star"></i>
                                                    @else
                                                        <i class="far fa-star"></i>
                                                    @endif
                                                @endfor
                                            </span>
                                            <span class="ml-2">({{ $review->rating }}/5)</span>
                                        </div>
                                        <small class="text-muted">{{ $review->created_at->format('Y-m-d H:i') }}</small>
                                    </div>
                                    @if($review->comment)
                                        <p class="mb-0">{{ $review->comment }}</p>
                                    @else
                                        <p class="text-muted mb-0">No comment provided</p>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    @else
                        <p class="text-muted">No reviews available for this book</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
