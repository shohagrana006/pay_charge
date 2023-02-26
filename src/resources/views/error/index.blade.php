<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="{{asset('assets/backend-assets/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/backend-assets/css/style.css')}}">
    <title>{{ decode('Error') }}</title>
  </head>
  <body>
    <section class="error_background">
      <div class="error_container">
        <div class="animation_container">
          <div class="animation"></div>
        </div>
        <div class="error_text">
          <div>
            <div class="d-flex align-items-center justify-content-center ">
              <h3 class="text-danger">40</h3>
              <h3 class="  text-danger">4</h3>
            </div>
            <h2>Ops!</h2>
            <p>
             {{ decode(' The page you are requested for') }} <br />
              {{ decode('is unavailable') }}
            </p>
            <button class="border-0 rounded-pill px-3 py-2 btn-danger">
              <a class="text-light" href="{{ route('user.dashboard') }}">Back to home</a>
            </button>
          </div>
        </div>
      </div>
    </section>
  </body>
</html>
