@extends('layouts.main')

@section('content')

<div class="fade-in">

  <div class="row">
    <div class="col-sm-12">
      <h3>{{ $title }}</h3>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-12">
      <div class="card">
        <div class="card-header">
          <strong>Ordered By</strong>
        </div>
        <div class="card-body">
          <ul class="list-group">
            <li class="list-group-item">
              <span class="float-left"><strong>Name</strong></span>
              <span class="float-right">{{ $order->customer()->first()->name }}</span>
            </li>
            <li class="list-group-item">
              <span class="float-left"><strong>Address</strong></span>
              <span class="float-right">{{ $order->customer()->first()->address }}</span>
            </li>
            <li class="list-group-item">
              <span class="float-left"><strong>Contact</strong></span>
              <span class="float-right">{{ $order->customer()->first()->contact }}</span>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-12">
      <div class="card">
        <div class="card-header">
          <strong>Items</strong>
        </div>
        <div class="card-body">
          <table class="table table-responsive-lg">
            <thead>
              <tr>
                <th>Qty</th>
                <th>Item</th>
                <th>Type</th>
                <th>Preferences</th>
                <th>Unit Price</th>
                <th>Total</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($order->products as $item)
                <tr>
                  <td>{{ $item->pivot->quantity }}</td>
                  <td>
                    <a href="{{ route('products.view', ['id' => $item->id]) }}">{{ $item->name }}</a>
                  </td>
                  <td>{{ $item->type()->first()->name }}</td>
                  <td>
                    @if ($item->pivot->preferences)
                      @foreach (json_decode($item->pivot->preferences) as $k => $p)
                        {{ $p->name }}{{ ($k < count(json_decode($item->pivot->preferences)) - 1) ? ',' : '' }}
                      @endforeach
                    @else
                      N/A
                    @endif
                  </td>
                  <td>
                    MVR{{ number_format($item->price, 2) }}
                    @php
                      $subTotal += ($item->pivot->quantity * $item->price)
                    @endphp
                  </td>
                  <td>MVR{{ number_format($item->pivot->quantity * $item->price, 2) }}</td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-12">
      <div class="card">
        <div class="card-header">
          <strong>Delivery Details</strong>
        </div>
        <div class="card-body">
          <ul class="list-group">
            <li class="list-group-item">
              <span class="float-left"><strong>Date / Time</strong></span>
              <span class="float-right">
                @if ($order->deliver_at)
                  {{ $order->deliver_at->format('d M Y H:i') }}
                @else
                  N/A
                @endif
              </span>
            </li>
            <li class="list-group-item">
              <span class="float-left"><strong>Delivery Status</strong></span>
              <span class="float-right">
                <div class="btn-group" role="group" aria-label="none">
                  @foreach ($deliveryStatuses as $ds)
                    <button type="button" class="btn btn-{{ ($order->delivery_status == $ds) ? 'success' : 'secondary' }}">{{ ucfirst($ds) }}</button>
                  @endforeach
                </div>
              </span>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-12">
      <div class="card">
        <div class="card-header">
          <strong>Payment</strong>
        </div>
        <div class="card-body">
          <ul class="list-group">
            <li class="list-group-item">
              <span class="float-left"><strong>Sub-Total</strong></span>
              <span class="float-right">MVR{{ number_format($subTotal, 2) }}</span>
            </li>
            <li class="list-group-item">
              <span class="float-left"><strong>Discount</strong></span>
              <span class="float-right">({{ $order->discount }}%) MVR{{ number_format(($subTotal * ($order->discount / 100)), 2) }}</span>
            </li>
            <li class="list-group-item">
              <span class="float-left"><strong>Grand Total</strong></span>
              <span class="float-right text-danger">MVR{{ number_format(($subTotal - ($subTotal * ($order->discount / 100))), 2) }}</span>
            </li>
            <li class="list-group-item">
              <span class="float-left"><strong>Payment Method</strong></span>
              <span class="float-right">
                <div class="btn-group" role="group" aria-label="none">
                  @foreach ($paymentMethods as $pm)
                    <button type="button" class="btn btn-{{ ($order->payment_method == $pm) ? 'success' : 'secondary' }}">{{ ucfirst($pm) }}</button>
                  @endforeach
                </div>
              </span>
            </li>
            <li class="list-group-item">
              <span class="float-left"><strong>Payment Status</strong></span>
              <span class="float-right">
                <div class="btn-group" role="group" aria-label="none">
                  @foreach ($paymentStatuses as $ps)
                    <button type="button" class="btn btn-{{ ($order->payment_status == $ps) ? 'success' : 'secondary' }}">{{ ucfirst($ps) }}</button>
                  @endforeach
                </div>
              </span>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </div>

</div>
    
@endsection