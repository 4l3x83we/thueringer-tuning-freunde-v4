@extends('layouts.app')

@section('title', 'Aktivitätsprotokoll')
@section('description'){!! Str::limit('Hier kannst du alle Aktivitäten auf der Webseite sehen.', 150) !!}@endsection
@section('robots', 'NOINDEX,NOFOLLOW')

@section('content')
    <section class="activityLog" id="activityLog">
        <div class="container" data-aos="fade-up">

            <div class="row">
                <div class="col-lg-12">

                    <div class="table-responsive">
                        <table class="table table-striped table-sm table-hover">
                            <thead>
                            <tr class="align-middle">
                                <th>Log Name</th>
                                <th>Beschreibung</th>
                                <th>Thementyp</th>
                                <th>Vorgang</th>
                                <th>Betreff-ID</th>
                                <th>Art der Ursache</th>
                                <th>User</th>
                                <th>Batch-UUID</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($activityLogs as $activityLog)
                                <tr class="align-middle">
                                    <td>{{ $activityLog->log_name }}</td>
                                    <td>{{ $activityLog->description }}</td>
                                    <td>{{ $activityLog->subject_type }}</td>
                                    <td>{{ $activityLog->event }}</td>
                                    <td>{{ $activityLog->subject_id }}</td>
                                    <td>{{ $activityLog->causer_type }}</td>
                                    <td>@if($activityLog->causer_id) {{ \App\Models\User::userActivity($activityLog->causer_id) }} @endif</td>
                                    <td>{{ $activityLog->batch_uuid }}</td>
                                </tr>
                                @php
                                    $properties = json_decode($activityLog->properties);
                                @endphp
                                @if($properties !== [])
                                <tr>
                                    <td colspan="8">
                                        <table class="table mb-0">
                                            <tbody>
                                            @foreach($properties->attributes as $a => $values)
                                            <tr>
                                                @if('user_id' === $a)
                                                    <th>Mitglied</th>
                                                    <td>{!! \App\Models\User::userActivity($values) !!}</td>
                                                @else
                                                    <th>{{ $a }}</th>
                                                    <td>{!! $values !!}</td>
                                                @endif
                                            </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                                @endif
                            @endforeach
                            </tbody>
                        </table>

                        {{ $activityLogs->links() }}
                    </div>

                </div>
            </div>

        </div>
    </section>
@endsection
