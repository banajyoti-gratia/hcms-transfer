@include('layouts.head')
{{-- @section('custom-head') --}}
<style>
    /* CSS */
.button-71 {
  background-color: #0078d0;
  border: 0;
  border-radius: 56px;
  color: #fff;
  cursor: pointer;
  display: inline-block;
  font-family: system-ui,-apple-system,system-ui,"Segoe UI",Roboto,Ubuntu,"Helvetica Neue",sans-serif;
  font-size: 18px;
  font-weight: 600;
  outline: 0;
  padding: 16px 21px;
  position: relative;
  text-align: center;
  text-decoration: none;
  transition: all .3s;
  user-select: none;
  -webkit-user-select: none;
  touch-action: manipulation;
}

.button-71:before {
  background-color: initial;
  background-image: linear-gradient(#fff 0, rgba(255, 255, 255, 0) 100%);
  border-radius: 125px;
  content: "";
  height: 50%;
  left: 4%;
  opacity: .5;
  position: absolute;
  top: 0;
  transition: all .3s;
  width: 92%;
}

.button-71:hover {
  box-shadow: rgba(255, 255, 255, .2) 0 3px 15px inset, rgba(0, 0, 0, .1) 0 3px 5px, rgba(0, 0, 0, .1) 0 10px 13px;
  transform: scale(1.05);
}


</style>
{{-- @endsection --}}
<body>
    @include('layouts.header')
    @include('layouts.sidebar')
    
    <main id="main" class="main">
        <div class="row d-flex justify-content-center py-5">
            <div class="col-md-6">
                <div class="card shadow-lg p-3 mb-5 bg-body rounded">
                    <div class="card-body">
                        <h3 class="card-title" style="text-align: center;font-size:35px">Transfer</h5>
                        <p class="card-text" style="text-align: center"><a href="transfer-dashboard" class=""><img src="{{ asset('assets/img/blue.png') }}" alt="" width="150" height="150"></a></p><br>
                        <p class="card-text" style="text-align: center"><a href="transfer-dashboard" class="button-71">Click Here</a></p>
                        
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card shadow-lg p-3 mb-5 bg-body rounded">
                    <div class="card-body">
                        <h3 class="card-title" style="text-align: center;font-size:35px">Transfer</h5>
                            <p class="card-text" style="text-align: center"><img src="{{ asset('assets/img/transfer.png') }}" alt="" width="150" height="150"></p><br>
                            <p class="card-text" style="text-align: center"><a href="#" class="button-71">Click Here</a></p>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body><br><br><br><br>
@include('layouts.footer')