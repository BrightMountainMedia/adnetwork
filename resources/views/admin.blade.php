@extends('layouts.app')

@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/mousetrap/1.4.6/mousetrap.min.js"></script>
@endsection

@section('content')
<admin-settings :user="user" inline-template>
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
                                <!-- Roles Link -->
                                <!-- <li role="presentation">
                                    <a href="#role" aria-controls="role" role="tab" data-toggle="tab">
                                        <i class="fa fa-fw fa-btn fa-group"></i> Roles
                                    </a>
                                </li> -->

                                <!-- Publishers Link -->
                                <li role="presentation" v-show="publishers[0]">
                                    <a href="#publisher" aria-controls="publisher" role="tab" data-toggle="tab">
                                        <i class="fa fa-fw fa-btn fa-user-plus"></i> Publishers
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
                    <!-- Roles -->
                    <!-- <div role="tabpanel" class="tab-pane active" id="role">
                        @include('admin.roles')
                    </div> -->

                    <!-- Publishers -->
                    <div role="tabpanel" class="tab-pane active" id="publisher" v-show="publishers[0]">
                        @include('admin.publishers')
                    </div>
                </div>
            </div>
        </div>
    </div>
</admin-settings>
@endsection
