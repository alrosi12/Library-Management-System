@extends('layouts.app')

@section('title', 'Edit Book')

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item">Book</li>
    <li class="breadcrumb-item active">Edit Book</li>
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
