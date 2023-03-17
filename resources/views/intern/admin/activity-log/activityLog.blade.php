@extends('layouts.app')

@section('title', 'Aktivitätsprotokoll')
@section('description')
    {!! Str::limit('Hier kannst du alle Aktivitäten auf der Webseite sehen.', 150) !!}
@endsection
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
                                <th style="min-width: 100px;">Log Name</th>
                                <th style="min-width: 250px;">Beschreibung</th>
                                <th style="min-width: 180px;">Thementyp</th>
                                <th style="min-width: 100px;">Vorgang</th>
                                <th style="min-width: 100px;">Betreff-ID</th>
                                <th style="min-width: 180px;">Art der Ursache</th>
                                <th style="min-width: 180px;">User</th>
                                <th style="min-width: 100px;">Batch-UUID</th>
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
                                    <td>@if($activityLog->causer_id)
                                            {{ \App\Models\User::userActivity($activityLog->causer_id) }}
                                        @endif</td>
                                    <td>{{ $activityLog->batch_uuid }}</td>
                                </tr>
                                @if($activityLog->changes)
                                    <tr>
                                        <td colspan="8">
                                            <div class="table-responsive">
                                                <table class="table mb-0">
                                                    <thead>
                                                    <tr>
                                                        @foreach($activityLog->changes as $field => $value)
                                                            @foreach($value as $key => $item)
                                                                <th>{{ $key }}</th>
                                                            @endforeach
                                                        @endforeach
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <tr>
                                                        @foreach($activityLog->changes as $field => $value)
                                                            @foreach($value as $key => $item)
                                                                <td>{!! $item !!}</td>
                                                            @endforeach
                                                        @endforeach
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </div>
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
