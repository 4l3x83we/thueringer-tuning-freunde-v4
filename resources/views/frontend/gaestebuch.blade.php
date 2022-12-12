@extends('layouts.app')

@section('title') Gästebuch @endsection
@section('description'){{ strip_tags(Str::limit('Hier kannst du uns einen netten Kommentar hinterlassen.', 150)) }}@endsection
@section('robots', 'index, follow')

@push('css')
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
@endpush

@section('content')
    <!-- ======= Gästebuch ======= -->
    @include('frontend.component.gaestebuch.create')
<section class="gaestebuch" id="gaestebuch">
    <div class="container" data-aos="fade-up">

        <div class="row">

            <div class="col-lg-12 entries">

                <div class="col-lg-12 mb-3">
                    <div class="d-flex justify-content-end">
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary btn-sm fw-bold" data-bs-toggle="modal" data-bs-target="#guestbookWrite">
                            <em class="bi bi-vector-pen"></em> Ins Gästebuch schreiben
                        </button>
                    </div>
                </div>

                @if(count($gaestebuchs) > 0)
                    @foreach($gaestebuchs as $gaestebuch)
                        @if($gaestebuch->published)
                            <article class="entry shadow">
                                <h2 class="entry-title">
                                    Gästebucheintrag von: {{ $gaestebuch->name }}
                                </h2>

                                <div class="entry-meta">
                                    <ul>
                                        @if($gaestebuch->email)
                                            <li class="d-flex align-items-center"><a href="mailto:{{ $gaestebuch->email }}"><em class="bi bi-envelope primary-link"></em></a></li>
                                        @endif
                                        @if($gaestebuch->facebook or $gaestebuch->tiktok or $gaestebuch->instagram)
                                        <li class="d-flex align-items-center">
                                            <ul class="d-flex flex-row">
                                                @if($gaestebuch->facebook)
                                                    <li class="d-flex align-items-center"><a href="{{ $gaestebuch->facebook }}" target="_blank" class="facebook"><em class="bi bi-facebook"></em></a></li>
                                                @endif
                                                @if($gaestebuch->tiktok)
                                                    <li class="d-flex align-items-center"><a href="{{ $gaestebuch->tiktok }}" target="_blank" class="tiktok"><em class="bi bi-tiktok"></em></a></li>
                                                @endif
                                                @if($gaestebuch->instagram)
                                                    <li class="d-flex align-items-center"><a href="{{ $gaestebuch->instagram }}" target="_blank" class="instagram"><em class="bi bi-instagram"></em></a></li>
                                                @endif
                                            </ul>
                                        </li>
                                        @endif
                                        @if($gaestebuch->website)
                                            <li class="d-flex align-items-center"><a href="{{ $gaestebuch->website }}"><em class="bi bi-link-45deg primary-link"></em></a></li>
                                        @endif
                                        @if($gaestebuch->created_at)
                                            <li class="d-flex align-items-center"><em class="bi bi-clock-history"></em> {{ \Carbon\Carbon::parse($gaestebuch->created_at)->fromNow() }}</li>
                                        @endif
                                    </ul>
                                </div>

                                <div class="entry-content">
                                    <p class="lead">
                                        {!! $gaestebuch->message !!}
                                    </p>
                                </div>

                                <div class="entry-footer">
                                    <ul>
                                        <li class="d-flex align-content-between"># {!! $gaestebuch->id . ' |<em>&nbsp; Hinzugefügt am: ' . \Carbon\Carbon::parse($gaestebuch->created_at)->isoFormat('ddd DD. MMMM YYYY') . '</em>' !!}</li>
                                        @hasanyrole('super_admin|admin')
                                            <li class="d-flex align-content-between">
                                                <form action="{{ route('frontend.gaestebuch.destroy', $gaestebuch->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <input type="hidden" name="id" value="{{ $gaestebuch->id }}">
                                                    <button class="btn text-danger btn-sm p-0" type="submit" name="delete" value="true"><em class="bi bi-trash"></em></button>
                                                </form>
                                            </li>
                                        @endhasanyrole
                                    </ul>
                                </div>
                            </article>
                        @else
                            @hasanyrole('super_admin|admin')
                                <article class="entry text-bg-dark shadow">
                                    <h2 class="entry-title text-danger">
                                        Gästebucheintrag von: {{ $gaestebuch->name }}
                                    </h2>

                                    <div class="entry-meta">
                                        <ul>
                                            @if($gaestebuch->email)
                                                <li class="d-flex align-items-center"><a href="mailto:{{ $gaestebuch->email }}"><em class="bi bi-envelope primary-link"></em></a></li>
                                            @endif
                                            @if($gaestebuch->facebook or $gaestebuch->tiktok or $gaestebuch->instagram)
                                                <li class="d-flex align-items-center">
                                                    <ul class="d-flex flex-row">
                                                        @if($gaestebuch->facebook)
                                                            <li class="d-flex align-items-center"><a href="{{ $gaestebuch->facebook }}" target="_blank" class="facebook"><em class="bi bi-facebook"></em></a></li>
                                                        @endif
                                                        @if($gaestebuch->tiktok)
                                                            <li class="d-flex align-items-center"><a href="{{ $gaestebuch->tiktok }}" target="_blank" class="tiktok"><em class="bi bi-tiktok"></em></a></li>
                                                        @endif
                                                        @if($gaestebuch->instagram)
                                                            <li class="d-flex align-items-center"><a href="{{ $gaestebuch->instagram }}" target="_blank" class="instagram"><em class="bi bi-instagram"></em></a></li>
                                                        @endif
                                                    </ul>
                                                </li>
                                            @endif
                                            @if($gaestebuch->website)
                                                <li class="d-flex align-items-center"><a href="{{ $gaestebuch->website }}"><em class="bi bi-link-45deg primary-link"></em></a></li>
                                            @endif
                                            @if($gaestebuch->created_at)
                                                <li class="d-flex align-items-center"><em class="bi bi-clock-history"></em> {{ \Carbon\Carbon::parse($gaestebuch->created_at)->fromNow() }}</li>
                                            @endif
                                        </ul>
                                    </div>

                                    <div class="entry-content">
                                        <p class="lead">
                                            {!! $gaestebuch->message !!}
                                        </p>
                                    </div>

                                    <div class="entry-footer">
                                        <ul>
                                            <li class="d-flex align-content-between"># {!! $gaestebuch->id . ' |<em>&nbsp; Hinzugefügt am: ' . \Carbon\Carbon::parse($gaestebuch->created_at)->isoFormat('ddd DD. MMMM YYYY') . '</em>' !!}</li>
                                            <li class="d-flex align-content-between">
                                                <form action="{{ route('frontend.gaestebuch.update', $gaestebuch->id) }}" method="POST" class="me-2">
                                                    @csrf
                                                    @method('PATCH')
                                                    <input type="hidden" name="id" value="{{ $gaestebuch->id }}">
                                                    <input type="hidden" name="published" value="1">
                                                    <button class="btn text-success btn-sm p-0 fw-bold" type="submit" name="delete" value="true"><em class="bi bi-check"></em></button>
                                                </form>
                                                <form action="{{ route('frontend.gaestebuch.destroy', $gaestebuch->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <input type="hidden" name="id" value="{{ $gaestebuch->id }}">
                                                    <button class="btn text-danger btn-sm p-0" type="submit" name="delete" value="true"><em class="bi bi-trash"></em></button>
                                                </form>
                                            </li>
                                        </ul>
                                    </div>
                                </article>
                            @endhasanyrole
                        @endif
                    @endforeach
                @endif
            </div>

        </div>

    </div>
</section>
@endsection
