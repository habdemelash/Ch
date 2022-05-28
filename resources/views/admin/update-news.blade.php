@extends('layouts.admin')
@section('content')
    @include('admin.styles')
    <div class="row d-flex justify-content-center">
        <h3>@lang('home.update_news')</h3>
        <form action="{{ url('dash/news/update', $news->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row d-flex justify-content-start">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                            <i class="bx bxs-error"></i>{{ $error }}<br>
                        @endforeach
                    </div>
                @endif
                @foreach (config('app.languages') as $locale => $value)
                    <div class=" mb-3 col-md-4 my-1">
                        <label for="heading" class="text-danger fw-bold">@lang('home.heading'){{ '-' . $value }}</label>
                        <input type="text" class="form-control" name="{{ 'heading_' . $locale }}"
                            value="<?php echo $news->{'heading_' . $locale}; ?>">
                    </div>
                    <div class="my-1 col-md-8">
                        <label for="body" class="text-danger fw-bold">@lang('home.body'){{ '-' . $value }}</label>
                        <textarea class="form-control" name="{{ 'body_' . $locale }}" style="height: 200px;"><?php echo $news->{'body_' . $locale}; ?></textarea>
                    </div>
                @endforeach
                <div class="col-md-8 my-1 justify-content-start mx-1 d-flex flex-wrap my-1">
                    <label for="inputCompany5">@lang('home.photo')</label>
                    <label class="col-md-2 btn click-me-label" for="pic">{{ __('home.click_here') }}</label>
                    <label for="pic" id="file-name"
                        onchange="preview_image(event)">{{ __('home.no_file_choosen') }}</label>
                    <input type="file" id="pic" name="picture" class="form-control-lg col-md-10" accept="image/*"
                        onchange="preview_image(event)" style="display: none;">
                    <span class="text-primary mx-2">{{ __('home.a_good_event_pic') }}</span>
                    <img src="{{ asset('uploads/news-pictures') }}/{{ $news->picture }}" alt="" class="img-thumbnail"
                        width="200" height="200" id="output_image">
                </div>
            </div>
    </div>
    <div class="text-center mt-2 mb-5">
        <button type="submit" class="btn btn-success"><i class="bx bxs-plus-circle bx-md">@lang('home.update')</i></button>
        </form>
    </div>
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
