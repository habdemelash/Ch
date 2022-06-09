<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="favicon.ico">
    <title>Profile Management</title>
    <!-- Simple bar CSS -->
    <link rel="stylesheet" href="{{ asset('profile/css/simplebar.css') }}">
    <link href="{{ asset('admin/css/bootstrap.min.css') }}" rel="stylesheet">
    <link rel="icon" type="image/png" href="{{asset('site/assets/img/3dheart.png')}}">
    <!-- Fonts CSS -->
    <link
        href="https://fonts.googleapis.com/css2?family=Overpass:ital,wght@0,100;0,200;0,300;0,400;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <!-- Icons CSS -->
    <link rel="stylesheet" href="{{ asset('profile/css/feather.css') }}">
    <!-- Date Range Picker CSS -->
    <link href="{{ asset('site/assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('site/assets/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
    <!-- App CSS -->
    <link rel="stylesheet" href="{{ asset('profile/css/app-light.css') }}" id="lightTheme">
    <link rel="stylesheet" href="{{ asset('profile/css/app-dark.css') }}" id="darkTheme" disabled>
   
</head>

<body class="vertical  light rtl ">
    <div class="wrapper">
        <nav class="topnav navbar navbar-light">

            <ul class="nav">

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-muted pr-0" href="#" id="navbarDropdownMenuLink"
                        role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="avatar avatar-sm mt-2">
                            <img src="{{ asset('uploads/profile-photos') }}/{{ $my->profile_photo_path }}" alt="..."
                                class="avatar-img rounded-circle">
                        </span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item text-primary h5" href="{{ route('site.home') }}"><i
                                class="bx bxs-lock"></i> @lang('home.site')</a>
                        <a class="dropdown-item text-danger h5" href="{{ route('logout') }}"><i
                                class="bx bxs-lock"></i> @lang('home.logout')</a>


                    </div>
                </li>

            </ul>
        </nav>


        <main role="main" class="main-content">
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col">
                        <h2 class="h3 mb-4 page-title">@lang('home.profile_dashboard')</h2>
                        <div class="my-4">

                            <form action="{{ route('update.profile') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row mt-5 align-items-center">
                                    <div class="col-md-3 text-center mb-5">
                                        <div class="avatar avatar-xl">
                                            <img src="{{ asset('uploads/profile-photos') }}/{{ $my->profile_photo_path }}"
                                                alt="{{ asset('site/assets/img/user.jpg') }}"
                                                class="avatar-img rounded-circle">
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="row align-items-center">
                                            <div class="col-md-7">
                                                <h4 class="mb-1">{{ $my->name }}</h4>
                                                <p class="small mb-3"><span
                                                        class="badge badge-primary">{{ $my->address }}</span></p>
                                            </div>
                                        </div>
                                        <div class="row mb-4">
                                            <div class="col-md-7">

                                            </div>
                                            <div class="col">

                                                <p class="small mb-0 ">{{ $my->phone }} @ {{ $my->address }}
                                                </p>
                                                <p class="small mb-0 ">{{ $my->email }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr class="my-4">
                                @if ($errors->any())
                                    <div class="alert alert-danger col-md-6">
                                        @foreach ($errors->all() as $error)
                                            <li class="text-danger">{{ $error }}</li>
                                        @endforeach
                                    </div>

                                @endif
                                @if (Session::has('message'))
                                    <div class="alert alert-success">{{ Session::get('message') }}</div>
                                @endif

                                <div class="form-row">

                                    <div class="form-group col-md-6">


                                        <label for="name">@lang('home.full_name')</label>
                                        <input type="text" id="name" class="form-control"
                                            placeholder="@lang('home.full_name')" name="name" value="{{ $my->name }}">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="phone">@lang('home.phone')</label>
                                        <input type="tel" id="lastname" class="form-control" placeholder=""
                                            name="phone" value="{{ $my->phone }}">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="inputEmail4">@lang('home.email')</label>
                                        <input type="email" name="email" class="form-control" id="inputEmail4"
                                            value="{{ $my->email }}">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="inputAddress5">@lang('home.location')</label>
                                        <input type="text" name="address" class="form-control" id="inputAddress5"
                                            value="{{ $my->address }}" style="padding-bottom: 15px; border-style:solid">
                                    </div>

                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="inputCompany5">@lang('home.photo')</label>
                                        
                                        
                                        <input type="file" id="input02" name="profile_photo_path"
                                            class="form-control-lg col-md-10" accept="image/*"
                                            onchange="preview_image(event)" style="display: none;">
                                            

                                    </div>
                                    
                                    <div class="form-group col-md-4">
                                        <label for="inputState5">@lang('home.new_photo')</label>
                                        <img src="{{ asset('uploads/profile-photos') }}/{{ $my->profile_photo_path }}"
                                            alt="{{ $my->name }}" class="img-thumbnail rounded-circle" width="150"
                                            height="150" id="output_image">

                                    </div>

                                </div>
                                <hr class="my-4">
                                <div class="row mb-4">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <span class="text-info">@lang('home.credential_info')</span><br>
                                            <label for="inputPassword4">@lang('home.old_password')</label>
                                            <input type="password" class="form-control" id="inputPassword5"
                                                name="old_password" readonly onfocus="this.removeAttribute('readonly');"
                                                value="">
                                        </div>
                                        <div class="form-group">
                                            <label for="inputPassword5">@lang('home.new_password')</label>
                                            <input type="password" class="form-control" id="inputPassword5"
                                                name="password" readonly onfocus="this.removeAttribute('readonly');">
                                        </div>
                                        <div class="form-group">
                                            <label for="inputPassword6">@lang('home.password_confirm')</label>
                                            <input type="password" class="form-control" id="inputPassword6"
                                                name="password_confirmation" readonly
                                                onfocus="this.removeAttribute('readonly');">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <p class="mb-2">@lang('home.password_reqs')</p>

                                        <ul class="small text-info pl-4 mb-0">
                                            <li> @lang('home.min_six') </li>

                                        </ul>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary">@lang('home.save_change')</button>
                                <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                    data-bs-target="#deleteMe">@lang('home.delete_profile')
                                </button>

                            </form>

                            <div class="modal fade" id="deleteMe" tabindex="-1" aria-labelledby="ModalLabel"
                                aria-hidden="true">
                                <div class="modal-dialog">
                                    <form action="{{ url('/profile/delete') }}" method="GET">
                                        @csrf
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title text-danger" id="ModalLabel">
                                                    {{ __('home.delete_profile') }}</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <p class="fw-bold">{{ __('home.do_u_delete_profile') }}</p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">{{ __('home.no') }}</button>
                                                <button type="submit" class="btn btn-danger"
                                                    data-bs-dismiss="modal">{{ __('home.yes_delete') }}</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div> <!-- /.card-body -->
                    </div> <!-- /.col-12 -->
                </div> <!-- .row -->
            </div> <!-- .container-fluid -->


        </main> <!-- main -->
    </div> <!-- .wrapper -->
    <script src="{{ asset('admin/js/app.js') }}"></script>
    <script src="{{ asset('admin/other/jquery-3.6.0.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('admin/other/popper.min.js') }}"></script>
    <script src="{{ asset('admin/other/bootstrap.bundle.min.js') }}"></script>
    {{-- <script type="text/javascript" src="{{asset('filestyle/src/bootstrap-filestyle.js')}}"></script> --}}
    <script type="text/javascript" src="{{asset('filestyle/src/bootstrap-filestyle.min.js')}}"></script>
    <script>$('#input02').filestyle({
        buttonText: '<i class="bi-file-image" style="color:green; font-size:20px;"></i>'
    });
    </script>
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


    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-56159088-1"></script>
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
    
</body>

</html>
