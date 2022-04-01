<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
  
    {{--Bootstrap css --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
   
   
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    {{--google fonts - opens san --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{asset('frontend/css/style.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.0/css/all.min.css" integrity="sha512-10/jx2EXwxxWqCLX/hHth/vu2KY3jCF70dCQB8TSgNjbCVAC/8vai53GfMDrO2Emgwccf2pJqxct9ehpzG+MTw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    @yield('extra_css')

    <title>@yield('title')</title>

    
    
</head>
<body>
    <div id="app">

        <div class="header-menu">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="row">
                        <div class="col-2 text-center">
                          @if(!request()->is('/home'))
                            <a href="#" class="back-btn">
                                <i class="fas fa-angle-left"></i>
                            </a>
                          @endif
                        </div>
                        <div class="col-8 text-center"> 
                              
                                <h3>@yield('title')</h3>
                            
                        </div>
                        <div class="col-2 text-center">
                           <a href="">
                                <i class="fas fa-bell"></i>
                           </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="content">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    @yield('content')
                </div>
            </div>
        </div>

        <div class="bottom-menu">
            <a href="" class="scan-tab">
                <div class="inside">
                    <i class="fas fa-qrcode"></i>
                </div>
            </a>
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="row">
                        <div class="col-3 text-center">
                            <a href="{{route('home')}}">
                                <i class="fas fa-home"></i>
                                <p>Home</p>
                            </a>
                        </div>
                        <div class="col-3 text-center"> 
                            <a href="{{route('wallet')}}">
                                <i class="fas fa-wallet"></i>
                                <p >Wallet</p>
                            </a>
                        </div>
                        <div class="col-3 text-center"> 
                            <a href="{{url('transaction')}}">
                                <i class="fas fa-exchange-alt"></i>
                                <p >Transication</p>
                            </a>
                        </div>
                        <div class="col-3 text-center">
                           <a href="{{route('profile')}}">
                                <i class="fas fa-user"></i>
                                <p>Account</p>
                           </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    
{{--Bootstrap js --}}
   <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
   <script src="https://code.jquery.com/jquery-3.5.1.js"></script>

    <!-- Infinite scrool for pagination - jScrool -->
    <script src="{{asset('frontend/js/jScrool.min.js')}}"></script>
    <!-- Sweet alert 2 -->
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>


  <script>
    $(document).ready(function(){

        let token = document.head.querySelector('meta[name="csrf-token"]');
        if(token){
            $.ajaxSetup({
                headers : {
                    'X-CSRF_TOKEN' : token.content,
                    'Content-Type' : 'application/json',
                    'Accept' : 'application/json'
                }
            });
        }


        $('.back-btn').on('click', function(e){
            e.preventDefault();
            window.history.go(-1);
            return false;
        })
        // Using sweetalert2

        const Toast = Swal.mixin({
  toast: true,
  position: 'top-end',
  showConfirmButton: false,
  timer: 3000,
  timerProgressBar: true,
  didOpen: (toast) => {
    toast.addEventListener('mouseenter', Swal.stopTimer)
    toast.addEventListener('mouseleave', Swal.resumeTimer)
  }
})

   @if(session('create'))
        Toast.fire({
            icon: 'success',
            title: '{{session('create')}}'
            })
   @endif

   @if(session('update'))
        Toast.fire({
            icon: 'success',
            title: '{{session('update')}}'
            })
   @endif

});

</script>


       @yield('scripts')
</body>
</html>
