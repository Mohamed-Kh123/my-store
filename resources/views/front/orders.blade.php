@extends('layouts.store')

@section('content')


<div class="table">
    <table class="custom-table">
      <caption>Orders</caption>
      <thead>
        <tr>
          <th scope="col">Status</th>
          <th scope="col">Payment Status</th>
          <th scope="col">Total</th>
          <th></th>
        </tr>
      </thead>  
      <tbody>
          @foreach($orders as $order)
              <tr id="{{$order->id}}">
                  <td data-label="Account">{{$order->status}}</td>
                  <td data-label="Due Date">{{$order->payment_status}}</td>
                  <td data-label="Amount">${{$order->total}}</td>
                  @if($order->status == "pending" && $order->payment_status == "unpaid")
                  <td><a href="{{route('orders.paymentIntent.create', $order->id)}}" class="btn btn-primary">Pay now!</a></td>
                  @elseif($order->payment_status == "paid")
                  <td><a href="" class="btn btn-success disabled">Paid</a></td>
                  @else                 
                  <td><a href="" class="opacity-25 btn btn-dark disabled">Cancelled</a></td>
                  @endif
              </tr>
          @endforeach
  
      </tbody>
    </table>
  </div>

@endsection

@section('script')

<script>
 
    (function($){
        $('a#delete-form').on('click', function(e){
            e.preventDefault();
            let id = $(this).data('id');
            Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire(
                'Deleted!',
                'Your file has been deleted.',
                'success'
                )
                $.ajax({
                method: "delete",
                url: "/orders/"+id,
                data: {
                    _token: $("meta[name='csrf-token']").attr("content"),
                },
                dataType: "json",
                success: function (response) {
                    $(`#${id}`).remove();
                }
            });
            }
            })
            
        })
    })(jQuery)
 
</script>

@endsection