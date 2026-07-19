<!DOCTYPE html>
<html lang="en-US" dir="ltr" data-navigation-type="default" data-navbar-horizontal-shape="default">

  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} - Crear Cuenta</title>

    <link rel="apple-touch-icon" sizes="180x180" href="/phoenixadmin/assets/img/favicons/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/phoenixadmin/assets/img/favicons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/phoenixadmin/assets/img/favicons/favicon-16x16.png">
    <link rel="shortcut icon" type="image/x-icon" href="/phoenixadmin/assets/img/favicons/favicon.ico">
    <link rel="manifest" href="/phoenixadmin/assets/img/favicons/manifest.json">
    <meta name="msapplication-TileImage" content="/phoenixadmin/assets/img/favicons/mstile-150x150.png">
    <meta name="theme-color" content="#ffffff">
    <script src="/phoenixadmin/vendors/simplebar/simplebar.min.js"></script>
    <script src="/phoenixadmin/assets/js/config.js"></script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="">
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@300;400;600;700;800;900&amp;display=swap" rel="stylesheet">
    <link href="/phoenixadmin/vendors/simplebar/simplebar.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">
    <link href="/phoenixadmin/assets/css/theme-rtl.min.css" type="text/css" rel="stylesheet" id="style-rtl">
    <link href="/phoenixadmin/assets/css/theme.min.css" type="text/css" rel="stylesheet" id="style-default">
    <link href="/phoenixadmin/assets/css/user-rtl.min.css" type="text/css" rel="stylesheet" id="user-style-rtl">
    <link href="/phoenixadmin/assets/css/user.min.css" type="text/css" rel="stylesheet" id="user-style-default">
    <script>
      var phoenixIsRTL = window.config.config.phoenixIsRTL;
      if (phoenixIsRTL) {
        var linkDefault = document.getElementById('style-default');
        var userLinkDefault = document.getElementById('user-style-default');
        linkDefault.setAttribute('disabled', true);
        userLinkDefault.setAttribute('disabled', true);
        document.querySelector('html').setAttribute('dir', 'rtl');
      } else {
        var linkRTL = document.getElementById('style-rtl');
        var userLinkRTL = document.getElementById('user-style-rtl');
        linkRTL.setAttribute('disabled', true);
        userLinkRTL.setAttribute('disabled', true);
      }
    </script>
  </head>

  <body>
    <main class="main" id="top">
      <div class="container">
        <div class="row flex-center min-vh-100 py-5">
          <div class="col-sm-10 col-md-8 col-lg-5 col-xl-5 col-xxl-3">
            <a class="d-flex flex-center text-decoration-none mb-4" href="{{ route('home') }}">
              <div class="d-flex align-items-center fw-bolder fs-3 d-inline-block">
                <x-app-logo-icon class="size-9 fill-current text-black dark:text-white" />
              </div>
            </a>

            <div class="text-center mb-7">
              <h3 class="text-body-highlight">Crear Cuenta</h3>
              <p class="text-body-tertiary">Regístrate para empezar a usar el chat</p>
            </div>

            @if ($errors->any())
              <div class="alert alert-danger mb-3" role="alert">
                <ul class="mb-0">
                  @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                  @endforeach
                </ul>
              </div>
            @endif

            <form method="POST" action="{{ route('register.store') }}">
              @csrf

              <div class="mb-3 text-start">
                <label class="form-label" for="name">Nombre completo</label>
                <div class="form-icon-container">
                  <input
                    class="form-control form-icon-input @error('name') is-invalid @enderror"
                    id="name"
                    name="name"
                    type="text"
                    placeholder="Tu nombre"
                    value="{{ old('name') }}"
                    required
                    autofocus
                    autocomplete="name"
                  />
                  <span class="fas fa-user text-body fs-9 form-icon"></span>
                  @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>
              </div>

              <div class="mb-3 text-start">
                <label class="form-label" for="email">Correo electrónico</label>
                <div class="form-icon-container">
                  <input
                    class="form-control form-icon-input @error('email') is-invalid @enderror"
                    id="email"
                    name="email"
                    type="email"
                    placeholder="nombre@ejemplo.com"
                    value="{{ old('email') }}"
                    required
                    autocomplete="email"
                  />
                  <span class="fas fa-envelope text-body fs-9 form-icon"></span>
                  @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>
              </div>

              <div class="row g-3 mb-3">
                <div class="col-sm-6">
                  <label class="form-label" for="password">Contraseña</label>
                  <div class="position-relative" data-password="data-password">
                    <input
                      class="form-control form-icon-input pe-6 @error('password') is-invalid @enderror"
                      id="password"
                      name="password"
                      type="password"
                      placeholder="Contraseña"
                      data-password-input="data-password-input"
                      required
                      autocomplete="new-password"
                    />
                    <button class="btn px-3 py-0 h-100 position-absolute top-0 end-0 fs-7 text-body-tertiary" data-password-toggle="data-password-toggle" type="button">
                      <span class="uil uil-eye show"></span>
                      <span class="uil uil-eye-slash hide"></span>
                    </button>
                    @error('password')
                      <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>
                </div>
                <div class="col-sm-6">
                  <label class="form-label" for="password_confirmation">Confirmar contraseña</label>
                  <div class="position-relative" data-password="data-password">
                    <input
                      class="form-control form-icon-input pe-6"
                      id="password_confirmation"
                      name="password_confirmation"
                      type="password"
                      placeholder="Repite la contraseña"
                      data-password-input="data-password-input"
                      required
                      autocomplete="new-password"
                    />
                    <button class="btn px-3 py-0 h-100 position-absolute top-0 end-0 fs-7 text-body-tertiary" data-password-toggle="data-password-toggle" type="button">
                      <span class="uil uil-eye show"></span>
                      <span class="uil uil-eye-slash hide"></span>
                    </button>
                  </div>
                </div>
              </div>

              <button type="submit" class="btn btn-primary w-100 mb-3">Crear Cuenta</button>
            </form>

            <div class="text-center">
              <span class="fs-9">¿Ya tienes una cuenta? </span>
              <a class="fs-9 fw-bold" href="{{ route('login') }}">Iniciar sesión</a>
            </div>
          </div>
        </div>
      </div>
    </main>

    <script src="/phoenixadmin/vendors/popper/popper.min.js"></script>
    <script src="/phoenixadmin/vendors/bootstrap/bootstrap.min.js"></script>
    <script src="/phoenixadmin/vendors/anchorjs/anchor.min.js"></script>
    <script src="/phoenixadmin/vendors/is/is.min.js"></script>
    <script src="/phoenixadmin/vendors/fontawesome/all.min.js"></script>
    <script src="/phoenixadmin/vendors/lodash/lodash.min.js"></script>
    <script src="/phoenixadmin/vendors/list.js/list.min.js"></script>
    <script src="/phoenixadmin/vendors/feather-icons/feather.min.js"></script>
    <script src="/phoenixadmin/vendors/dayjs/dayjs.min.js"></script>
    <script src="/phoenixadmin/assets/js/phoenix.js"></script>
  </body>

</html>
