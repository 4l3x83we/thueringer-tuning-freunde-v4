@extends('layouts.app')

@section('title', 'Neue Rolle hinzufügen')
@section('description'){!! Str::limit('Neue Rolle hinzufügen und Berechtigungen zuweisen.', 150) !!}@endsection
@section('robots', 'NOINDEX,NOFOLLOW')

@section('content')
    <!-- ======= Permissions Create Page ======= -->
    <section class="permissions" id="permissions">
        <div class="container" data-aos="fade-up">

            <div class="row">
                <div class="col-lg-12 d-flex align-items-stretch">
                    <form action="{{ route('intern.admin.users.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input value="{{ old('name') }}"
                                   type="text"
                                   class="form-control"
                                   name="name"
                                   placeholder="Name" required>

                            @if ($errors->has('name'))
                                <span class="text-danger text-left">{{ $errors->first('name') }}</span>
                            @endif
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">E-Mail-Adresse</label>
                            <input value="{{ old('email') }}"
                                   type="text"
                                   class="form-control"
                                   name="email"
                                   placeholder="E-Mail-Adresse" required>

                            @if ($errors->has('email'))
                                <span class="text-danger text-left">{{ $errors->first('email') }}</span>
                            @endif
                        </div>

                        <button type="submit" class="btn btn-primary">Speichern</button>
                        <a href="{{ route('intern.admin.users.index') }}" class="btn btn-default">Zurück</a>
                    </form>
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
