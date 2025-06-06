<!DOCTYPE html>
<html class="h-full" data-theme="true" data-theme-mode="light" dir="ltr" lang="en">
 <head><base href="../../">
  <title>
   @yield('title') - Wargalima CMS
  </title>
  <meta charset="utf-8"/>
  <meta content="follow, index" name="robots"/>
  <link href="https://127.0.0.1:8001/metronic-tailwind-html/demo1/index.html" rel="canonical"/>
  <meta content="width=device-width, initial-scale=1, shrink-to-fit=no" name="viewport"/>
  <meta content="" name="description"/>
  <meta content="@keenthemes" name="twitter:site"/>
  <meta content="@keenthemes" name="twitter:creator"/>
  <meta content="summary_large_image" name="twitter:card"/>
  <meta content="Metronic - Tailwind CSS " name="twitter:title"/>
  <meta content="" name="twitter:description"/>
  <meta content="assets/media/app/og-image.png" name="twitter:image"/>
  <meta content="https://127.0.0.1:8001/metronic-tailwind-html/demo1/index.html" property="og:url"/>
  <meta content="en_US" property="og:locale"/>
  <meta content="website" property="og:type"/>
  <meta content="@keenthemes" property="og:site_name"/>
  <meta content="Metronic - Tailwind CSS " property="og:title"/>
  <meta content="" property="og:description"/>
  <meta content="assets/media/app/og-image.png" property="og:image"/>
  <link href="{{ url('') }}/assets/fontawesome/css/fontawesome.css" rel="stylesheet" />
  <link href="{{ url('') }}/assets/fontawesome/css/brands.css" rel="stylesheet" />
  <link href="{{ url('') }}/assets/fontawesome/css/solid.css" rel="stylesheet" />
  <link href="{{url('')}}/assets/media/app/apple-touch-icon.png" rel="apple-touch-icon" sizes="180x180"/>
  <link href="{{url('')}}/assets/media/app/favicon-32x32.png" rel="icon" sizes="32x32" type="image/png"/>
  <link href="{{url('')}}/assets/media/app/favicon-16x16.png" rel="icon" sizes="16x16" type="image/png"/>
  <link href="{{url('')}}/assets/media/app/favicon.ico" rel="shortcut icon"/>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet"/>
  <link href="{{url('')}}/assets/vendors/apexcharts/apexcharts.css" rel="stylesheet"/>
  <link href="{{url('')}}/assets/vendors/keenicons/styles.bundle.css" rel="stylesheet"/>
  <link href="{{url('')}}/assets/css/styles.css" rel="stylesheet"/>
  @vite('resources/css/app.scss')
 </head>
 <body class="antialiased flex h-full text-base text-gray-700 [--tw-page-bg:#fefefe] [--tw-page-bg-dark:var(--tw-coal-500)] demo1 sidebar-fixed header-fixed bg-[--tw-page-bg] dark:bg-[--tw-page-bg-dark]">
  <!-- Theme Mode -->
  <script>
   const defaultThemeMode = 'light'; // light|dark|system
		let themeMode;

		if ( document.documentElement ) {
			if ( localStorage.getItem('theme')) {
					themeMode = localStorage.getItem('theme');
			} else if ( document.documentElement.hasAttribute('data-theme-mode')) {
				themeMode = document.documentElement.getAttribute('data-theme-mode');
			} else {
				themeMode = defaultThemeMode;
			}

			if (themeMode === 'system') {
				themeMode = window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light';
			}

			document.documentElement.classList.add(themeMode);
		}
  </script>
  <!-- End of Theme Mode -->
  <!-- Page -->
  <!-- Main -->
  <div class="flex grow">
   <!-- Sidebar -->
   @include('layouts.partials.sidebar')
   <!-- End of Sidebar -->
   <!-- Wrapper -->
   <div class="wrapper flex grow flex-col">
    <!-- Header -->
    @include('layouts.partials.header')
    <!-- End of Header -->
    <!-- Content -->
    @yield('content')
    <!-- End of Content -->
    <!-- Footer -->
    @include('layouts.partials.footer')
    <!-- End of Footer -->
   </div>
   <!-- End of Wrapper -->
  </div>
  <!-- End of Main -->
  <!-- End of Page -->
  <!-- Scripts -->
  <script src="{{ url('') }}/assets/js/core.bundle.js">
  </script>
  <script src="{{ url('') }}/assets/vendors/apexcharts/apexcharts.min.js">
  </script>
  <script src="{{ url('') }}/assets/js/widgets/general.js">
  </script>
  <script src="{{ url('') }}/assets/js/layouts/demo1.js">
  </script>
  <script src="{{ url('') }}/assets/js/jquery/jquery3.7.1.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script>
    const Toast = Swal.mixin({
      toast: true,
      position: "top-end",
      showConfirmButton: false,
      timer: 3000,
      timerProgressBar: true,
      didOpen: (toast) => {
        toast.onmouseenter = Swal.stopTimer;
        toast.onmouseleave = Swal.resumeTimer;
      }
    });
  </script>
  @if (session('status'))
    <script>
      Toast.fire({
        icon: '{{ session('status') }}',
        title: '{{ session('message') }}'
      });
    </script>
  @endif
  @stack('scripts')
  <!-- End of Scripts -->
  @vite('resources/js/app.js')
 </body>
</html>