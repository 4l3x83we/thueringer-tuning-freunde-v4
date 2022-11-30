@extends('layouts.app')

@section('title', 'Benutzer')
@section('description'){!! Str::limit('Verwalten Sie hier Ihre Benutzer.', 150) !!}@endsection
@section('robots', 'NOINDEX,NOFOLLOW')

@section('content')
    <!-- ======= Permissions Create Page ======= -->
    <section class="permissions" id="permissions">
        <div class="container" data-aos="fade-up">

            <div class="row gy-4">
                <div class="col-lg-12 d-flex justify-content-end align-items-center">
                    <a href="{{ route('intern.admin.users.create') }}" class="btn btn-primary btn-sm">Neuen Benutzer hinzufügen</a>
                </div>

                <div class="col-lg-12 d-flex align-items-stretch">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th class="align-middle" scope="col" style="width: 1%;">#</th>
                            <th class="align-middle" scope="col" style="width: 15%;">Name</th>
                            <th class="align-middle" scope="col">E-Mail Adresse</th>
                            <th class="align-middle" scope="col" style="width: 10%;">Rollen</th>
                            <th class="align-middle" scope="col" colspan="3" style="width: 1%;"></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td class="align-middle" scope="row">{{ $user->id }}</td>
                                <td class="align-middle">{{ $user->name }}</td>
                                <td class="align-middle">{{ $user->email }}</td>
                                <td class="align-middle">
                                    @foreach($user->roles as $role)
                                        <span class="badge text-bg-primary">{{ __($role->name) }}</span>
                                    @endforeach
                                </td>
                                <td class="align-middle"><a href="{{ route('intern.admin.users.show', $user->id) }}" class="btn btn-warning btn-sm">Anzeigen</a></td>
                                <td class="align-middle"><a href="{{ route('intern.admin.users.edit', $user->id) }}" class="btn btn-info btn-sm">Bearbeiten</a></td>
                                <td class="align-middle">
                                    <form action="{{ route('intern.admin.users.destroy', $user->id) }}" method="POST" class="d-inline">
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
                        {!! $users->links() !!}
                    </div>
                </div>
            </div>

        </div>
    </section>
@endsection
