<!DOCTYPE html>
<html lang="en-US" dir="ltr" data-navigation-type="default" data-navbar-horizontal-shape="default">

  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Laravel') }}</title>

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

    @livewireStyles
    @stack('styles')

    <link href="/phoenixadmin/assets/css/theme.min.css" type="text/css" rel="stylesheet" id="style-default">

    @vite(['resources/js/app.js'])

  </head>

  <body>
    <main class="main" id="top">

      <nav class="navbar navbar-top fixed-top navbar-expand" id="navbarDefault">
        <div class="collapse navbar-collapse justify-content-between">

          <div class="navbar-nav navbar-nav-icons flex-row">
            <li class="nav-item">
              <div class="theme-control-toggle fa-icon-wait px-2">
                <input class="form-check-input ms-0 theme-control-toggle-input" type="checkbox" data-theme-control="phoenixTheme" value="dark" id="themeControlToggle"/>
                <label class="mb-0 theme-control-toggle-label theme-control-toggle-light" for="themeControlToggle" data-bs-toggle="tooltip" data-bs-placement="left" data-bs-title="Cambiar tema" style="height:32px;width:32px;">
                  <span class="icon" data-feather="moon"></span>
                </label>
                <label class="mb-0 theme-control-toggle-label theme-control-toggle-dark" for="themeControlToggle" data-bs-toggle="tooltip" data-bs-placement="left" data-bs-title="Cambiar tema" style="height:32px;width:32px;">
                  <span class="icon" data-feather="sun"></span>
                </label>
              </div>
            </li>
          </div>

          <ul class="navbar-nav navbar-nav-icons flex-row">
            <li class="nav-item dropdown">
              <a class="nav-link lh-1 pe-0" id="navbarDropdownUser" href="#!" role="button" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-haspopup="true" aria-expanded="false">
                <div class="avatar avatar-l">
                  <img class="rounded-circle" src="/phoenixadmin/assets/img/team/avatar.webp" alt="" />
                </div>
              </a>
              <div class="dropdown-menu dropdown-menu-end navbar-dropdown-caret py-0 dropdown-profile shadow border" aria-labelledby="navbarDropdownUser">
                <div class="card position-relative border-0">
                  <div class="card-body p-0">
                    <div class="text-center pt-4 pb-3">
                      <div class="avatar avatar-xl">
                        <img class="rounded-circle" src="/phoenixadmin/assets/img/team/avatar.webp" alt="" />
                      </div>
                      <h6 class="mt-2 text-body-emphasis">{{ auth()->user()->name }}</h6>
                    </div>
                  </div>
                  <div class="card-footer p-0 border-top border-translucent">
                    <div class="my-3">
                      <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <div class="px-3">
                          <button type="submit" class="btn btn-phoenix-secondary d-flex flex-center w-100">
                            <span class="me-2" data-feather="log-out"></span>Finalizar Sesión
                          </button>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </li>
          </ul>

        </div>
      </nav>

      <div class="content">

        {{ $slot }}

        <footer class="footer position-absolute">
            <div class="row g-0 justify-content-between align-items-center h-100">
                <div class="col-12 col-sm-auto text-center">
                <p class="mb-0 mt-2 mt-sm-0 text-body">Chat FISI<span class="d-none d-sm-inline-block mx-1">|</span><br class="d-sm-none" />2025 &copy; EDADO</p>
                </div>
                <div class="col-12 col-sm-auto text-center">
                <p class="mb-0 text-body-tertiary text-opacity-85">v1.0</p>
                </div>
            </div>
        </footer>

      </div>

    </main>

    @livewireScripts
    @stack('scripts')

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
