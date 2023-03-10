@extends('layouts.admin')


@section('title', 'Create New role')

@section('breadcrumb')
<ol class="breadcrumb float-sm-right">
    <li class="breadcrumb-item"><a href="{{route('statistic.index')}}">Home</a></li>
    <li class="breadcrumb-item"><a href="#">roles</a></li>
    <li class="breadcrumb-item active">Create</li>
</ol>
@endsection

@section('content')

<form action="{{ route('roles.store') }}" method="post" enctype="multipart/form-data">
    @csrf

    @include('admin.roles._form', [
        'button' => 'Add',
    ])
</form>

@endsection