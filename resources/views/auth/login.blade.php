
@extends('layouts.site',['myevents'=>$myevents])


@section('content')
<section id="contact" class="contact mt-5">
      <div class="container">

        <div class="section-title">
          <span>Login</span>
          <h2>Login here</h2>
          <p>You are welcome back, as a regular charity and voluntary partner</p>
        </div>

        <div class="row">

          <div class="col-lg-5 d-flex align-items-stretch">
            <div class="info">
              <div class="address">
                <i class="bi bi-geo-alt"></i>
                <h4>Location:</h4>
                <p>Bole, Adama, Ethiopia</p>
              </div>

              <div class="email">
                <i class="bi bi-envelope"></i>
                <h4>Email:</h4>
                <p>info@cvsms.com</p>
              </div>

              <div class="phone">
                <i class="bi bi-phone"></i>
                <h4>Call:</h4>
                <p>+251920763031</p>
              </div>

             

            
          </div>

        </div>

        <div class="col-lg-7 mt-5 mt-lg-0 d-flex align-items-stretch">
          <form action="{{ route('login') }}" method="POST" role="form" class="php-email-form">
            @csrf
            
           


           
            <hr>
            <span class="text-primary">Credential information</span>
            @if($errors->any())
            <div class="alert alert-danger"><x-jet-validation-errors class="mb-4" /></div>
            @endif
            
            <div class="row">
              <div class="form-group col-md-6">
                <label for="email"><i class="bx bxs-envelope text-danger"></i>Email or phone</label>
                <input type="email" name="email" class="form-control" id="email" required :value="old('email')">
              </div>
              <div class="form-group col-md-6 mt-3 mt-md-0">
                <label for="password"><i class="bx bxs-lock text-danger"></i> Password</label>
                <input type="password" class="form-control" name="password" id="password-confirmation" required :value="old('password')">
              </div>
            </div>
            
            
            <div class="text-center"><button type="submit"><i class="bx bxs-log-in text-white mx-1"></i>Login</button> <a href="{{ route('password.request') }}" class="text-primary fw-bold mx-1">Forgot password?</a></div>
            <div><span class="text-info">If you haven't joined us yet, come </span><strong><a href="/join-us">here</a> </strong> <span class="text-info"> please.</span> </div>
          </form>
        </div>

      </div>

    </div>
  </section>

@endsection