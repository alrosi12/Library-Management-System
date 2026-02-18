<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">Add New Book</h3>
    </div>

    <form action="{{ route('books.store') }}" method="POST">
        @csrf
        <div class="card-body">
            <div class="form-group">
                <label for="title">Book Title</label>
                <input type="text" name="title" class="form-control @error('title') is-invalid @enderror"
                    id="title" placeholder="Enter title" value="{{ old('title') }}">
                @error('title')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Author</label>
                        <select name="author_id" class="form-control select2">
                            <option value="">Select Author</option>
                            @foreach ($authors as $author)
                                <option value="{{ $author->id }}"
                                    {{ old('author_id') == $author->id ? 'selected' : '' }}>
                                    {{ $author->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label>Publisher</label>
                        <select name="publisher_id" class="form-control">
                            <option value="">Select Publisher</option>
                            @foreach ($publishers as $publisher)
                                <option value="{{ $publisher->id }}"
                                    {{ old('publisher_id') == $publisher->id ? 'selected' : '' }}>
                                    {{ $publisher->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label>Category</label>
                    <select name="category_id" class="form-control">
                        <option value="">Select Category</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}"
                                {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label>ISBN</label>
                        <input type="text" name="isbn" class="form-control" value="{{ old('isbn') }}">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Price</label>
                        <input type="number" step="0.01" name="price" class="form-control"
                            value="{{ old('price') }}">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Quantity</label>
                        <input type="number" name="quantity" class="form-control" value="{{ old('quantity') }}">
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label for="status">Book Status</label>
            <select name="status" id="status" class="form-control @error('status') is-invalid @enderror">
                <option value="available" {{ old('status', $book->status ?? 'available') == 'available' ? 'selected' : '' }}>
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
            @error('status')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <div>
            <x-form.textarea :label="Description" name="description" />
        </div>

        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Save Book</button>
            <a href="{{ route('books.index') }}" class="btn btn-default">Cancel</a>
        </div>
    </form>
</div>
