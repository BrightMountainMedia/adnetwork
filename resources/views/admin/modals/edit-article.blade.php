<edit-article inline-template>
    <div>
        <div class="modal fade" id="modal-edit-article" tabindex="-1" role="dialog">
            <div class="modal-dialog" v-if="editingArticle">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button " class="close" data-dismiss="modal" aria-hidden="true">&times;</button>

                        <h4 class="modal-title">
                            Edit Article
                        </h4>
                    </div>

                    <div class="modal-body">
                        <!-- Add Article Form -->
                        <form class="form-horizontal" role="form" enctype="multipart/form-data">
                            {{ csrf_field() }}

                            <!-- Title -->
                            <div class="form-group" :class="{'has-error': articleForm.errors.has('title')}">
                                <label class="col-sm-4 control-label">Title</label>

                                <div class="col-sm-8">
                                    <input type="text" class="form-control" name="title" v-model="articleForm.title">

                                    <span class="help-block" v-show="articleForm.errors.has('title')">
                                        @{{ articleForm.errors.get('title') }}
                                    </span>
                                </div>
                            </div>

                            <div class="clearfix"></div>

                            <!-- Article Link -->
                            <div class="form-group" :class="{'has-error': articleForm.errors.has('permalink')}">
                                <label class="col-sm-4 control-label">Article Link</label>

                                <div class="col-sm-8">
                                    <input type="text" class="form-control" name="permalink" v-model="articleForm.permalink">

                                    <span class="help-block" v-show="articleForm.errors.has('permalink')">
                                        @{{ articleForm.errors.get('permalink') }}
                                    </span>
                                </div>
                            </div>

                            <div class="clearfix"></div>

                            <!-- Image URL -->
                            <div class="form-group" :class="{'has-error': articleForm.errors.has('image_url')}">
                                <label class="col-sm-4 control-label">Image URL</label>

                                <div class="col-sm-8">
                                    <input type="text" class="form-control" name="image_url" v-model="articleForm.image_url">

                                    <span class="help-block" v-show="articleForm.errors.has('image_url')">
                                        @{{ articleForm.errors.get('image_url') }}
                                    </span>
                                </div>
                            </div>

                            <div class="clearfix"></div>

                            <!-- Order -->
                            <div class="form-group" :class="{'has-error': articleForm.errors.has('widget')}">
                                <label class="col-sm-4 control-label">Order</label>

                                <div class="col-sm-8">
                                    <select class="form-control" name="order" v-model="articleForm.order">
                                        <option v-for="order_option in order_options" v-bind:value="order_option.value">
                                            @{{ order_option.text }}
                                        </option>
                                    </select>

                                    <span class="help-block" v-show="articleForm.errors.has('order')">
                                        @{{ articleForm.errors.get('order') }}
                                    </span>
                                </div>
                            </div>

                            <div class="clearfix"></div>

                            <!-- Widget -->
                            <div class="form-group" :class="{'has-error': articleForm.errors.has('widget')}">
                                <label class="col-sm-4 control-label">Widget</label>

                                <div class="col-sm-8">
                                    <select class="form-control" name="widget" v-model="articleForm.widget">
                                        <option v-for="widget_option in widget_options" v-bind:value="widget_option.value">
                                            @{{ widget_option.text }}
                                        </option>
                                    </select>

                                    <span class="help-block" v-show="articleForm.errors.has('widget')">
                                        @{{ articleForm.errors.get('widget') }}
                                    </span>
                                </div>
                            </div>

                            <div class="clearfix"></div>

                            <!-- Active -->
                            <div class="form-group" :class="{'has-error': articleForm.errors.has('active')}">
                                <label class="col-sm-4 control-label">Active</label>

                                <div class="col-sm-8">
                                    <select class="form-control" name="active" v-model="articleForm.active">
                                        <option v-for="active_option in active_options" v-bind:value="active_option.value">
                                            @{{ active_option.text }}
                                        </option>
                                    </select>

                                    <span class="help-block" v-show="articleForm.errors.has('active')">
                                        @{{ articleForm.errors.get('active') }}
                                    </span>
                                </div>
                            </div>

                            <div class="clearfix"></div>
                        </form>
                    </div>

                    <!-- Modal Actions -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>

                        <button type="button" class="btn btn-primary" @click="saveArticle" :disabled="articleForm.busy">
                            <span v-if="articleForm.busy">
                                <i class="fa fa-btn fa-spinner fa-spin"></i>Adding
                            </span>

                            <span v-else>
                                Update Article
                            </span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</edit-article>