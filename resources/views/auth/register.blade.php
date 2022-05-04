@extends('layouts.site')

@section('content')


 <section id="contact" class="contact mt-5">
      <div class="container">

        <div class="section-title">
          <span>Registration</span>
          <h2>Join us here</h2>
          <p>You may work with us in the long run...</p>
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
            
          <form action="{{ route('register') }}" method="post" role="form" class="php-email-form">
            @csrf
            <div class="row">
                <span class="text-primary"> Pesronal information</span>
               <div class="alert-danger rounded"> <x-jet-validation-errors class="mb-4" /></div>
              <div class="form-group col">
                <label for="name"><i class="bx bxs-user text-danger"></i>Full name</label>
                <input type="text" name="name" class="form-control" id="first-name" required>
              </div>
              
            </div>
            <div class="row">
              <div class="form-group col-md-6">
                <label for="email"><i class="bx bxs-envelope text-danger"></i>Email</label>
                <input type="email" name="email" class="form-control" id="email" required>
              </div>
              <div class="form-group col-md-6 mt-3 mt-md-0">
                <label for="phone"><i class="bx bxs-phone text-danger"></i>Phone</label>
                <input type="tel" class="form-control" name="phone" id="phone" required>
              </div>
            </div>


            <div class="form-group mt-2">
              <label for="address"><i class="bx bxs-map text-danger"></i>Address town</label>
              <input type="text" class="form-control" name="address" id="address" required>
            </div>
           
            <hr>
            <span class="text-primary">Credential information</span>
            <div class="row">
              <div class="form-group col-md-6">
                <label for="password"><i class="bx bxs-lock text-danger"></i>New password</label>
                <input type="password" name="password" class="form-control" id="password" required>
              </div>
              <div class="form-group col-md-6 mt-3 mt-md-0">
                <label for="password-confirmation"><i class="bx bxs-lock text-danger"></i>Confirm Password</label>
                <input type="password" class="form-control" name="password_confirmation" id="password-confirmation" required>
              </div>
            </div>
            
           
            <div class="row mx-1"><button class="col-sm-6" type="submit">Join us now</button><a class="col-sm-6 mt-1" href="/login">Already joined us?</a>
            </div>
          </form>
        </div>

      </div>

    </div>
  </section>

@endsection


