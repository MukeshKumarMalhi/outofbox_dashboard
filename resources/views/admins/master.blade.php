@include('admins.a_library')
  <body class="bg-dark-blue">
    <div>
      <div id="wrapper" class="userid dashboard-page closed">
        @include('admins.sidebar')
        <div id="page-content-wrapper">
          @include('admins.header')
          @yield('content')
        </div>
      </div>
      @include('admins.footer')
    </div>
  </body>
</html>
