@extends('layouts.main')

@section('content')
    
<div class="fade-in">
  @include('partials.errors')
  @include('partials.success')
  <div class="card">
    <div class="card-header">
      <strong>{{ $title }}</strong>
      <div class="card-header-actions">
        <a href="{{ route('customers.add') }}"><i class="fas fa-plus"></i></a>
      </div>
    </div>
    <div class="card-body">
      <table class="table table-responsive-lg">
        <thead>
          <tr>
            <th>#</th>
            <th>Name</th>
            <th>Contact</th>
            <th>Address</th>
            <th>Controls</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($customers as $customer)
            <tr>
              <td>{{ $customer->id }}</td>
              <td>{{ $customer->name }}</td>
              <td>{{ $customer->contact }}</td>
              <td>{{ $customer->address }}</td>
              <td>
                <a href="{{ route('customers.edit', ['id' => $customer->id]) }}" class="btn btn-outline-primary"><span class="fas fa-pen"></span></a>
                <a href="{{ route('customers.delete', ['id' => $customer->id]) }}" class="del-conf btn btn-outline-primary"><span class="fas fa-trash"></span></a>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
      {{ $customers->links() }}
    </div>
  </div>
  @include('partials.delete-confirm-modal')
</div>

@endsection