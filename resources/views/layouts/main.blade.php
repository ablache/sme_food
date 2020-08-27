<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ env('APP_NAME') }} | {{ $title }}</title>

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  </head>
  <body class="c-app">

    @include('partials.sidebar')

    <div class="c-wrapper">

      @include('partials.header')
      
      <div class="c-body">
        <main class="c-main">
          <div class="container-fluid">

            @yield('content')

          </div>
        </main>
      </div>

      @include('partials.footer')
    </div>
  <script src="{{ asset('js/app.js') }}"></script>
  @yield('scripts')
  </body>
</html>
