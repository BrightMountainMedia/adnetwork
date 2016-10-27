@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    @if ( count($stats) > 0 )
                    <table class="table table-bordered table-hover table-responsive">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Site</th>
                                <th>Tag</th>
                                <th>Impressions</th>
                                <th>Served</th>
                                <th>Fill</th>
                                <th>Income</th>
                                <th>eCPM</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($stats as $stat)
                            <tr>
                                <td>{{ $stat->date }}</td>
                                <td>{{ $stat->site }}</td>
                                <td>{{ $stat->tag }}</td>
                                <td>{{ $stat->impressions }}</td>
                                <td>{{ $stat->served }}</td>
                                <td>{{ $stat->fill }}%</td>
                                <td>${{ $stat->income }}</td>
                                <td>${{ $stat->ecpm }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @else
                    <p>You currently don't have any information to display.</p>
                    @endif

                    @if ( method_exists($stats, 'links') )
                        {{ $stats->links() }}
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
