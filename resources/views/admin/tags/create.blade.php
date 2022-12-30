@extends('layouts.admin')


@section('title', 'Create New Tag')

@section('breadcrumb')
<ol class="breadcrumb float-sm-right">
    <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
    <li class="breadcrumb-item"><a href="{{route('tags.index')}}">Tags</a></li>
    <li class="breadcrumb-item active">Create</li>
</ol>
@endsection




@section('content')

<form action="{{ route('tags.store') }}" method="post">
    @csrf
    @include('admin.tags._form', [
        'button' => 'Add',
    ])
</form>

@endsection