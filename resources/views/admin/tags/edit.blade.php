@extends('layouts.admin')


@section('title', 'Edit Tag')

@section('breadcrumb')
<ol class="breadcrumb float-sm-right">
    <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
    <li class="breadcrumb-item"><a href="{{route('tags.index')}}">Tags</a></li>
    <li class="breadcrumb-item active">Edit</li>
</ol>
@endsection



@section('content')

<form action="{{ route('tags.update', $tag->id) }}" method="post" >
    @csrf
    @method('put')
    
    @include('admin.tags._form', [
        'button' => 'Update'
    ])
</form>

@endsection