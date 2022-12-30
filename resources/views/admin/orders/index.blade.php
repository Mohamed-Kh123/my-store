@extends('layouts.admin')

@section('title', 'Orders')

@section('breadcrumb')
<ol class="breadcrumb float-sm-right">
    <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
    <li class="breadcrumb-item active">Orders</li>
</ol>
@endsection



@section('content')
    
    <x-alert />

    <table class="table">
        <thead>
            <tr>
                <th>Order Number</th>
                <th>Status</th>
                <th>Payment Status</th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach($orders as $order)
            <tr>
                <td>{{ $order->number }}</td>
                <td>{{ $order->status }}</td>
                <td>{{ $order->payment_status }}</td>
                @can('order.update')
                <td>
                <a href="{{ route('orders.edit', $order->id) }}" class="btn btn-sm btn-dark">Edit</a>
                </td>
                @endcan
            </tr>
            @endforeach
        </tbody>
    </table>


    {{ $orders->links() }}
@endsection

