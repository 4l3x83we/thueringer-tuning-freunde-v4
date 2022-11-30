@extends('layouts.app')

@section('title', 'Rolle aktualisieren')
@section('description'){!! Str::limit('Rolle bearbeiten und Berechtigungen verwalten: ' . $role->name, 150) !!}@endsection
@section('robots', 'NOINDEX,NOFOLLOW')

@section('content')
    <!-- ======= Permissions Create Page ======= -->
    <section class="permissions" id="permissions">
        <div class="container" data-aos="fade-up">

            <div class="row">
                <div class="col-lg-12 d-flex align-items-stretch">
                    <form action="{{ route('intern.admin.roles.update', $role->id) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input value="{{ old('name') ?: $role->name }}"
                                   type="text"
                                   class="form-control"
                                   name="name"
                                   placeholder="Name" required>

                            @if ($errors->has('name'))
                                <span class="text-danger text-left">{{ $errors->first('name') }}</span>
                            @endif
                        </div>

                        <label for="permissions" class="form-label">Assign Permissions</label>

                        <table class="table table-striped">
                            <thead>
                            <th scope="col" width="1%"><input type="checkbox" name="all_permission"></th>
                            <th scope="col" width="20%">Name</th>
                            <th scope="col" width="1%">Guard</th>
                            </thead>

                            @foreach($permissions as $permission)
                                <tr>
                                    <td>
                                        <input type="checkbox"
                                               name="permission[{{ $permission->name }}]"
                                               value="{{ $permission->name }}"
                                               class='permission'
                                            {{ in_array($permission->name, $rolePermissions)
                                                ? 'checked'
                                                : '' }}>
                                    </td>
                                    <td>{{ __($permission->name) }}</td>
                                    <td>{{ $permission->guard_name }}</td>
                                </tr>
                            @endforeach
                        </table>

                        <button type="submit" class="btn btn-primary">Speichern</button>
                        <a href="{{ route('intern.admin.roles.index') }}" class="btn btn-default">Zurück</a>
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
