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

            <div class="div_heading">

                <div class="container">
                        <h1>QR Code Scanner</h1>
                        <div id="reader"></div>
                        <div id="result"></div>
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
    <script src="https://unpkg.com/html5-qrcode"></script>
    <script>
      function onScanSuccess(decodedText, decodedResult) {
    // Handle the scanned code as you like, for example:
    console.log(`Code matched = ${decodedText}`, decodedResult);
    document.getElementById('result').textContent = decodedText;
    
    // Send the scanned data to the server
    fetch('/admin/verify-pass', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({ qrData: decodedText })
    })
    .then(response => response.json())
    .then(data => {
        if (data.valid) {
            alert(`Valid pass for ${data.user.name}. Action: ${data.action}`);
        } else {
            alert('Invalid pass');
        }
    });
}

let html5QrcodeScanner = new Html5QrcodeScanner(
    "reader",
    { fps: 10, qrbox: {width: 250, height: 250} },
    /* verbose= */ false
);
html5QrcodeScanner.render(onScanSuccess);
    </script>
  </body>
</html>