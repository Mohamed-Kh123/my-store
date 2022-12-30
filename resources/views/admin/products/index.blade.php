@extends('layouts.admin')

@section('title')
<div class="d-flex justify-content-between">
    <h2>Products</h2>
    @can('product.create')
    <div class="">
        <a class="btn btn-sm btn-outline-primary" href="{{ route('products.create') }}">Create</a>
    </div>
    @endcan
</div>
@endsection

@section('breadcrumb')
<ol class="breadcrumb float-sm-right">
    <li class="breadcrumb-item"><a href="#">Home</a></li>
    <li class="breadcrumb-item active">Products</li>
</ol>
@endsection

@section('content')
    
    <x-alert />

    <table class="table">
        <thead>
            <tr>
                <th>Product Name</th>
                <th>Category</th>
                <th>Price</th>
                <th>Qty</th>
                <th>Status</th>
                <th>Discount</th>
                <th>Dimension</th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $product)
            <tr>
                <td>{{ $product->name }}</td>
                <td>{{ $product->category->name }}</td>
                <td>{{ $product->price }}</td>
                <td>{{ $product->quantity }}</td>
                <td>{{ $product->status }}</td>
                <td>{{ $product->discount }} @if($product->discount) % @endif</td>
                @foreach($product->dimensions as $dimension)
                <td>{{ $dimension->dimension }}</td>
                @endforeach
                @can('product.update')
                <td>
                <a href="{{ route('products.edit', $product->id) }}" class="btn btn-sm btn-dark">Edit</a>
                </td>
                @endcan
                @can('product.delete')
                <td>
                    <form action="{{ route('products.destroy', $product->id) }}" method="post">
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


    {{ $products->links() }}
    

@endsection

