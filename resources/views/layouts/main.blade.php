<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Lucky Draw | @yield('title')</title>

  <!-- General CSS Files -->
  @include('layouts.style')
</head>

<body>
  <div id="app">
    <div class="main-wrapper">
      <div class="navbar-bg"></div>

      <nav class="navbar navbar-expand-lg main-navbar">
        @include('layouts.header')
      </nav>

      <div class="main-sidebar">
       @include('layouts.sidebar')
      </div>
      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          @yield('content')
        </section>
      </div>
      
      {{-- Footer --}}
      @include('layouts.footer')
    </div>
  </div>

  @include('layouts.script')
  @stack('js')


  
</body>
</html>
