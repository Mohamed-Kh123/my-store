@extends('layouts.admin')


@section('title', 'Edit Brand')

@section('breadcrumb')
<ol class="breadcrumb float-sm-right">
    <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
    <li class="breadcrumb-item"><a href="{{route('brands.index')}}">Brands</a></li>
    <li class="breadcrumb-item active">Edit</li>
</ol>
@endsection



@section('content')

<form action="{{ route('brands.update', $brand->id) }}" method="post" >
    @csrf
    @method('put')
    
    @include('admin.brands._form', [
        'button' => 'Update'
    ])
</form>

@endsection