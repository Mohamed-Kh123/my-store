@extends('layouts.admin')

@section('title')
<div class="d-flex justify-content-between">
    <h2>Tags</h2>
    @can('tag.create')
    <div class="">
        <a class="btn btn-sm btn-outline-primary" href="{{ route('tags.create') }}">Create</a>
    </div>
    @endcan
</div>
@endsection

@section('breadcrumb')
<ol class="breadcrumb float-sm-right">
    <li class="breadcrumb-item"><a href="{{route('statistic.index')}}">Home</a></li>
    <li class="breadcrumb-item active">Tags</li>
</ol>
@endsection



@section('content')
    
    <x-alert />

    <table class="table">
        <thead>
            <tr>
                <th>Tag name</th>
                <th>Products Number</th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach($tags as $tag)
            <tr>
                <td>{{ $tag->name }}</td>
                <td>{{ $tag->products_count }}</td>
                @can('tag.update')
                <td>
                <a href="{{ route('tags.edit', $tag->id) }}" class="btn btn-sm btn-dark">Edit</a>
                </td>
                @endcan
                @can('tag.delete')
                <td>
                <form action="{{ route('tags.destroy', $tag->id) }}" method="post">
                    @csrf
                    @method('delete')
                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                </form>
                </td>
                @endcan
            </tr>
            @endforeach
        </tbody>
    </table>


    {{ $tags->links() }}
@endsection

