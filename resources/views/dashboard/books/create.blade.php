@extends('layouts.dashboard')

@section('title', 'Books')

@section('breadcrumb')
@parent
<li class="breadcrumb-item active">Books</li>
@endsection

@section('content')

<form action="{{ route('books.store') }}" method="post">
    @csrf

    @include('dashboard.books._form')
</form>

@endsection
