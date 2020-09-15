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
                  <td width=150>
                    <a href="{{ route('expenses.edit', ['id' => $expense->id]) }}" class="btn btn-outline-primary"><span class="fas fa-pen"></span></a>
                    <a href="{{ route('expenses.delete', ['id' => $expense->id]) }}" class="del-conf btn btn-outline-primary"><span class="fas fa-trash"></span></a>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
          {{ $expenses->withQueryString()->links() }}
        </div>
      </div>
    </div>
  </div>

  @include('partials.delete-confirm-modal')
</div>
    
@endsection