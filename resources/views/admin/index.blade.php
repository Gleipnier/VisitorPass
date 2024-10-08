<!DOCTYPE html>
<html>
  <head> 
    @include('admin.css')
    <style>
        .div_heading {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: 20px;
        }
    </style>
  </head>
  <body>
    @include('admin.header')


    @include('admin.sidebar')
      <!-- Sidebar Navigation end-->
      <div class="page-content">
        <div class="page-header">
          <div class="container-fluid">

            {{-- @include('admin.body') --}}
            <div class="div_heading">

              <div class="container">
                <h1>Admin Dashboard</h1>
                <a href="{{ route('admin.scanner') }}" class="btn btn-primary">QR Scanner</a>
                <a href="{{ route('admin.statistics') }}" class="btn btn-secondary">Visit Statistics</a>
            </div>

            </div>
          </div>
      </div>
    </div>
    <!-- JavaScript files-->
    <script src="{{asset('/admincss/vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('/admincss/vendor/popper.js/umd/popper.min.js')}}"> </script>
    <script src="{{asset('/admincss/vendor/bootstrap/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('/admincss/vendor/jquery.cookie/jquery.cookie.js')}}"> </script>
    <script src="{{asset('/admincss/vendor/chart.js/Chart.min.js')}}"></script>
    <script src="{{asset('/admincss/vendor/jquery-validation/jquery.validate.min.js')}}"></script>
    <script src="{{asset('/admincss/js/charts-home.js')}}"></script>
    <script src="{{asset('/admincss/js/front.js')}}"></script>
    <script>
      fetch('/admin/visit-stats')
        .then(response => response.json())
        .then(data => {
            let statsHtml = '<table class="table"><thead><tr><th>Date</th><th>Visits</th></tr></thead><tbody>';
            data.forEach(stat => {
                statsHtml += `<tr><td>${stat.date}</td><td>${stat.count}</td></tr>`;
            });
            statsHtml += '</tbody></table>';
            document.getElementById('stats').innerHTML = statsHtml;
        });
    </script>
  </body>
</html>