@extends('layouts.admin')

@section('title')
<div class="d-flex justify-content-between">
    <h2>Sizes</h2>
    @can('size.create')
    <div class="">
        <a class="btn btn-sm btn-outline-primary" href="{{ route('sizes.create') }}">Create</a>
    </div>
    @endcan
</div>
@endsection

@section('breadcrumb')
<ol class="breadcrumb float-sm-right">
    <li class="breadcrumb-item"><a href="{{route('statistic.index')}}">Home</a></li>
    <li class="breadcrumb-item active">Sizes</li>
</ol>
@endsection



@section('content')
    
    <x-alert />

    <table class="table">
        <thead>
            <tr>
                <th>Size</th>
                <th>Products Number</th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach($sizes as $size)
            <tr>
                <td>{{ Str::upper($size->size) }}</td>
                <td>{{ $size->products_count }}</td>
                @can('size.update')
                <td>
                <a href="{{ route('sizes.edit', $size->id) }}" class="btn btn-sm btn-dark">Edit</a>
                </td>
                @endcan
                @can('size.delete')
                <td>
                <form action="{{ route('sizes.destroy', $size->id) }}" method="post">
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


    {{ $sizes->links() }}
@endsection

