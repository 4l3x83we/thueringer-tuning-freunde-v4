@extends('layouts.app')

@section('title') {{ ucfirst($role->name) }} Rolle @endsection
@section('description'){!! Str::limit('Rolle und Berechtigung anzeigen: ' . $role->name, 150) !!}@endsection
@section('robots', 'NOINDEX,NOFOLLOW')

@section('content')
    <!-- ======= Permissions Create Page ======= -->
    <section class="permissions" id="permissions">
        <div class="container" data-aos="fade-up">

            <div class="row">
                <div class="col-lg-12">

                    <h3>Zugewiesene Berechtigungen</h3>

                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th scope="col" style="width: 20%">Name</th>
                            <th scope="col" style="width: 1%">Guard</th>
                        </tr>
                        </thead>

                        @foreach($rolePermissions as $permission)
                            <tr>
                                <td>{{ __($permission->name) }}</td>
                                <td>{{ $permission->guard_name }}</td>
                            </tr>
                        @endforeach
                    </table>

                    <a href="{{ route('intern.admin.roles.edit', $role->id) }}" class="btn btn-info">Bearbeiten</a>
                    <a href="{{ route('intern.admin.roles.index') }}" class="btn btn-default">Zurück</a>
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
