@extends('layouts.admin')


@section('title', 'Create New brand')

@section('breadcrumb')
<ol class="breadcrumb float-sm-right">
    <li class="breadcrumb-item"><a href="{{route('statistic.index')}}">Home</a></li>
    <li class="breadcrumb-item"><a href="{{route('brands.index')}}">Brands</a></li>
    <li class="breadcrumb-item active">Create</li>
</ol>
@endsection




@section('content')

<form action="{{ route('brands.store') }}" method="post">
    @csrf
    @include('admin.brands._form', [
        'button' => 'Add',
    ])
</form>

@endsection