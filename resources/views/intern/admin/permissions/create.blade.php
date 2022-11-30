@extends('layouts.app')

@section('title', 'Neue Berechtigung hinzufügen')
@section('description'){!! Str::limit('Hier kannst due neue Berechtigungen erstellen.', 150) !!}@endsection
@section('robots', 'NOINDEX,NOFOLLOW')

@section('content')
    <!-- ======= Permissions Create Page ======= -->
    <section class="permissions" id="permissions">
        <div class="container" data-aos="fade-up">

            <div class="row">
                <div class="col-lg-12 d-flex align-items-stretch">
                    <form action="{{ route('intern.admin.permissions.store') }}" method="POST">
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

                        <button type="submit" class="btn btn-primary">Speichern</button>
                        <a href="{{ route('intern.admin.permissions.index') }}" class="btn btn-default">Zurück</a>
                    </form>
                </div>
            </div>

        </div>
    </section>
@endsection
