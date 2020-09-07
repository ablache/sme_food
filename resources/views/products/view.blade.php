@extends('layouts.main')

@section('content')

<div class="fade-in">
  @include('partials.errors')
  @include('partials.success')
  <div class="card">
    <div class="card-header">
      <strong>{{ $title }}</strong>
    </div>
    <div class="card-body">
      
      <div class="row">
        <div class="col-sm-4 text-center">
          @if ($product->image)
            <img class="img-fluid" src="{{ asset($product->image) }}" alt="{{ $product->name }}">
          @else
            <img class="img-fluid" src="{{ asset('img/img_placeholder.png') }}" alt="{{ $product->name }}">
          @endif
        </div>
        <div class="col-sm-8">
          <ul class="list-group">
            <li class="list-group-item">
              <span class="float-left"><strong>Name</strong></span>
              <span class="float-right">{{ $product->name }}</span>
            </li>
            <li class="list-group-item">
              <span class="float-left"><strong>Type</strong></span>
              <span class="float-right">{{ $product->type()->first()->name }}</span>
            </li>
            <li class="list-group-item">
              <span class="float-left"><strong>Price</strong></span>
              <span class="float-right">MVR{{ number_format($product->price, 2) }}</span>
            </li>
            <li class="list-group-item">
              <span class="float-left"><strong>Availability</strong></span>
              <span class="float-right p-1 badge {{ ($product->status == 'available') ? 'badge-success' : 'badge-danger'}}">{{ ucfirst($product->status) }}</span>
            </li>
            @if ($product->preferences()->count() > 0)
              <li class="list-group-item">
                <span class="float-left"><strong>Preferences</strong></span>
                <span class="float-right">
                  @foreach ($product->preferences()->get() as $pref)
                    <span class="badge badge-secondary">{{ $pref->name }}</span>
                  @endforeach
                </span>
              </li>
            @endif
          </ul>
        </div>
      </div>

    </div>
    <div class="card-footer">
      <a href="{{ route('products.edit', ['id' => $product->id]) }}" class="btn btn-outline-primary">Edit <span class="fas fa-pen"></span></a>
      <a href="{{ route('products.delete', ['id' => $product->id]) }}" class="del-conf btn btn-outline-primary">Delete <span class="fas fa-trash"></span></a>
    </div>
  </div>
  @include('partials.delete-confirm-modal');
</div>
    
@endsection