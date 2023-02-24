@extends('layouts.admin')


@section('title', 'Edit Color')

@section('breadcrumb')
<ol class="breadcrumb float-sm-right">
    <li class="breadcrumb-item"><a href="{{route('statistic.index')}}">Home</a></li>
    <li class="breadcrumb-item"><a href="{{route('colors.index')}}">Colors</a></li>
    <li class="breadcrumb-item active">Edit</li>
</ol>
@endsection



@section('content')

<form action="{{ route('colors.update', $color->id) }}" method="post" >
    @csrf
    @method('put')
    
    @include('admin.colors._form', [
        'button' => 'Update'
    ])
</form>

@endsection