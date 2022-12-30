@extends('layouts.admin')

@section('title')
<div class="d-flex justify-content-between">
    <h2>Dimensions</h2>
    @can('dimension.create')
    <div class="">
        <a class="btn btn-sm btn-outline-primary" href="{{ route('dimensions.create') }}">Create</a>
    </div>
    @endcan
</div>
@endsection

@section('breadcrumb')
<ol class="breadcrumb float-sm-right">
    <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
    <li class="breadcrumb-item active">Dimensions</li>
</ol>
@endsection



@section('content')
    
    <x-alert />

    <table class="table">
        <thead>
            <tr>
                <th>Dimension</th>
                <th>Products Number</th>
                <th>Created_At</th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach($dimensions as $dimension)
            <tr>
                <td>{{ $dimension->dimension }}</td>
                <td>{{ $dimension->products_count }}</td>
                <td>{{ $dimension->created_at }}</td>
                @can('dimension.update')
                <td>
                <a href="{{ route('dimensions.edit', $dimension->id) }}" class="btn btn-sm btn-dark">Edit</a>
                </td>
                @endcan
                @can('dimension.delete')
                <td>
                    <form action="{{ route('dimensions.destroy', $dimension->id) }}" method="post">
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


    {{ $dimensions->links() }}
@endsection

