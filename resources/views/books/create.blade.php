@extends('layout.app')


@push('style')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link href="path/to/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/@ttskch/select2-bootstrap4-theme@x.x.x/dist/select2-bootstrap4.min.css">
@endpush

@section('content')
    <div class="col-md-12">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Create new Book </h3>
            </div>

            <form action="{{route('books.store')}}" method="POST">
                @csrf
                
                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <label for="exampleInputEmail1">Title</label>
                            <input type="text" name="title" class="form-control" id="exampleInputEmail1"
                                placeholder="Enter Title">
                        </div>
                        <div class="col-6">
                            <label for="exampleInputEmail1">Code Isbn</label>
                            <input type="text" name="isbn" class="form-control" placeholder="Code Isbn">
                        </div>

                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="publisher_date">Publish Date</label>
                                <input type="date" name="publisher_date" id="publisher_date"
                                    class="form-control @error('publisher_date') is-invalid @enderror">
                                {{-- value="{{ old('published_date', $book->publisher_date ? $book->publisher_date->format('Y-m-d') : '') }}" --}}
                                @error('publisher_date')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-4">
                            <label for="exampleInputEmail1">Page Count</label>
                            <input type="text" name="page_count" class="form-control" placeholder="Page Count">
                        </div>
                        <div class="col-4">
                            <label for="exampleInputPassword1">Edition</label>
                            <input type="text" name="edition" class="form-control" id="exampleInputPassword1"
                                placeholder="Edition">
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <div class="row">

                        <div class="col-4">
                            <div class="form-group">
                                <label>Publisher</label>
                                <select class="form-control select2" style="width: 100%;">
                                    @foreach ($publishers as $publisher)
                                        <option>{{ $publisher->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label>Author</label>
                                <select class="form-control select2" style="width: 100%;">
                                    @foreach ($authors as $author)
                                        <option>{{ $author->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-4">
                            <label>Status</label>
                            <select class="form-control select2" style="width: 100%;">
                                <option selected="selected">Alabama</option>
                                <option>available</option>
                                <option>borrowed</option>
                                <option>reserved</option>
                                <option>archived</option>
                            </select>
                        </div>

                    </div>
                </div>


                <div class="card-body">
                    <div class="row">
                        <div class="col-4">
                            <label>Textarea</label>
                            <textarea class="form-control" rows="3" placeholder="Enter ..."></textarea>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Multiple Category</label>
                                <select class="select2" multiple="multiple" data-placeholder="Select a State"
                                    style="width: 100%;">
                                    <option>Alabama</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>

            </form>
        </div>
    @endsection
    @push('scripts')
        <script src="path/to/select2.min.js"></script>
        <script>
            //Initialize Select2 Elements
            $('.select2').select2()

            //Initialize Select2 Elements
            $('.select2bs4').select2({
                theme: 'bootstrap4'
            })
            $(document).ready(function() {
                $('.js-example-basic-multiple').select2();
            });
            $('select').select2({
                theme: 'bootstrap4',
            });
        </script>

        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    @endpush
