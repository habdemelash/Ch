 @extends('layouts.admin')

 <?php $locale = app()->getLocale(); ?>
 @section('content')

     <div class="row d-flex justify-content-center">

         <form action="{{ route('admin.news.add') }}" method="POST" enctype="multipart/form-data">
             @csrf
             <div class="row d-flex justify-content-start">
                 @if (session()->has('message'))
                     <div class="alert alert-success">
                         <i class="bx bx-check bx-md mt-1">{{ session()->get('message') }} </i><br><strong><a
                                 href="{{ route('admin.news') }}"
                                 style="text-decoration: none;">{{ __('home.go_back') }}</a> </strong>
                         {{ __('home.to_the_list') }}
                     </div>
                 @endif
                 @if ($errors->any())
                     <div class="alert alert-danger">

                         @foreach ($errors->all() as $error)
                             <i class="bx bxs-error"></i>{{ $error }}<br>
                         @endforeach
                     </div>
                 @endif

                 @foreach (config('app.languages') as $locale => $value)
                     <div class="form-group mb-3 col-md-4 my-1">
                         <label for="heading-{{ $locale }}"
                             class="text-primary">@lang('home.heading')-{{ strtoupper($value) }}</label>
                         <input type="text" id="heading-{{ $locale }}" class="form-control"
                             name="<?php echo 'heading_' . $locale; ?>" value="{{ old('heading_' . $locale) }}">

                     </div>

                     <div class="form-group my-1 col-md-8">
                         <label for="body-{{ $locale }}"
                             class="text-primary">@lang('home.body')-{{ strtoupper($value) }}</label>
                         <textarea class="form-control" id="body-{{ $locale }}" name="<?php echo 'body_' . $locale; ?>"
                             style="height: 200px;">{{ old('body_' . $locale) }}</textarea>

                     </div>
                 @endforeach








                 <div class="col-md-8 my-1 justify-content-start mx-1 d-flex flex-wrap my-1">
                     <label for="inputCompany5">@lang('home.picture')</label>
                     <label class="col-md-2 btn" for="pic"
                         style="border: solid; border-width: 0.5px; border-color: gray;padding: 3px; border-radius: 5px;">{{ __('home.click_here') }}</label>
                     <label for="pic" id="file-name"
                         onchange="preview_image(event)">{{ __('home.no_file_choosen') }}</label>
                     <input type="file" id="pic" name="@lang('home.picture')" class="form-control-lg col-md-10" accept="image/*"
                         onchange="preview_image(event)" style="display: none;">
                     <span class="text-primary">{{ __('home.a_good_news_pic') }}</span>
                     <img src="{{ asset('site/assets/img/digital_22.jpg') }}" alt="" class="img-thumbnail rounded-circle"
                         width="200" height="200" id="output_image">

                 </div>


                 <script>
                     inputElement = document.getElementById('pic')
                     labelElement = document.getElementById('file-name')
                     inputElement.onchange = function(event) {
                         var path = inputElement.value;
                         if (path) {
                             labelElement.innerHTML = path.split(/(\\|\/)/g).pop()
                         } else {
                             labelElement.innerHTML = 'Bla bla'
                         }
                     }
                 </script>


             </div>





     </div>
     <div class="text-center mt-2 mb-5">

         <button type="submit" class="btn btn-success"><i class="bx bxs-plus-circle bx-md">Save</i></button>
         </form>
     </div>

     <script src="{{ asset('admin/other/jquery-3.6.0.min.js') }}"></script>
     <script src="{{ asset('admin/other/toastr.min.js') }}"></script>
     @include('admin.scripts')
     @if (Session::has('message'))
         <script>
             toastr.success("{!! Session::get('message') !!}");
         </script>
     @endif
     <script type='text/javascript'>
         function preview_image(event) {
             var reader = new FileReader();
             reader.onload = function() {
                 var output = document.getElementById('output_image');
                 output.src = reader.result;
             }
             reader.readAsDataURL(event.target.files[0]);
         }
     </script>



     <script>
         window.dataLayer = window.dataLayer || [];

         function gtag() {
             dataLayer.push(arguments);
         }
         gtag('js', new Date());
         gtag('config', 'UA-56159088-1');
     </script>
     <script>
         inputElement = document.getElementById('pic')
         labelElement = document.getElementById('file-name')
         inputElement.onchange = function(event) {
             preview_image(event);
             var path = inputElement.value;
             if (path) {
                 labelElement.innerHTML = path.split(/(\\|\/)/g).pop()
             } else {
                 labelElement.innerHTML = 'Bla bla'
             }
         }
     </script>
 @endsection
