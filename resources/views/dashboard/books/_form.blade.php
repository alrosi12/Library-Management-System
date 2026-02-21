@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">Add New Book</h3>
    </div>

    <form action="{{ route('books.store') }}" method="POST">
        @csrf
        <div class="card-body">

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="title">Book Title</label>
                        <input type="text" name="title" class="form-control @error('title') is-invalid @enderror"
                            id="title" placeholder="Enter title" value="{{ old('title', $book->title ?? '') }}">
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="title">Edition</label>
                            <input type="number" name="edition" class="form-control" min="1"
                                value="{{ old('edition', $book->edition ?? '') }}">
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label for="publisher_date">Publish Date</label>
                    <input type="date" name="publisher_date" id="publisher_date"
                        class="form-control @error('publisher_date') is-invalid @enderror"
                        value="{{ old('published_date', $book->publisher_date ? $book->publisher_date->format('Y-m-d') : '') }}">
                    @error('publisher_date')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Author</label>
                        <select name="author_id" class="form-control select2">
                            <option value="">Select Author</option>
                            @foreach ($authors as $author)
                                <option value="{{ $author->id }}"
                                    {{ old('author_id', $author->id) == $author->id ? 'selected' : '' }}>
                                    {{ $author->name }}
                                </option>
                            @endforeach
                            @error('author_id')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </select>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="mb-3"> <!-- Bootstrap 5 spacing class -->
                        <label for="publisher_id" class="form-label">Publisher</label>
                        <select name="publisher_id" id="publisher_id"
                            class="form-control @error('publisher_id') is-invalid @enderror">
                            <option value="">Select Publisher</option>

                            @foreach ($publishers as $publisher)
                                <option value="{{ $publisher->id }}"
                                    {{ old('publisher_id', $book->publisher_id ?? '') == $publisher->id ? 'selected' : '' }}>
                                    {{ $publisher->name }}
                                </option>
                            @endforeach
                        </select>

                        @error('publisher_id')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="categories">Categories</label>
                        <select name="category_ids[]" id="categories" multiple class="form-control" size="5">
                            <option value="" disabled>-- اختر الأقسام --</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ (old('category_ids') && in_array($category->id, old('category_ids'))) || (isset($book) && $book->categories->contains($category->id)) ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        <small class="form-text text-muted">اضغط Ctrl (أو Cmd في Mac) لاختيار أكثر من قسم</small>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>ISBN</label>
                            <input type="text" name="isbn" class="form-control"
                                value="{{ old('isbn', $book->isbn) }}">
                        </div>
                    </div>

                    <div class="form-group col-md-4">
                        <label for="title">Page Count</label>
                        <input type="number" name="page_count" class="form-control" min="1"
                            value="{{ old('page_count', $book->page_count) }}">
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Total Copies</label>
                            <input type="number" name="total_copies" class="form-control"
                                value="{{ old('total_copies', $book->total_copies) }}" min="1">
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror"
                            rows="4" placeholder="Enter book description...">{{ old('description', $book->description) }}</textarea>

                    </div>
                </div>
            </div>
            <div class="form-group col-md-4">
                <label for="status">Book Status</label>
                <select name="status" id="status" class="form-control @error('status') is-invalid @enderror">
                    <option value="available"
                        {{ old('status', $book->status ?? 'available') == 'available' ? 'selected' : '' }}>
                        Available
                    </option>
                    <option value="borrowed" {{ old('status', $book->status ?? '') == 'borrowed' ? 'selected' : '' }}>
                        Borrowed
                    </option>
                    <option value="reserved" {{ old('status', $book->status ?? '') == 'reserved' ? 'selected' : '' }}>
                        Reserved
                    </option>
                    <option value="archived" {{ old('status', $book->status ?? '') == 'archived' ? 'selected' : '' }}>
                        Archived
                    </option>
                </select>

            </div>



            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Save Book</button>
                <a href="{{ route('books.index') }}" class="btn btn-default">Cancel</a>
            </div>
    </form>
</div>
