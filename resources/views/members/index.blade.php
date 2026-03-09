@extends('layout.app')

@push('style')
    <link rel="stylesheet" href="{{ asset('/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/dist/css/adminlte.min.css') }}">
@endpush




@section('content')

    <div class="card card-primary  ">
        <div class="card-header">
            <h3 class="card-title">Borrowing History</h3>
            {{-- <span class="badge bg-warning float-right">{{ $members->count() }}</span> --}}


        </div>
        <div class="card-body">
            <div>
                {{-- <span class=""> <b> Count : </b>{{ $book->borrowings->count() }}</span> --}}

                <table class="table table-bordered table-hover">
                    <header>
                        <th>Member Name</th>
                        <th>Email</th>
                        <th>Phone Number</th>
                        <th colspan="">Status</th>
                    </header>
                    <tbody>
                        @if ($members->count() > 0)
                            @foreach ($members as $member)
                                <tr data-widget="expandable-table" aria-expanded="false">
                                    <td><a href="{{ route('members.show', $member->id) }}">{{ $member->name }}</a></td>
                                    <td>{{ $member->email }}</td>
                                    <td>{{ $member->phone }}</td>
                                    @if ($member->is_active == 1)
                                        <td>
                                            <p class="badge bg-warning">Active</p>
                                        </td>
                                    @else
                                        <td>
                                            <p class="badge bg-danger ">inActive</p>
                                        </td>
                                    @endif

                                </tr>
                            @endforeach
                        @else
                            <td colspan="4">No Borrowings</td>
                        @endif
                    </tbody>
                </table>
                <p><b>Active Borrows Count:</b> {{ $activeBorrowings->count() }}</p>
                {{ $members->withQueryString()->links() }}

            </div>
        </div>
    </div>

@endsection

@push('scripts')
    <script src="{{ asset('/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('/plugins/jszip/jszip.min.js') }}"></script>
    <script src="{{ asset('/plugins/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ asset('/plugins/pdfmake/vfs_fonts.js') }}"></script>
    <script src="{{ asset('/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
    <script src="{{ asset('/dist/js/adminlte.min.js') }}"></script>
    <script src="{{ asset('/dist/js/demo.js') }}"></script>
    <script>
        $(function() {
            $("#example1").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

        });
    </script>
@endpush
