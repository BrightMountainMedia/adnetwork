@extends('layouts.app')

@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/mousetrap/1.4.6/mousetrap.min.js"></script>
@endsection

@section('content')
<admin-settings inline-template>
    <div class="container">
        <div class="row">
            @if(Session::has('error'))
            <div class="col-md-12">
                <div class="panel panel-danger">
                    <div class="panel-heading">Error: {{ Session::get('error') }}</div>
                </div>
            </div>
            @endif

            <!-- Tabs -->
            <div class="col-md-4">
                <div class="panel panel-default panel-flush">
                    <div class="panel-heading">
                        Admin Settings
                    </div>

                    <div class="panel-body">
                        <div class="admin-settings-tabs">
                            <ul class="nav admin-settings-stacked-tabs" role="tablist">
                                <!-- Publishers Link -->
                                <li role="presentation">
                                    <a href="#publisher" aria-controls="publisher" role="tab" data-toggle="tab">
                                        <i class="fa fa-fw fa-btn fa-user-plus"></i> Publishers
                                    </a>
                                </li>

                                <!-- Widget Link -->
                                <li role="presentation">
                                    <a href="#widget" aria-controls="widget" role="tab" data-toggle="tab">
                                        <i class="fa fa-fw fa-btn fa-qrcode"></i> Widget
                                    </a>
                                </li>

                                <!-- Widget Link -->
                                <li role="presentation">
                                    <a href="#article" aria-controls="article" role="tab" data-toggle="tab">
                                        <i class="fa fa-fw fa-btn fa-newspaper-o"></i> Articles
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tab Panels -->
            <div class="col-md-8">
                <div class="tab-content">
                    <!-- Publishers -->
                    <div role="tabpanel" class="tab-pane active" id="publisher">
                        @include('admin.publishers')
                    </div>

                    <!-- Widget Settings -->
                    <div role="tabpanel" class="tab-pane active" id="widget">
                        @include('admin.widget-settings')
                    </div>

                    <!-- Articles -->
                    <div role="tabpanel" class="tab-pane" id="article">
                        @include('admin.articles')
                    </div>
                </div>
            </div>
        </div>
    </div>
</admin-settings>
@endsection
