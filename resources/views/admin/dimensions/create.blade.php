@extends('layouts.admin')


@section('title', 'Create New Dimension')

@section('breadcrumb')
<ol class="breadcrumb float-sm-right">
    <li class="breadcrumb-item"><a href="{{route('statistic.index')}}">Home</a></li>
    <li class="breadcrumb-item"><a href="{{route('dimensions.index')}}">Dimensions</a></li>
    <li class="breadcrumb-item active">Create</li>
</ol>
@endsection




@section('content')

<form action="{{ route('dimensions.store') }}" method="post">
    @csrf
    @include('admin.dimensions._form', [
        'button' => 'Add',
    ])
</form>

@endsection