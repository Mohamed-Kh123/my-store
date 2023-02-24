@extends('layouts.admin')

@section('title')
<div class="d-flex justify-content-between">
    <h2>Colors</h2>
    @can('color.create')
    <div class="">
        <a class="btn btn-sm btn-outline-primary" href="{{ route('colors.create') }}">Create</a>
    </div>
    @endcan
</div>
@endsection

@section('breadcrumb')
<ol class="breadcrumb float-sm-right">
    <li class="breadcrumb-item"><a href="{{route('statistic.index')}}">Home</a></li>
    <li class="breadcrumb-item active">Colors</li>
</ol>
@endsection



@section('content')
    
    <x-alert />

    <table class="table">
        <thead>
            <tr>
                <th>Color Name</th>
                <th>Products count</th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach($colors as $color)
            <tr>
                <td>{{ $color->name }}</td>
                <td>{{ $color->products_count }}</td>
                @can('color.update')
                <td>
                <a href="{{ route('colors.edit', $color->id) }}" class="btn btn-sm btn-dark">Edit</a>
                </td>
                @endcan
                @can('color.delete')
                <td>
                    <form action="{{ route('colors.destroy', $color->id) }}" method="post">
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


    {{ $colors->links() }}
@endsection

