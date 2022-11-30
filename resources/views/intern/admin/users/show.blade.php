@extends('layouts.app')

@section('title', 'Benutzer anzeigen')
@section('description'){!! Str::limit('Benutzer anzeigen.', 150) !!}@endsection
@section('robots', 'NOINDEX,NOFOLLOW')

@section('content')
    <!-- ======= Permissions Create Page ======= -->
    <section class="permissions" id="permissions">
        <div class="container" data-aos="fade-up">

            <div class="row">
                <div class="col-lg-12">

                    <div>
                        Name: {{ $user->name }}
                    </div>

                    <div>
                        E-Mail-Adresse: {{ $user->email }}
                    </div>

                    <a href="{{ route('intern.admin.users.edit', $user->id) }}" class="btn btn-info">Bearbeiten</a>
                    <a href="{{ route('intern.admin.users.index') }}" class="btn btn-default">Zurück</a>
                </div>
            </div>

        </div>
    </section>
@endsection

@push('js')
    <script type="module">
        $(document).ready(function() {
            $('[name="all_permission"]').on('click', function() {

                if($(this).is(':checked')) {
                    $.each($('.permission'), function() {
                        $(this).prop('checked',true);
                    });
                } else {
                    $.each($('.permission'), function() {
                        $(this).prop('checked',false);
                    });
                }

            });
        });
    </script>
@endpush
