@extends('layouts.admin')
@section('content')
    <div class="row d-flex justify-content-center">
        <h3>{{ __('Improve this help me application') }}</h3>
        <form action="{{ url('dash/helpmes/update', $helpme->id) }}" method="POST" enctype="multipart/form-data">
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
                @endif
                @foreach (config('app.languages') as $locale => $value)
                    <div class=" mb-3 col-md-4 my-1">
                        <label for="title">{{ __('home.applicant_name') . '-' . $value }}</label>
                        <input type="text" class="form-control" name="{{ 'name_' . $locale }}"
                            value="<?php echo $helpme->{'name_' . $locale}; ?>">
                    </div>
                    <div class=" mb-3 col-md-3 my-1">
                        <label for="title">{{ __('home.location') . '-' . $value }}</label>
                        <input type="text" class="form-control" name="{{ 'address_' . $locale }}"
                            value="<?php echo $helpme->{'address_' . $locale}; ?>">
                    </div>
                    <div class=" mb-3 col-md-5 my-1">
                        <label for="title">{{ __('home.problem_subject') . '-' . $value }}</label>
                        <input type="text" class="form-control" name="{{ 'problem_title_' . $locale }}"
                            value="<?php echo $helpme->{'problem_title_' . $locale}; ?>">
                    </div>
                    <div class=" my-1 col">
                        <label for="details">{{ __('home.problem_details_and') . '-' . $value }}</label>
                        <textarea class="form-control" name="{{ 'problem_details_' . $locale }}"
                            style="height: 100px;"><?php echo $helpme->{'problem_details_' . $locale}; ?></textarea>
                    </div>
                    {{-- <div class=" col-md-8 my-1">
            <label for="short_desc">{{__('home.short_desc').'-'.$value}}</label>
            <input type="text" class="form-control" name="{{'short_desc_'.$locale}}" value="<?php echo $event->{'short_desc_' . $locale}; ?>" >
         </div>
         <div class=" col-md-4 my-1">
            <label for="location">{{__('home.location').'-'.$value}}</label>
            <input type="text" class="form-control" name="{{'location_'.$locale}}" value="<?php echo $event->{'location_' . $locale}; ?>">
         </div> --}}
                    <hr>
                @endforeach
            </div>
    </div>
    <div class="text-center mt-2 mb-5">
        <button type="submit" class="btn btn-success"><i class="bx bxs-plus-circle bx-md">Save</i></button>
        </form>
    </div>
@endsection
