@extends('layouts.admin')
@section('content')
    @include('admin.styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/other/toastr.min.css') }}">
    <div class="row d-flex justify-content-center">

        <form action="{{ route('admin.event.add') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row d-flex justify-content-start">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                            <i class="bx bxs-error"></i>{{ $error }}<br>
                        @endforeach
                    </div>
                @endif
                @if (session()->has('message'))
                    <div class="alert alert-success">
                        <i class="bx bx-check bx-md mt-1">{{ session()->get('message') }} </i><br><strong><a
                                href="{{ route('admin.events') }}"
                                style="text-decoration: none;">{{ __('home.go_back') }}</a> </strong>
                        {{ __('home.to_the_list') }}
                    </div>
                @endif
                @foreach (config('app.languages') as $locale => $value)
                    <div class=" mb-3 col-md-4 my-1">
                        <label for="title">{{ __('home.title') . '-' . $value }}</label>
                        <input type="text" class="form-control" name="{{ 'title_' . $locale }}"
                            value="{{ old('title_' . $locale) }}">
                    </div>
                    <div class=" col-md-8 my-1">
                        <label for="short_desc">{{ __('home.short_desc') . '-' . $value }}</label>
                        <input type="text" class="form-control" name="{{ 'short_desc_' . $locale }}"
                            value="{{ old('short_desc_' . $locale) }}">
                    </div>
                    <div class=" col-md-4 my-1">
                        <label for="location">{{ __('home.location') . '-' . $value }}</label>
                        <input type="text" class="form-control" name="{{ 'location_' . $locale }}"
                            value="{{ old('location_' . $locale) }}">
                    </div>
                    <div class=" my-1 col-md-8">
                        <label for="details">{{ __('home.details') . '-' . $value }}</label>
                        <textarea class="form-control" name="{{ 'details_' . $locale }}"
                            style="height: 100px;">{{ old('details_' . $locale) }}</textarea>
                    </div>
                    <hr>
                @endforeach
                <div class=" mb-3 col-md-4 my-1">
                    <label for="needed_vols">{{ __('home.needed_vols') }}</label>
                    <input type="number" class="form-control" name="needed_vols" value="{{ old('needed_vols') }}"
                        min="1">
                </div>
                @if (app()->getLocale() == 'am')
                    <div class=" col-md-2 my-1">
                        <label for="start_time">{{ __('home.start_time') }}</label>
                        <input readonly id="" class="form-control amharic-start-time" name="start_time"
                            autocomplete="off" />
                    </div>
                    <div class=" col-md-2 my-1">
                        <label for="end_time">{{ __('home.end_time') }}</label>
                        <input readonly id="" class="form-control amharic-end-time" name="end_time" autocomplete="off" />
                    </div>
                    <div class=" col-md-4 my-1">
                        <label for="due_date">{{ __('home.date') }}</label>
                        <input readonly class="form-control" type="text" name="due_date" id="amharic" autocomplete="off">
                    </div>
                    {{-- Amharic datetime ends --}}
                    {{-- Oromic date time input begins here --}}
                @elseif(app()->getLocale() == 'or')
                    <div class=" col-md-2 my-1">
                        <label for="start_time">{{ __('home.start_time') }}</label>
                        <input readonly id="" class="form-control oromic-start-time" name="start_time" />
                    </div>
                    <div class=" col-md-2 my-1">
                        <label for="end_time">{{ __('home.end_time') }}</label>
                        <input readonly id="" class="form-control oromic-end-time" name="end_time" />
                    </div>
                    <div class=" col-md-4 my-1">
                        <label for="due_date">{{ __('home.date') }}</label>
                        <input readonly class="form-control" type="text" name="due_date" id="oromic" autocomplete="off">
                    </div>
                    {{-- Oromic date time input ends here --}}
                @else
                    <div class=" col-md-2 my-1">
                        <label for="start_time">{{ __('home.start_time') }}</label>
                        <input readonly id="" class="form-control english-start-time" name="start_time" />
                    </div>
                    <div class=" col-md-2 my-1">
                        <label for="end_time">{{ __('home.end_time') }}</label>
                        <input readonly id="" class="form-control english-end-time" name="end_time" />
                    </div>
                    <div class=" col-md-4 my-1">
                        <label for="due_date">{{ __('home.date') }}</label>
                        <input readonly class="form-control" type="text" name="due_date" id="gregorian"
                            autocomplete="off">
                    </div>
                @endif
                <div class="col-md-8 my-1 justify-content-start mx-1 d-flex flex-wrap my-1">
                    <label for="inputCompany5">@lang('home.photo')</label>
                    <label class="col-md-2 btn" for="pic"
                        style="border: solid; border-width: 0.5px; border-color: gray;padding: 3px; border-radius: 5px;">{{ __('home.click_here') }}</label>
                    <label for="pic" id="file-name"
                        onchange="preview_image(event)">{{ __('home.no_file_choosen') }}</label>
                    <input type="file" id="pic" name="picture" class="form-control-lg col-md-10" accept="image/*"
                        onchange="preview_image(event)" style="display: none;">
                    <span class="text-primary">{{ __('home.a_good_event_pic') }}</span>
                    <img src="{{ asset('site/assets/img/digital_22.jpg') }}" alt="" class="img-thumbnail rounded-circle"
                        width="200" height="200" id="output_image">
                </div>
            </div>
    </div>
    <div class="text-center mt-2 mb-5">
        <button type="submit" class="btn btn-success"><i
                class="bx bxs-plus-circle bx-md">{{ __('home.save') }}</i></button>
        </form>
    </div>
    <script src="{{ asset('admin/other/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('admin/other/toastr.min.js') }}"></script>
    @include('admin.scripts')
    <script>
        @if (Session::has('message'))
            toastr.success("{{ Session::get('message') }}");
        @endif
    </script>
    {{--  --}}
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
