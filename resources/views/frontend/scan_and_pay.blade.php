@extends('frontend.layouts.app')
@section('title', 'Scan & Pay')

@section('content')
<div class="scan-and-pay">
    @include('frontend/layouts/flash_msg')
       <div class="card my-card">
           <div class="card-body text-center">
             <div class="text-center">
                <img src="{{asset('frontend/img/scan-and-pay.png')}}" alt="" style="width: 220px;">
             </div>
              <p class="mb-3">Click button, put QR code in the frame and pay.</p>
              <button class="btn btn-theme btn-sm" data-bs-toggle="modal" data-bs-target="#scanModal">Scan</button>
            

  <!-- Scan Modal -->
  <div class="modal fade" id="scanModal" tabindex="-1" aria-labelledby="scanModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="scanModalLabel">Scan & Pay</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <video id="scanner" width="100%" height="240px"></video>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
         
        </div>
      </div>
    </div>
  </div>
            </div>
           
       </div>
    
</div>
@endsection

@section('scripts')
    <script src="{{asset('frontend/js/qr-scanner.umd.min.js')}}"></script>

    <script>
        $(document).ready(function(){
            var videoElem = document.getElementById("scanner");
            const qrScanner = new QrScanner(videoElem, function(result){
               if(result){
                   qrScanner.stop();
                   $('#scanModal').modal('hide');

                   var to_phone = result;
                   window.location.replace(`scan-and-pay-form?to_phone=${to_phone}`);
                  
               }
               //console.log(result);
            });

            var scanModal = document.getElementById('scanModal')
            scanModal.addEventListener('shown.bs.modal', function (event) {
                qrScanner.start();
            })
            scanModal.addEventListener('hidden.bs.modal', function (event) {
                qrScanner.stop();
            })
        });
    </script>
@endsection