@extends('layouts.app')

@section('title', 'Berechtigungen')
@section('description'){!! Str::limit('Verwalten Sie hier Ihre Berechtigungen.', 150) !!}@endsection
@section('robots', 'NOINDEX,NOFOLLOW')

@section('content')
    <!-- ======= Permissions Create Page ======= -->
    <section class="permissions" id="permissions">
        <div class="container" data-aos="fade-up">

            <div class="row gy-4">
                <div class="col-lg-12 d-flex justify-content-end align-items-center">
                    <a href="{{ route('intern.admin.permissions.create') }}" class="btn btn-primary btn-sm">Berechtigungen hinzufügen</a>
                </div>

                <div class="col-lg-12 d-flex align-items-stretch">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th scope="col" style="width: 15%;">Name</th>
                            <th scope="col">Guard</th>
                            <th scope="col" colspan="3" style="width: 1%;"></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($permissions as $permission)
                            <tr>
                                <td>{{ $permission->name }}</td>
                                <td>{{ $permission->guard_name }}</td>
                                <td><a href="{{ route('intern.admin.permissions.edit', $permission->id) }}" class="btn btn-info btn-sm">Bearbeiten</a></td>
                                <td>
                                    <form action="{{ route('intern.admin.permissions.destroy', $permission->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-sm">Löschen</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </section>
@endsection
