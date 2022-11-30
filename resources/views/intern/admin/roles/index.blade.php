@extends('layouts.app')

@section('title', 'Rollen')
@section('description'){!! Str::limit('Verwalten Sie hier Ihre Rollen.', 150) !!}@endsection
@section('robots', 'NOINDEX,NOFOLLOW')

@section('content')
    <!-- ======= Permissions Create Page ======= -->
    <section class="permissions" id="permissions">
        <div class="container" data-aos="fade-up">

            <div class="row gy-4">
                <div class="col-lg-12 d-flex justify-content-end align-items-center">
                    <a href="{{ route('intern.admin.roles.create') }}" class="btn btn-primary btn-sm">Rolle hinzufügen</a>
                </div>

                <div class="col-lg-12 d-flex align-items-stretch">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th style="width: 1%;">ID</th>
                            <th>Name</th>
                            <th colspan="3" style="width: 3%;">Aktion</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($roles as $key => $role)
                            <tr>
                                <td>{{ $role->id }}</td>
                                <td>{{ __($role->name) }}</td>
                                <td><a href="{{ route('intern.admin.roles.show', $role->id) }}" class="btn btn-info btn-sm">Anzeigen</a></td>
                                <td><a href="{{ route('intern.admin.roles.edit', $role->id) }}" class="btn btn-primary btn-sm">Bearbeiten</a></td>
                                <td>
                                    <form action="{{ route('intern.admin.roles.destroy', $role->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-sm">Löschen</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                    <div class="d-flex">
                        {!! $roles->links() !!}
                    </div>
                </div>
            </div>

        </div>
    </section>
@endsection
