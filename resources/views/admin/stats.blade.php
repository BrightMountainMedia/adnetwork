@extends('layouts.app')

@section('content')
<stats inline-template>
	<div>
		<div class="container">
		    <div class="row">
		        <div class="col-md-12">
			        <div class="panel panel-default" v-show=" ! showingPublisherProfile">
			            <div class="panel-heading">
			            	Add Publisher
			            </div>

			            <div class="panel-body">
			                <form class="form-horizontal" role="form" method="POST" action="{{ url('/register') }}">
		                        {{ csrf_field() }}

		                        <div class="form-group{{ $errors->has('first_name') ? ' has-error' : '' }}">
		                            <label for="first_name" class="col-md-4 control-label">First Name</label>

		                            <div class="col-md-6">
		                                <input id="first_name" type="text" class="form-control" name="first_name" value="{{ old('first_name') }}" required autofocus>

		                                @if ($errors->has('first_name'))
		                                    <span class="help-block">
		                                        <strong>{{ $errors->first('first_name') }}</strong>
		                                    </span>
		                                @endif
		                            </div>
		                        </div>

		                        <div class="form-group{{ $errors->has('last_name') ? ' has-error' : '' }}">
		                            <label for="last_name" class="col-md-4 control-label">Last Name</label>

		                            <div class="col-md-6">
		                                <input id="last_name" type="text" class="form-control" name="last_name" value="{{ old('last_name') }}" required autofocus>

		                                @if ($errors->has('last_name'))
		                                    <span class="help-block">
		                                        <strong>{{ $errors->first('last_name') }}</strong>
		                                    </span>
		                                @endif
		                            </div>
		                        </div>

		                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
		                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

		                            <div class="col-md-6">
		                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

		                                @if ($errors->has('email'))
		                                    <span class="help-block">
		                                        <strong>{{ $errors->first('email') }}</strong>
		                                    </span>
		                                @endif
		                            </div>
		                        </div>

		                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
		                            <label for="password" class="col-md-4 control-label">Password</label>

		                            <div class="col-md-6">
		                                <input id="password" type="password" class="form-control" name="password" required>

		                                @if ($errors->has('password'))
		                                    <span class="help-block">
		                                        <strong>{{ $errors->first('password') }}</strong>
		                                    </span>
		                                @endif
		                            </div>
		                        </div>

		                        <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
		                            <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>

		                            <div class="col-md-6">
		                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>

		                                @if ($errors->has('password_confirmation'))
		                                    <span class="help-block">
		                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
		                                    </span>
		                                @endif
		                            </div>
		                        </div>

		                        <div class="form-group">
		                            <div class="col-md-6 col-md-offset-4">
		                                <button type="submit" class="btn btn-primary">
		                                    Register
		                                </button>
		                            </div>
		                        </div>
		                    </form>
			            </div>
			        </div>

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
				    <div v-show="showingPublisherProfile" style="display: none;">
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
								                        <div class="input-group">
								                        	<input type="text" class="form-control" name="fill" v-model="statsForm.fill">
								                        	<div class="input-group-addon">%</div>
								                        </div>

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
								                    	<div class="input-group">
								                        	<div class="input-group-addon">$</div>
								                        	<input type="text" class="form-control" name="income" v-model="statsForm.income">
								                        </div>

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
								                    	<div class="input-group">
								                        	<div class="input-group-addon">$</div>
								                        	<input type="text" class="form-control" name="tag" v-model="statsForm.ecpm">
								                        </div>

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

				                    <div class="panel panel-default" v-if="stats">
				                        <div class="panel-heading">
				                            <i class="fa fa-btn fa-close" style="cursor: pointer; color: red;" @click="showPublishers()"></i> 
				                            @{{ publisher.first_name }} @{{ publisher.last_name }} Stats
				                        </div>

				                        <div class="panel-body">
		                                    <div v-if="stats.length">
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
			                                    			<td style="font-weight: bold" v-if="stat.tag.includes('Total')">@{{ stat.date }}</td>
			                                    			<td v-else>@{{ stat.date }}</td>
			                                    			<td style="font-weight: bold" v-if="stat.tag.includes('Total')">@{{ stat.site }}</td>
			                                    			<td v-else>@{{ stat.site }}</td>
			                                    			<td style="font-weight: bold" v-if="stat.tag.includes('Total')">@{{ stat.tag }}</td>
			                                    			<td v-else>@{{ stat.tag }}</td>
			                                    			<td style="font-weight: bold" v-if="stat.tag.includes('Total')">@{{ stat.impressions }}</td>
			                                    			<td v-else>@{{ stat.impressions }}</td>
			                                    			<td style="font-weight: bold" v-if="stat.tag.includes('Total')">@{{ stat.served }}</td>
			                                    			<td v-else>@{{ stat.served }}</td>
			                                    			<td style="font-weight: bold" v-if="stat.tag.includes('Total')">@{{ stat.fill }}%</td>
			                                    			<td v-else>@{{ stat.fill }}%</td>
			                                    			<td style="font-weight: bold" v-if="stat.tag.includes('Total')">$@{{ stat.income }}</td>
			                                    			<td v-else>$@{{ stat.income }}</td>
			                                    			<td style="font-weight: bold" v-if="stat.tag.includes('Total')">$@{{ stat.ecpm }}</td>
			                                    			<td v-else>$@{{ stat.ecpm }}</td>
			                                    		</tr>
			                                    	</tbody>
			                                    </table>
			                                </div>
			                                <div v-else>
			                                	<p>This publisher doesn't currently have any stats to display.</p>
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
    </div>
</stats>
@endsection