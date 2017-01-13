<add-article inline-template>
    <div>
        <div class="modal fade" id="modal-add-article" tabindex="-1" role="dialog">
            <div class="modal-dialog" v-if="addingArticle">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button " class="close" data-dismiss="modal" aria-hidden="true">&times;</button>

                        <h4 class="modal-title">
                            Add Article
                        </h4>
                    </div>

                    <div class="modal-body">
                        <!-- Add Article Form -->
                        <form class="form-horizontal" role="form">
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
                                Save Article
                            </span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</add-article>