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
                <h1 style="color: white">Verify Visitor Pass</h1>
                <div class="div_heading">
                <form id="verify-form">
                        @csrf
                        <input type="text" id="qr-data" placeholder="Scan QR Code">
                        <button type="submit">Verify</button>
                </form>
                <div id="verification-result" style="padding-top: 20px;">

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
        document.getElementById('verify-form').addEventListener('submit', function(e) {
        e.preventDefault();
        
        fetch('/admin/verify-pass', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json',
                'Accept': 'application/json',
            },
            body: JSON.stringify({
                qrData: document.getElementById('qr-data').value
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.valid) {
                document.getElementById('verification-result').innerHTML = `
                    <h3>Valid Pass</h3>
                    <p>Name: ${data.user.name}</p>
                    <p>Email: ${data.user.email}</p>
                `;
            } else {
                console.log(data);
                document.getElementById('verification-result').innerHTML = '<h3>Invalid Pass</h3>';
            }
        });
        });
     </script>
  </body>
</html>