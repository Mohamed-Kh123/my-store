@extends('layouts.admin')


@section('title', 'Create New Size')

@section('breadcrumb')
<ol class="breadcrumb float-sm-right">
    <li class="breadcrumb-item"><a href="{{route('statistic.index')}}">Home</a></li>
    <li class="breadcrumb-item"><a href="{{route('sizes.index')}}">Sizes</a></li>
    <li class="breadcrumb-item active">Create</li>
</ol>
@endsection




@section('content')

<form action="{{ route('sizes.store') }}" method="post">
    @csrf
    @include('admin.sizes._form', [
        'button' => 'Add',
    ])
</form>

@endsection