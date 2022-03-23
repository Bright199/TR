<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>TREnglish</title>
  <link rel="icon" href="{{ asset('images/Logo.png') }}">

  <!-- Scripts -->
  <script src="{{ asset('js/app.js') }}" defer></script>


  <!-- Fonts -->
  <link rel="dns-prefetch" href="//fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

  <!-- Styles -->
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

  {{-- JQuery --}}
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"
    integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

  {{-- font awesome --}}
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>

<body>


  
  <div>
    <div class="container-jumbotron shadow-sm py-3">
      <div class="row">
        <div class="col-md-4 ms-3">
          <a href="/student/book/demo/lesson/{{$teacherDetails->id}}" class="DashboardClass">
            <i class="fa-solid fa-angle-left"></i>
            &nbsp;Calendar
          </a>
        </div>
        <div class="col-md-7">
          <ul class="d-flex CrumbContainer">
            <li class="text-center">1. Select time</li>
            <li class="text-center">
              <i class="fa-solid fa-angle-right"></i>
            </li>
            <li class="text-center activeCrumb">2. Make a payment</li>
            <li class="text-center">
              <i class="fa-solid fa-angle-right"></i>
            </li>
            <li class="text-center">3. Prepare your lesson</li>
          </ul>
        </div>
      </div>
    </div>
  </div>

  {{--Trial lesson Details  --}}
  <div class="container-jumbotron body">
    <div class="container">
      <div class="row">
        <div class="col-md-4 bg-white p-0 me-5 " style="border-top-right-radius: 7px;border-top-left-radius: 7px">
          <div class="container-jumbotron border-bottom p-3">
            @if ($teacherDetails->teacher_image !==null)
              <img src="{{asset('images/'.$teacherDetails->teacher_image)}}" alt="" width="50" height="50" style="border-radius: 50%; padding:2px">  
            @else
                <img src="{{asset('images/avatar.png')}}" alt="" width="50" height="50" style="border-radius: 50%; padding:2px">
            @endif
            {{$teacherDetails->name}}
            {{$teacherDetails->first_language}}
          </div>
          <div class="container-jumbotron ">
            {{$trialLessonDetails}}
          </div>
        </div>
        <div class="col-md-7 bg-white p-0" style="border-top-right-radius: 7px;border-top-left-radius: 7px">
          <div class="container-jumbotron border-bottom p-3">
            <h4 class="d-flex justify-content-center">Payment details</h4>
          </div>
          <div class="container">
            <div class="row">
              <div class="col-md-4"></div>
              <div class="col-md-4">
                <div id="smart-button-container">
                  <div style="text-align: center;">
                    <div id="paypal-button-container"></div>
                  </div>
                </div>
              </div>
              <div class="col-md-4"></div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  {{-- end --}}
  </div>
  <div>



    <script src="https://www.paypal.com/sdk/js?client-id=sb&enable-funding=venmo&currency=USD"
      data-sdk-integration-source="button-factory"></script>
    <script src="{{ mix('js/app.js') }}" defer></script>
    <script>
      function initPayPalButton() {
        paypal.Buttons({
          style: {
            shape: 'rect',
            color: 'gold',
            layout: 'vertical',
            label: 'pay',
            height: 30
            
          },
    
          createOrder: function(data, actions) {
            return actions.order.create({
              purchase_units: [{"amount":{"currency_code":"USD","value":100}}]
            });
          },
    
          onApprove: function(data, actions) {
            return actions.order.capture().then(function(orderData) {
              
              // Full available details
              console.log('Capture result', orderData, JSON.stringify(orderData, null, 2));
    
              // Show a success message within this page, e.g.
              const element = document.getElementById('paypal-button-container');
              element.innerHTML = '';
              element.innerHTML = '<h3>Thank you for your payment!</h3>';
    
             actions.redirect('http://localhost:8000/student/dashboard');
              
            });
          },
    
          onError: function(err) {
            console.log(err);
          }
        }).render('#paypal-button-container');
      }
      initPayPalButton();
    </script>
</body>

</html>
<style scoped>
  body {
    color: #183153;
  }
  .body{
    background-color: #e7ebe7;
    padding: 25px;
    min-height: 800px;
    height: 100%;
  }

  .activeCrumb {
    font-weight: 550;
    list-style: none;
    margin-right: 10px;
  }

  .CrumbContainer li:not(.activeCrumb) {
    list-style: none;
    margin-right: 10px;
    color: #79787c;
  }

  .CrumbContainer {
    flex-wrap: wrap;
  }

  .fa-angle-left {
    color: #fec107;
  }

  .DashboardClass {
    font-size: 18px;
    color: #151419;
    text-decoration: none;
  }
</style>