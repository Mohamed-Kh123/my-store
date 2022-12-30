@extends('layouts.admin')

@section('title')
<div class="d-flex justify-content-between">
    <h2>Brands</h2>
    @can('brand.create')
    <div class="">
        <a class="btn btn-sm btn-outline-primary" href="{{ route('brands.create') }}">Create</a>
    </div>
    @endcan
</div>
@endsection

@section('breadcrumb')
<ol class="breadcrumb float-sm-right">
    <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
    <li class="breadcrumb-item active">Brands</li>
</ol>
@endsection



@section('content')
    
    <x-alert />

    <table class="table">
        <thead>
            <tr>
                <th>Brand Name</th>
                <th>Products count</th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach($brands as $brand)
            <tr>
                <td>{{ $brand->name }}</td>
                <td>{{ $brand->products_count }}</td>
                @can('brand.update')
                <td>
                <a href="{{ route('brands.edit', $brand->id) }}" class="btn btn-sm btn-dark">Edit</a>
                </td>
                @endcan
                @can('brand.delete')
                <td>
                    <form action="{{ route('brands.destroy', $brand->id) }}" method="post">
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


    {{ $brands->links() }}
@endsection

