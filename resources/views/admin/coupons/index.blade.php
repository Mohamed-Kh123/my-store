@extends('layouts.admin')

@section('title')
<div class="d-flex justify-content-between">
    <h2>Coupons</h2>
    @can('coupon.create')
    <div class="">
        <a class="btn btn-sm btn-outline-primary" href="{{ route('coupons.create') }}">Create</a>
    </div>
    @endcan
</div>
@endsection

@section('breadcrumb')
<ol class="breadcrumb float-sm-right">
    <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
    <li class="breadcrumb-item active">Coupons</li>
</ol>
@endsection



@section('content')
    
    <x-alert />

    <table class="table">
        <thead>
            <tr>
                <th>Coupon Code</th>
                <th>Amount</th>
                <th>Type</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach($coupons as $coupon)
            <tr>
                <td>{{ $coupon->code }}</td>
                <td>{{ $coupon->amount }}</td>
                <td>{{ $coupon->type }}</td>
                <td>{{ $coupon->start_date }}</td>
                <td>{{ $coupon->end_date }}</td>
                @can('coupon.update')
                <td>
                <a href="{{ route('coupons.edit', $coupon->id) }}" class="btn btn-sm btn-dark">Edit</a>
                </td>
                @endcan
                @can('coupon.delete')
                <td>
                <form action="{{ route('coupons.destroy', $coupon->id) }}" method="post">
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


    {{ $coupons->links() }}
@endsection

