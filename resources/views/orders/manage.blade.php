@extends('layouts.main')

@section('content')

<div class="fade-in">
  @include('partials.errors')
  @include('partials.success')
  <div class="row">
    <div class="col-sm-12">
      <div class="card">
        <div class="card-body">
          {!! Form::open(['method' => 'GET', 'class' => 'form-inline']) !!}
            <label for="" class="col-sm-1">Start</label>
            {!! Form::date('start', $start, ['class' => 'form-control col-sm-4']) !!}
            <label for="" class="col-sm-1">End</label>
            {!! Form::date('end', $end, ['class' => 'form-control col-sm-4']) !!}
            {!! Form::submit('Filter', ['class' => 'btn btn-outline-primary col-sm-2']) !!}
          {!! Form::close() !!}
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-12">
      <div class="card">
        <div class="card-header">
          <strong>{{ $title }}</strong>
          <div class="card-header-actions">
            <a href="{{ route('orders.add') }}"><i class="fas fa-plus"></i></a>
          </div>
        </div>
        <div class="card-body">
          <table class="table table-responsive-lg">
            <thead>
              <tr>
                <th>#</th>
                <th>Ordered By</th>
                <th>Deliver At</th>
                <th>Items</th>
                <th>Sub-Total</th>
                <th>Discount</th>
                <th>Payable</th>
                <th>Created At</th>
                <th>Controls</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($orders as $order)
                <tr>
                  <td>{{ $order->id }}</td>
                  @php
                    $customer = $order->customer()->first()
                  @endphp
                  <td><strong>{{ $customer->name }}</strong> ({{ $customer->contact }})</td>
                  <td>
                    @if ($order->deliver_at)
                      {{ $order->deliver_at->format('d M Y H:i') }}
                    @else
                      N/A
                    @endif
                  </td>
                  <td>
                    <ul>
                      @php
                        $subTotal = 0;
                      @endphp
                      @foreach ($order->products()->get() as $item)
                        <li>
                          {{ $item->pivot->quantity }} x {{ $item->name }}
                          @php
                            $subTotal += ($item->price * $item->pivot->quantity)
                          @endphp
                        </li>
                      @endforeach
                    </ul>
                  </td>
                  <td>
                    MVR{{ number_format($subTotal, 2) }}
                  </td>
                  <td>{{ $order->discount }} %</td>
                  <td>
                    MVR{{ number_format($subTotal - ($subTotal * ($order->discount / 100))) }}
                  </td>
                  <td>{{ $order->created_at->format('d M Y H:i') }}</td>
                  <td width=150>
                    <a href="{{ route('orders.view', ['id' => $order->id]) }}" class="btn btn-outline-primary"><span class="fas fa-search"></span></a>
                    <a href="{{ route('orders.edit', ['id' => $order->id]) }}" class="btn btn-outline-primary"><span class="fas fa-pen"></span></a>
                    <a href="{{ route('orders.delete', ['id' => $order->id]) }}" class="del-conf btn btn-outline-primary"><span class="fas fa-trash"></span></a>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
          {{ $orders->withQueryString()->links() }}
        </div>
      </div>
    </div>
  </div>

  @include('partials.delete-confirm-modal')
</div>
    
@endsection