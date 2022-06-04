@extends('layouts.admin')
@section('content')
    @include('admin.styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/other/toastr.min.css') }}">
    <div class="row d-flex justify-content-center">
        <form action="{{ url('dash/event/update', $event->id) }}" method="POST" enctype="multipart/form-data">
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
                        <i class="bx bx-check bx-md mt-1">{{ session()->get('message') }} </i><br>
                    </div>
                @endif
                @foreach (config('app.languages') as $locale => $value)
                    <div class=" mb-3 col-md-4 my-1">
                        <label for="title">{{ __('home.title') . '-' . $value }}</label>
                        <input type="text" class="form-control" name="{{ 'title_' . $locale }}"
                            value="<?php echo $event->{'title_' . $locale}; ?>">
                    </div>
                    <div class=" col-md-8 my-1">
                        <label for="short_desc">{{ __('home.short_desc') . '-' . $value }}</label>
                        <input type="text" class="form-control" name="{{ 'short_desc_' . $locale }}"
                            value="<?php echo $event->{'short_desc_' . $locale}; ?>">
                    </div>
                    <div class=" col-md-4 my-1">
                        <label for="location">{{ __('home.location') . '-' . $value }}</label>
                        <input type="text" class="form-control" name="{{ 'location_' . $locale }}"
                            value="<?php echo $event->{'location_' . $locale}; ?>">
                    </div>
                    <div class=" my-1 col-md-8">
                        <label for="details">{{ __('home.details') . '-' . $value }}</label>
                        <textarea class="form-control" name="{{ 'details_' . $locale }}"
                            style="height: 100px;"><?php echo $event->{'title_' . $locale}; ?></textarea>
                    </div>
                    <hr>
                @endforeach
                <div class=" mb-3 col-md-4 my-1">
                    <label for="needed_vols">{{ __('home.needed_vols') }}</label>
                    <input type="number" class="form-control" name="needed_vols" value="{{ $event->needed_vols }}"
                        min="1">
                </div>
                {{-- Amharic datetime begins --}}
                @if (app()->getLocale() == 'am')
                    <div class=" col-md-2 my-1">
                        <label for="start_time">{{ __('home.start_time') }}</label>
                        <input readonly id="" class="form-control amharic-start-time"
                            value="{{ App\Http\Controllers\Admin\Dashboard::backToLocalTime($event->start_time) }}"
                            name="start_time" autocomplete="off" />
                    </div>
                    <div class=" col-md-2 my-1">
                        <label for="end_time">{{ __('home.end_time') }}</label>
                        <input readonly id="" class="form-control amharic-end-time"
                            value="{{ App\Http\Controllers\Admin\Dashboard::backToLocalTime($event->end_time) }}"
                            name="end_time" autocomplete="off" />
                    </div>
                    <?php $formatted = (new Andegna\DateTime(new DateTime($event->due_date)))->format('Y-m-d'); ?>
                    <div class=" col-md-4 my-1">
                        <label for="due_date">{{ __('home.date') }}</label>
                        <input readonly class="form-control" type="text" name="due_date" id="amharic" autocomplete="off"
                            value="{{ $formatted }}">
                    </div>
                    {{-- Amharic datetime ends --}}
                    {{-- Oromic date time input begins here --}}
                @elseif(app()->getLocale() == 'or')
                    <div class=" col-md-2 my-1">
                        <label for="start_time">{{ __('home.start_time') }}</label>
                        <input readonly id="" class="form-control oromic-start-time"
                            value="{{ App\Http\Controllers\Admin\Dashboard::backToLocalTime($event->start_time) }}"
                            name="start_time" autocomplete="off" />
                    </div>
                    <div class=" col-md-2 my-1">
                        <label for="end_time">{{ __('home.end_time') }}</label>
                        <input readonly id="" class="form-control oromic-end-time"
                            value="{{ App\Http\Controllers\Admin\Dashboard::backToLocalTime($event->end_time) }}"
                            name="end_time" autocomplete="off" />
                    </div>
                    <?php $formatted = (new Andegna\DateTime(new DateTime($event->due_date)))->format('Y-m-d'); ?>
                    <div class=" col-md-4 my-1">
                        <label for="due_date">{{ __('home.date') }}</label>
                        <input readonly class="form-control" type="text" name="due_date" id="oromic" autocomplete="off"
                            value="{{ $formatted }}">
                    </div>
                    {{-- Oromic date time input ends here --}}
                @elseif(app()->getLocale() == 'en')
                    <div class=" col-md-2 my-1">
                        <label for="start_time">{{ __('home.start_time') }}</label>
                        <input readonly id="" class="form-control english-start-time" value="{{ $event->start_time }}"
                            name="start_time" autocomplete="off" />
                    </div>
                    <div class=" col-md-2 my-1">
                        <label for="end_time">{{ __('home.end_time') }}</label>
                        <input readonly id="" class="form-control english-end-time" value="{{ $event->end_time }}"
                            name="end_time" autocomplete="off" />
                    </div>
                    <div class=" col-md-4 my-1">
                        <label for="due_date">{{ __('home.date') }}</label>
                        <input readonly class="form-control" type="text" name="due_date" id="gregorian" autocomplete="off"
                            value="{{ $event->due_date }}">
                    </div>
                @endif
                <div class=" mb-3 col-md-4 my-1">
                    <label for="status">{{ __('home.status') }}</label>
                    <select class="form-select" aria-label="Default select example" name="status">
                        @if ($event->status == 'Upcoming')
                            <option selected> @lang('home.' . strtolower($event->status)) </option>
                            <option>@lang('home.cancelled')</option>
                            <option>@lang('home.past')</option>
                        @elseif($event->status == 'Cancelled')
                            <option selected> @lang('home.' . strtolower($event->status)) </option>
                            <option>@lang('home.upcoming')</option>
                            <option>@lang('home.past')</option>
                        @elseif($event->status == 'Past')
                            <option selected> @lang('home.' . strtolower($event->status)) </option>
                            <option>@lang('home.upcoming')</option>
                            <option>@lang('home.cancelled')</option>
                        @endif
                    </select>
                </div>
                <div class="col-md-8 my-1 justify-content-start mx-1 d-flex flex-wrap my-1">
                    <label for="inputCompany5">@lang('home.picture')</label>
                    <label class="col-md-2 btn click-me-label" for="pic">{{ __('home.click_here') }}</label>
                    <label for="pic" id="file-name"
                        onchange="preview_image(event)">{{ __('home.no_file_choosen') }}</label>
                    <input type="file" id="pic" name="picture" class="form-control-lg col-md-10" accept="image/*"
                        onchange="preview_image(event)" style="display: none;">
                    <span class="text-primary mx-2">{{ __('home.a_good_event_pic') }}</span>
                    <img src="{{ asset('uploads/event-pictures') }}/{{ $event->picture }}" alt=""
                        class="img-thumbnail" width="200" height="200" id="output_image">
                </div>
            </div>
    </div>
    <div class="text-center mt-2 mb-5">
        <button type="submit" class="btn btn-success"><i class="bx bxs-edit bx-md">{{ __('home.update') }}</i></button>
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
