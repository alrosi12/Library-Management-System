@extends('layout.app')


@push('style')
    {{-- <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" /> --}}
    <link href="path/to/select2.min.css" rel="stylesheet" />
    {{-- <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/@ttskch/select2-bootstrap4-theme@x.x.x/dist/select2-bootstrap4.min.css"> --}}
@endpush

@section('content')

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


    <div class="col-md-12">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Edit Book </h3>
            </div>

            <form action="{{ route('books.update', $book->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <label for="exampleInputEmail1">Title</label>
                            <input type="text" name="title" class="form-control" id="exampleInputEmail1"
                                placeholder="Enter Title" value="{{ old('title', $book->title) }}">
                        </div>
                        <div class="col-6">
                            <label for="exampleInputEmail1">Code Isbn</label>
                            <input type="text" name="isbn" class="form-control" placeholder="Code Isbn"
                                value="{{ old('isbn', $book->isbn) }}">
                        </div>

                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="publisher_date">Publish Date</label>
                                <input type="date" name="publish_date" id="publisher_date" class="form-control"
                                    value="{{ old('published_date', $book->publisher_date ? $book->publisher_date->date('Y-m-d') : '0000-00-00') }}">
                            </div>
                        </div>
                        <div class="col-4">
                            <label for="page_count">Page Count</label>
                            <input type="text" name="page_count" class="form-control" placeholder="Page Count"
                                value="{{ old('page_count', $book->page_count) }}">
                        </div>
                        <div class="col-4">
                            <label for="edition">Edition</label>
                            <input type="text" name="edition" class="form-control" id="edition" placeholder="Edition"
                                value="{{ old('edition', $book->edition) }}">
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <div class="row">

                        <div class="col-4">
                            <div class="form-group">
                                <label>Publisher</label>
                                <select name="publisher_id" class="form-control select2" style="width: 100%;">
                                    <option value="">Select Book publisher</option>
                                    @foreach ($publishers as $publisher)
                                        <option value="{{ $publisher->id }}"
                                            {{ old('publisher_id', $book->publisher_id ?? '') == $publisher->id ? 'selected' : '' }}>
                                            {{ $publisher->name }}
                                        </option>
                                    @endforeach

                                </select>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label>Author</label>
                                <select name="author_id" class="form-control select2" style="width: 100%;">
                                    <option disabled>Select Book author</option>
                                    @foreach ($authors as $author)
                                        <option value="{{ $author->id }}"
                                            {{ old('author_id', $author->id) == $author->id ? 'selected' : '' }}>
                                            {{ $author->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-4">
                            <label>Status</label>
                            <select name="status" class="form-control select2" style="width: 100%;">
                                <option disabled>Select Book Status</option>
                                <option value="available"
                                    {{ old('status', $book->status) == 'available' ? 'selected' : '' }}>available
                                </option>
                                <option value="borrowed"
                                    {{ old('status', $book->status) == 'borrowed' ? 'selected' : '' }}>borrowed
                                </option>
                                <option value="reserved"
                                    {{ old('status', $book->status) == 'reserved' ? 'selected' : '' }}>reserved
                                </option>
                                <option value="archived"
                                    {{ old('status', $book->status) == 'archived' ? 'selected' : '' }}>archived
                                </option>
                            </select>
                        </div>

                    </div>
                </div>


                <div class="card-body">
                    <div class="row">
                        <div class="col-4">
                            <label>Textarea</label>
                            <textarea name="description" class="form-control" rows="3" placeholder="Enter ...">{{ $book->description }}
                            </textarea>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Category</label>
                                <select name="category_ids[]" class="select2" multiple="multiple"
                                    data-placeholder="Select a State" style="width: 100%;">
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}"
                                            {{ old('category_ids') || (isset($book) && $book->categories->contains($category->id)) ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
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
    </div>
@endsection
@push('scripts')
    {{-- <script src="path/to/select2.min.js"></script> --}}
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

    {{-- <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script> --}}
@endpush
