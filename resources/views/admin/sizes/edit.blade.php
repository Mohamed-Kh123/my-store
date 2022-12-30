@extends('layouts.admin')


@section('title', 'Edit Size')

@section('breadcrumb')
<ol class="breadcrumb float-sm-right">
    <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
    <li class="breadcrumb-item"><a href="{{route('sizes.index')}}">Sizes</a></li>
    <li class="breadcrumb-item active">Edit</li>
</ol>
@endsection



@section('content')

<form action="{{ route('sizes.update', $size->id) }}" method="post" >
    @csrf
    @method('put')
    
    @include('admin.sizes._form', [
        'button' => 'Update'
    ])
</form>

@endsection