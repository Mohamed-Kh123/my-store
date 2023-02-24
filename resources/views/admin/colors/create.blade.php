@extends('layouts.admin')


@section('title', 'Create New color')

@section('breadcrumb')
<ol class="breadcrumb float-sm-right">
    <li class="breadcrumb-item"><a href="{{route('statistic.index')}}">Home</a></li>
    <li class="breadcrumb-item"><a href="{{route('colors.index')}}">Colors</a></li>
    <li class="breadcrumb-item active">Create</li>
</ol>
@endsection




@section('content')

<form action="{{ route('colors.store') }}" method="post">
    @csrf
    @include('admin.colors._form', [
        'button' => 'Add',
    ])
</form>

@endsection