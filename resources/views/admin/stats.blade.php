@extends('layouts.app')

@section('content')
<stats inline-template>
	<div>
		<div class="container">
		    <div class="row">
		        <div class="col-md-12">
			        <div class="panel panel-default" v-show=" ! showingPublisherProfile">
			            <div class="panel-heading">
			            	Publishers 
			            	(
			            		@if ( method_exists($publishers, 'total') )
			            			{{ $publishers->total() }}
			            		@else
			            			{{ count($publishers) }}
			            		@endif
			            	)
			            </div>

			            <div class="panel-body">
			                @if (Session::has('success'))
		                        <div class="alert alert-success">
		                          {{Session::get('success')}}
		                        </div>
		                    @endif

			                <ul class="list-group">
			                    @foreach ($publishers as $publisher)
			                    <li class="list-group-item" @click.prevent="showPublisherProfile({{ $publisher->id }})">
			                        {{ $publisher->first_name }} {{ $publisher->last_name }}
			                    </li>
			                    @endforeach
			                </ul>

			                @if ( method_exists($publishers, 'links') )
			                	{{ $publishers->links() }}
			                @endif
			            </div>
			        </div>

					<!-- Publisher Profile Detail -->
				    <div v-show="showingPublisherProfile">
				        <div class="row" v-if="loading">
				            <div class="col-sm-12">
				                <div class="panel panel-default">
				                    <div class="panel-body">
				                        <i class="fa fa-btn fa-spinner fa-spin"></i>Loading
				                    </div>
				                </div>
				            </div>
				        </div>

				        <div v-if=" ! loading && publisher">
				            <div class="row">
				                <div class="col-sm-12">
				                    <div class="panel panel-default" v-if="stats">
				                        <div class="panel-heading">
				                            <i class="fa fa-btn fa-close" style="cursor: pointer; color: red;" @click="showPublishers()"></i> 
				                            @{{ publisher.first_name }} @{{ publisher.last_name }} Stats
				                        </div>

				                        <div class="panel-body">
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
		                                    		<tr v-for="stat in stats">
		                                    			<td>@{{ stat.date }}</td>
		                                    			<td>@{{ stat.site }}</td>
		                                    			<td>@{{ stat.tag }}</td>
		                                    			<td>@{{ stat.impressions }}</td>
		                                    			<td>@{{ stat.served }}</td>
		                                    			<td>@{{ stat.fill }}%</td>
		                                    			<td>$@{{ stat.income }}</td>
		                                    			<td>$@{{ stat.ecpm }}</td>
		                                    		</tr>
		                                    	</tbody>
		                                    </table>
				                        </div>
				                    </div>

				                    <div class="panel panel-default">
				                    	<div class="panel-heading">Add Stats</div>

				                    	<div class="panel-body">
				                    		<!-- Success Message -->
								            <div class="alert alert-success" v-if="statsForm.successful">
								                Your publisher stats have been added!
								            </div>

								            <form class="form-horizontal" role="form">
								                {{ csrf_field() }}
								                <input type="hidden" name="user_id" v-model="statsForm.user_id">

								                <!-- Date -->
								                <div class="form-group" :class="{'has-error': statsForm.errors.has('date')}">
								                    <label class="col-sm-4 control-label">Date</label>

								                    <div class="col-sm-8">
								                        <input type="date" class="form-control" name="date" v-model="statsForm.date" placeholder="YYYY-MM-DD">

								                        <span class="help-block" v-show="statsForm.errors.has('date')">
								                            @{{ statsForm.errors.get('date') }}
								                        </span>
								                    </div>
								                </div>

								                <div class="clearfix"></div>

								                <!-- Site -->
								                <div class="form-group" :class="{'has-error': statsForm.errors.has('site')}">
								                    <label class="col-sm-4 control-label">Site</label>

								                    <div class="col-sm-8">
								                        <input type="text" class="form-control" name="site" v-model="statsForm.site">

								                        <span class="help-block" v-show="statsForm.errors.has('site')">
								                            @{{ statsForm.errors.get('site') }}
								                        </span>
								                    </div>
								                </div>

								                <div class="clearfix"></div>

								                <!-- Impressions -->
								                <div class="form-group" :class="{'has-error': statsForm.errors.has('impressions')}">
								                    <label class="col-sm-4 control-label">Impressions</label>

								                    <div class="col-sm-8">
								                        <input type="text" class="form-control" name="impressions" v-model="statsForm.impressions">

								                        <span class="help-block" v-show="statsForm.errors.has('impressions')">
								                            @{{ statsForm.errors.get('impressions') }}
								                        </span>
								                    </div>
								                </div>

								                <div class="clearfix"></div>

								                <!-- Served -->
								                <div class="form-group" :class="{'has-error': statsForm.errors.has('served')}">
								                    <label class="col-sm-4 control-label">Served</label>

								                    <div class="col-sm-8">
								                        <input type="text" class="form-control" name="served" v-model="statsForm.served">

								                        <span class="help-block" v-show="statsForm.errors.has('served')">
								                            @{{ statsForm.errors.get('served') }}
								                        </span>
								                    </div>
								                </div>

								                <div class="clearfix"></div>

								                <!-- Fill -->
								                <div class="form-group" :class="{'has-error': statsForm.errors.has('fill')}">
								                    <label class="col-sm-4 control-label">Fill</label>

								                    <div class="col-sm-8">
								                        <input type="text" class="form-control" name="fill" v-model="statsForm.fill">

								                        <span class="help-block" v-show="statsForm.errors.has('fill')">
								                            @{{ statsForm.errors.get('fill') }}
								                        </span>
								                    </div>
								                </div>

								                <div class="clearfix"></div>

								                <!-- Income -->
								                <div class="form-group" :class="{'has-error': statsForm.errors.has('income')}">
								                    <label class="col-sm-4 control-label">Income</label>

								                    <div class="col-sm-8">
								                        <input type="text" class="form-control" name="income" v-model="statsForm.income">

								                        <span class="help-block" v-show="statsForm.errors.has('income')">
								                            @{{ statsForm.errors.get('income') }}
								                        </span>
								                    </div>
								                </div>

								                <div class="clearfix"></div>

								                <!-- eCPM -->
								                <div class="form-group" :class="{'has-error': statsForm.errors.has('ecpm')}">
								                    <label class="col-sm-4 control-label">eCPM</label>

								                    <div class="col-sm-8">
								                        <input type="text" class="form-control" name="tag" v-model="statsForm.ecpm">

								                        <span class="help-block" v-show="statsForm.errors.has('ecpm')">
								                            @{{ statsForm.errors.get('ecpm') }}
								                        </span>
								                    </div>
								                </div>

								                <div class="clearfix"></div>

								                <!-- Tag -->
								                <div class="form-group" :class="{'has-error': statsForm.errors.has('tag')}">
								                    <label class="col-sm-4 control-label">Tag</label>

								                    <div class="col-sm-8">
								                        <input type="text" class="form-control" name="tag" v-model="statsForm.tag">

								                        <span class="help-block" v-show="statsForm.errors.has('tag')">
								                            @{{ statsForm.errors.get('tag') }}
								                        </span>
								                    </div>
								                </div>

								                <div class="clearfix"></div>

								                <!-- Add Stats -->
								                <div class="form-group">
								                    <div class="col-md-offset-4 col-md-6">
								                        <button type="submit" class="btn btn-primary"
								                                @click.prevent="addStats"
								                                :disabled="statsForm.busy">

								                            Add Stats
								                        </button>
								                    </div>
								                </div>

								            </form>
				                    	</div>
				                    </div>
				                </div>
				            </div>
				        </div>
				    </div>

			    </div>
			</div>
		</div>
    </div>
</stats>
@endsection