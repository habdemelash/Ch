@extends('layouts.admin')
@section('search')
    <li class="d-flex flex-column flex-md-row">
        <div class="container-fluid">
            <form class="d-flex" action="{{route('admin.news.search')}}" method="GET">
                @csrf

                <input class="form-control" id="searchNews" name="keyword" type="text" placeholder="@lang('home.search_place')" aria-label="Search">
                <button class="btn btn-success text-nowrap" type="submit"><i class="bi bi-search"></i></button>
            </form>
        </div>
    </li>
@endsection
@section('content')
    <h1 class="h3 mb-3"><strong>{{ __('home.news') }}</strong> {{ __('home.administration') }}</h1>
    <div class="row d-flex mt-3 justify-content-center">
        <div class="container">
            <div class="row align-items-start justify-content-center">
                <a class="btn btn-success col-2 text-nowrap" href="{{ route('admin.news.addform') }}">
                    <i class="bx bxs-plus-circle"></i>{{ __('home.add_new') }}
                </a>
            </div>
        </div>
    </div>
    <div class="" style="overflow-x: auto;">
        <?php $locale = app()->getLocale(); ?>
        <table class="table table-hover my-0 table-responsive" id="eventsTable">
            <thead>
                <tr>
                    <th class=" d-xl-table-cell text-primary"> {{ __('home.heading') }}</th>
                    <th class=" d-xl-table-cell text-center">{{ __('home.body') }}</th>
                    <th class=" d-xl-table-cell text-danger">{{ __('home.posted_by') }}</th>
                    <th class=" d-xl-table-cell text-center">{{ __('home.date') }}</th>
                    <th class=" d-md-table-cell text-center">{{ __('home.picture') }}</th>
                    <th class=" d-md-table-cell text-center">{{ __('home.actions') }}</th>
                </tr>
            </thead>
            <tbody id="newsTBody">
                @foreach ($news as $article)
                    <tr>
                        <td class="text-info fw-bold" style="font-family: Times New Roman;">
                            {{ mb_substr($article->{'heading_' . $locale}, 0, 60, 'UTF-8') }} ...</td>
                        <td class="text-gray-dark">
                            {{ mb_substr($article->{'body_' . $locale}, 0, 100, 'UTF-8') }} ...
                        </td style="font-family: Times New Roman;">
                        <?php ?>
                        <td class="text-danger fw-bold" style="font-family: Times New Roman;">
                            {{ $article->author->name }}
                        </td>
                        <?php $on = new Carbon\Carbon(new DateTime($article->created_at));
                        $formatted = $on->toDayDateTimeString();
                        if (app()->getLocale() == 'am') {
                            $formatted = Andegna\DateTimeFactory::fromDateTime($article->created_at)->format(\Andegna\Constants::DATE_ETHIOPIAN);
                        } elseif ($locale == 'or') {
                            $formatted = App\Http\Controllers\Admin\Dashboard::oromicDate((new Andegna\DateTime(new DateTime($article->created_at)))->format(\Andegna\Constants::DATE_ETHIOPIAN));
                        } ?>
                        <td class="text-dark" style="font-family: Times New Roman;">{{ $formatted }}</td>
                        <td><img src="{{ asset('uploads/news-pictures') }}/{{ $article->picture }}"
                                class="rounded-circle rounded me-1" alt="No picture" style="height: 60px;width: 60px;" />
                        </td>
                        <td class="d-flex flex-row">
                            <a href="{{ url('dash/news/updateform', $article->id) }}" class="mx-1 my-3"><i
                                    class="bx bxs-edit bx-md"></i></a>
                            <button value="{{ $article->id }}" type="button" class="btn deleteNews"
                                data-bs-toggle="modal" data-bs-target="#deleteNewsModal"><i
                                    class="bx bxs-trash bx-md text-danger"></i>
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{-- modal --}}
        <div class="modal fade" id="deleteNewsModal" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <form action="{{ url('dash/news/delete') }}" method="POST">
                    @csrf
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title text-danger" id="ModalLabel">Delete News</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" name="article_id" id="article_id">
                            <p class="fw-bold">Do you really want to delete this news?</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                            <button type="submit" class="btn btn-danger" data-bs-dismiss="modal">Yes, delete</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6 mt-3 mb-lg-5">
            <strong>{{ $news->links('pagination::bootstrap-4') }}</strong>
        </div>
    </div>
    <script src="{{ asset('admin/other/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('admin/other/toastr.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $(document).on('click', '.deleteNews', function(e) {
                e.preventDefault();
                var article_id = $(this).val();
                $('#article_id').val(article_id);
                $('#deleteNewsModal').modal('show');
            });
        });
    </script>
    @if (Session::has('message'))
        <script>
            toastr.success("{!! Session::get('message') !!}");
        </script>
    @endif
    
@endsection
