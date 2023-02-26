<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    @include('layouts.admin.auth.includes.css')
    <title>@yield('admin_auth_title')</title>
  </head>
  <body>
    <section class="login_background">
      @yield('admin_auth_content')
    </section>
    @include('layouts.admin.auth.includes.js')
  </body>
</html>

