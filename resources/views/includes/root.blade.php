<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <title>{{env('APP_NAME')}}</title>
      
      <link rel="shortcut icon" href="../assets/images/favicon.ico" />
      <link rel="stylesheet" href="../assets/css/libs.min.css">
      <link rel="stylesheet" href="../assets/css/socialv.css?v=4.0.0">
      <link rel="stylesheet" href="../assets/vendor/@fortawesome/fontawesome-free/css/all.min.css">
      <link rel="stylesheet" href="../assets/vendor/remixicon/fonts/remixicon.css">
      <link rel="stylesheet" href="../assets/vendor/vanillajs-datepicker/dist/css/datepicker.min.css">
      <link rel="stylesheet" href="../assets/vendor/font-awesome-line-awesome/css/all.min.css">
      <link rel="stylesheet" href="../assets/vendor/line-awesome/dist/line-awesome/css/line-awesome.min.css">
      <script src="/assets/js/vue.global.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
      <script>
        const token = "{{session('api_token')}}";
        const config = {headers: { Authorization: `Bearer ${token}` } };
        function showAlert(message, alertClass)
        {
            let alertDialog = document.getElementById("alertDialog");
            document.getElementById("alertMessage").innerText = message;
            alertDialog.classList.add('show');
            alertDialog.classList.add('alert-' + alertClass);
            setTimeout(() => {
                alertDialog.classList.remove('show');
            }, 5000);
        }

        axios.interceptors.response.use(
          response => {
            if (response.data && response.data.message) {
              showAlert(response.data.message, 'success');
            }
            return response;
          },
          error => {
            const msg = error.response?.data?.error || 'Something went wrong!';
            showAlert(msg, 'danger');
            return Promise.reject(error);
          }
        );
    </script>
  </head>
  <body id="app">
    <!-- loader Start -->
    <div id="loading">
          <div id="loading-center">
          </div>
    </div>

    <div style="position: fixed; top: 20px; right: 20px; z-index: 9999; min-width: 250px;">
      <div class="alert alert-solid alert-dismissible fade" id="alertDialog" role="alert">
        <span id="alertMessage"></span>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
      </div>
    </div>

    @yield('main')
  </body>
</html>