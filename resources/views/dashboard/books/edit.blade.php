@extends('layouts.dashboard')

@section('title', 'Edit Product')

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item">Products</li>
    <li class="breadcrumb-item active">Edit Product</li>
@endsection

@section('content')

    <form action="{{ route('books.update', $book->id) }}" method="post">
        @csrf
        @method('put')

        @include('dashboard.books._form', [
            'button_label' => 'Update',
        ])
    </form>

@endsection
