<add-stat :publisher="publisher" inline-template>
    <div>
        <div class="modal fade" id="modal-add-stat" tabindex="-1" role="dialog">
            <div class="modal-dialog" v-if="addingStat">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button " class="close" data-dismiss="modal" aria-hidden="true">&times;</button>

                        <h4 class="modal-title">
                            Add Stat
                        </h4>
                    </div>

                    <div class="modal-body">
                        <!-- Add Stat Form -->
                        <form class="form-horizontal" role="form">
                            {{ csrf_field() }}
                            <input type="hidden" name="user_id" v-model="statsForm.user_id = publisher.id">

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
                        </form>
                    </div>

                    <!-- Modal Actions -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>

                        <button type="button" class="btn btn-primary" @click="saveStat" :disabled="statsForm.busy">
                            <span v-if="statsForm.busy">
                                <i class="fa fa-btn fa-spinner fa-spin"></i>Adding
                            </span>

                            <span v-else>
                                Save Stat
                            </span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</add-stat>