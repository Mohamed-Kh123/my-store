@extends('layouts.admin')


@section('title', 'Edit Dimension')

@section('breadcrumb')
<ol class="breadcrumb float-sm-right">
    <li class="breadcrumb-item"><a href="{{route('statistic.index')}}">Home</a></li>
    <li class="breadcrumb-item"><a href="{{route('dimensions.index')}}">Dimensions</a></li>
    <li class="breadcrumb-item active">Edit</li>
</ol>
@endsection



@section('content')

<form action="{{ route('dimensions.update', $dimension->id) }}" method="post" >
    @csrf
    @method('put')
    
    @include('admin.dimensions._form', [
        'button' => 'Update'
    ])
</form>

@endsection