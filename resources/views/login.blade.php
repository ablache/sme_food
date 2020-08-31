<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ env('APP_NAME') }} | Login</title>

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  </head>
  <body class="c-app flex-row align-items-center">

  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card-group">
          <div class="card p-4">
            <div class="card-body">
              <h1>Login</h1>
              <p class="text-muted">Sign In to your account</p>
              {!! Form::open() !!}
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text">
                      <i class="fas fa-user"></i>
                    </span>
                  </div>
                  {!! Form::text('email', null, ['class' => 'form-control', 'placeholder' => 'Email']) !!}
                </div>
                <div class="input-group mb-4">
                  <div class="input-group-prepend">
                    <span class="input-group-text">
                      <i class="fas fa-lock"></i>
                    </span>
                  </div>
                  {!! Form::password('password', ['class' => 'form-control', 'placeholder' => 'Password']) !!}
                </div>
                <div class="row">
                  <div class="col-6">
                    {!! Form::submit('Login', ['class' => 'btn btn-primary px-4 lgn']) !!}
                  </div>
                  <div class="col-6 text-right">
                    
                  </div>
                  <div class="col-12 mt-1">
                    @include('partials.errors')
                  </div>
                </div>
              {!! Form::close() !!}
            </div>
          </div>
          <div class="card text-white bg-primary py-5 d-md-down-none lgn-back" style="width:44%">
            <div class="card-body text-center">
              <div>
                <h2>CURRY CRAB</h2>
                <p>Expense and order tracking application.</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="{{ asset('js/app.js') }}"></script>
  @yield('scripts')
  </body>
</html>
