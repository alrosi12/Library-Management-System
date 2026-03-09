@extends('layout.app')

@section('content')
    <div class="container-fluid">
        <h5 class="mb-2">Info Box</h5>
        <div class="row">
            <div class="col-md-3 col-sm-6 col-12">
                <div class="info-box">
                    <span class="info-box-icon bg-info"><i class="far fa-envelope"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Total books</span>
                        <span class="info-box-number">{{ $books->count() }}</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-md-3 col-sm-6 col-12">
                <div class="info-box">
                    <span class="info-box-icon bg-success"><i class="far fa-flag"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Total Members</span>
                        <span class="info-box-number">{{ $members->count() }}</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-md-3 col-sm-6 col-12">
                <div class="info-box">
                    <span class="info-box-icon bg-warning"><i class="far fa-copy"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Active Borrowings </span>
                        <span class="info-box-number">{{ $borroweds->count() }}</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-md-3 col-sm-6 col-12">
                <div class="info-box">
                    <span class="info-box-icon bg-danger"><i class="far fa-star"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Overdue borrowings </span>
                        <span class="info-box-number">{{ $overdue->count() }} </span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->


        <div class="card-body">
            <div>
                {{-- <span class=""> <b> Count : </b>{{ $book->borrowings->count() }}</span> --}}

                <table class="table table-bordered table-hover">
                    <header>
                        <th>book title</th>
                        <th>member name</th>
                        <th>borrowed date</th>
                        <th>due date</th>
                    </header>
                    <tbody>

                        @foreach ($borrowings as $borrowing)
                            <tr data-widget="expandable-table" aria-expanded="false">
                                <td><a href="{{ route('members.show', $borrowing->id) }}">{{ $borrowing->book->title }}</a>
                                </td>
                                <td>{{ $borrowing->member->name }}</td>
                                <td>{{ $borrowing->borrowed_at }}</td>
                                <td>{{ $borrowing->due_date }}</td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>


            </div>
        </div>


    </div>
@endsection
