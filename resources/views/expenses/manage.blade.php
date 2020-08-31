@extends('layouts.main')

@section('content')

<div class="fade-in">
  @include('partials.errors')
  @include('partials.success')
  <div class="card">
    <div class="card-header">
      <strong>{{ $title }}</strong>
      <div class="card-header-actions">
        <a href="{{ route('expenses.add') }}"><i class="fas fa-plus"></i></a>
      </div>
    </div>
    <div class="card-body">
      <table class="table table-responsive-lg">
        <thead>
          <tr>
            <th>#</th>
            <th>Description</th>
            <th>Price</th>
            <th>Timestamp</th>
            <th>Supplier</th>
            <th>Controls</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($expenses as $expense)
            <tr>
              <td>{{ $expense->id }}</td>
              <td>{{ $expense->description }}</td>
              <td>MVR {{ number_format($expense->price, 2) }}</td>
              <td>{{ $expense->created_at->format('d M Y h:i') }}</td>
              <td>{{ $expense->supplier()->first()->name }}</td>
              <td></td>
            </tr>
          @endforeach
        </tbody>
      </table>
      {{ $expenses->links() }}
    </div>
  </div>
</div>
    
@endsection