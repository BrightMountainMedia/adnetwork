@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">



<div class="panel panel-default panel-flush">

    <a href="/download" class="btn btn-primary btn-block"><i class="fa fa-cloud-download"></i> Download Stats</a>

</div>

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
                            @if ( strpos($stat->tag, 'Total') !== false )
                            <tr>
                                <td style="font-weight: bold;">{{ $stat->date }}</td>
                                <td style="font-weight: bold;">{{ $stat->site }}</td>
                                <td style="font-weight: bold;">{{ $stat->tag }}</td>
                                <td style="font-weight: bold;">{{ $stat->impressions }}</td>
                                <td style="font-weight: bold;">{{ $stat->served }}</td>
                                <!-- <td style="font-weight: bold;">{{ $stat->fill }}%</td> -->
                                <td style="font-weight: bold;">{{ number_format($stat->served / $stat->impressions * 100, 2, '.', '') }}%</td>
                                <td style="font-weight: bold;">${{ $stat->income }}</td>
                                <!-- <td style="font-weight: bold;">${{ $stat->ecpm }}</td> -->
                                <td style="font-weight: bold;">${{ number_format($stat->income / $stat->served * 1000, 2, '.', '') }}</td>
                            </tr>
                            @else
                            <tr>
                                <td>{{ $stat->date }}</td>
                                <td>{{ $stat->site }}</td>
                                <td>{{ $stat->tag }}</td>
                                <td>{{ $stat->impressions }}</td>
                                <td>{{ $stat->served }}</td>
                                <!-- <td>{{ $stat->fill }}%</td> -->
                                <td>
                                    @if($stat->impressions==0 || $stat->served==0 )
                                        0,00%
                                    @else
                                        {{ number_format($stat->served / $stat->impressions * 100, 2, '.', '') }}%
                                    @endif
                                </td>
                                <td>${{ $stat->income }}</td>
                                <!-- <td>${{ $stat->ecpm }}</td> -->

                                <td>
                                    @if($stat->impressions==0 || $stat->served==0 )
                                        $0.00
                                    @else
                                        ${{ number_format($stat->income / $stat->served * 1000, 2, '.', '') }}
                                    @endif
                                </td>
                            </tr>
                            @endif
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
