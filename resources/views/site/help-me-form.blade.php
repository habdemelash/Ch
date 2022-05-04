@extends('layouts.site',['myevents'=>$myevents, 'myEventsList'=>$myEventsList])

@section('content')
<link rel="stylesheet" type="text/css" href="{{asset('admin/other/toastr.min.css')}}">
 <section id="contact" class="contact mt-5" style="margin-top: 30px;">
      <div class="container">

        <div class="section-title">
          <span>Help-me form</span>
          <h2>Send us your condtions, we will try our best..</h2>
          <p>We may find helpers as soon as possible</p>
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
              <div class="container-fluid">
               Fill in the form with your problem and helping mechanisms as well, and send it to us. We will try to help you and find helpers.
              </div>

             

            
          </div>

        </div>

        <div class="col-lg-7 mt-5 mt-lg-0 d-flex align-items-stretch">
          <form action="{{route('site.helpme.send')}}" method="POST" class="php-email-form" enctype="multipart/form-data">
            @csrf
            <div class="row">
              @if($errors->any())
              @foreach($errors->all() as $error)
              <div class="alert alert-danger">{{$error}}</div>
              @endforeach

              @endif
              <div class="form-group">
                <label for="name"><i class="bx bxs-user mx-1 text-danger"></i>Full name</label>
                <input type="text" name="name" class="form-control" id="name" required placeholder="Full name*">
              </div>
             
              <div class="form-group col-md-6 mt-3 mt-md-0">
                <label for="name"><i class="bx bxs-envelope mx-1 text-danger"></i>Your email</label>
                <input type="email" class="form-control" name="email" id="email" required placeholder="Email*">
              </div>

              <div class="form-group col-md-6">
              <label for="phone"><i class="bx bxs-phone mx-1 text-danger"></i>Phone</label>
              <input type="tel" class="form-control" name="phone" id="phone" required placeholder="Phone number*">
            </div>
            </div>
            <hr>
            
            <div class="form-group mt-3">
              <label for="name"><i class="bx bx-question-mark mx-1 text-danger"></i>Your problem</label>
              <p><small class="text-primary">Write here the problem as a title..</small></p>
              <input type="text" class="form-control" name="problem_title" id="subject" required placeholder="Problem*">
            </div>

            <div class="form-group mt-3">
              <label for="address"><i class="bx bxs-map mx-1 text-danger"></i>Your address</label>
              <p><small class="text-primary">Write your town/city here..</small></p>
              <input type="text" class="form-control" name="address" id="address" required placeholder="Address*">
            </div>
            <a class="btn btn-success col-2" type="button">Add</a>
              
            <div class="form-group mt-3 realprocode increment">
              
              <label for="document"><i class="bx bxs-file-pdf mx-1 text-danger"></i><i class="bx bxs-image mx-1 text-danger"></i>Your legal document</label>
              <p><small class="text-primary">Your document may be in pdf or image files...It is very mandatory.</small></p>
              <input type="file" class="  form-control-lg" name="document[]" id="document"  placeholder="Document file*" >
            </div>

            <div class="form-group mt-3 clone hide" style="display: none;">
              <div class="realprocode">     
              <div><input type="file" class="form-control-lg" name="document[]"  id="document" placeholder="Document file*">
                <a class="btn btn-danger" type="button">Remove</a>
              </div></div>
            </div>
            
            <div class="form-group mt-3">
              <label for="name"><i class="bx bx-list-plus mx-1 text-danger"></i>Description</label>
              <p><small class="text-primary">Write here in detail about your suffering.</small></p>
              <textarea class="form-control" name="problem_details" rows="6" required placeholder="Details*"></textarea>
            </div>
          
            <div class="text-center"><button type="submit">Send</button></div>

          </form>
        </div>

      </div>

    </div>
  </section>
  <script src="{{ asset('admin/other/jquery-3.6.0.min.js') }}"></script>
  <script src="{{ asset('admin/other/toastr.min.js') }}"></script>
  <script type="text/javascript">
    $(document).ready(function(){
      $(".btn-success").click(function(){
       var  lsthtml = $(".clone").html();
        $(".increment").after(lsthtml);
      });
      $("body").on("click",".btn-danger",function(){
        $(this).parents(".realprocode").remove();
      });
    });
    
  </script>
  @if(Session::has('message'))
  <script type="text/javascript">
    toastr.success("{{Session::get('message')}}");
  </script>
  @endif
@endsection
