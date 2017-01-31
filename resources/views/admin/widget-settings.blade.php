<widget-settings :articles="articles" inline-template>
    <div>
        <!-- Widget Settings -->
        <div class="panel panel-default">
            <div class="panel-heading">Widget Settings</div>

            <div class="panel-body">
                <!-- Success Message -->
                <div class="alert alert-success" v-if="form.successful">
                    The Widget Settings have been updated!
                </div>

                <form class="form-horizontal" role="form">
                    <!-- Widget Title -->
                    <div class="form-group" :class="{'has-error': form.errors.has('widget_title')}">
                        <label class="col-sm-4 control-label" for="widget_title">Widget Title</label>

                        <div class="col-sm-8">
                            <input type="text" class="form-control" name="widget_title" id="widget_title" v-model="form.widget_title">

                            <span class="help-block" v-show="form.errors.has('widget_title')">
                                @{{ form.errors.get('widget_title') }}
                            </span>
                        </div>
                    </div>

                    <div class="clearfix"></div>

                    <!-- Article Count -->
                    <div class="form-group" :class="{'has-error': form.errors.has('widget_count')}">
                        <label class="col-sm-4 control-label" for="widget_count">Article Count</label>

                        <div class="col-sm-8">
                            <input type="text" class="form-control" name="widget_count" id="widget_count" v-model="form.widget_count">

                            <span class="help-block" v-show="form.errors.has('widget_count')">
                                @{{ form.errors.get('widget_count') }}
                            </span>
                        </div>
                    </div>

                    <div class="clearfix"></div>

                    <!-- Update Button -->
                    <div class="form-group">
                        <div class="col-md-offset-4 col-md-6">
                            <button type="submit" class="btn btn-primary"
                                    @click.prevent="update"
                                    :disabled="form.busy">

                                Update Widget Settings
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Widget Example -->
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">Widget Example</div>

                <div class="panel-body">
                    <div class="widget">
                        <h2 class="widget-title">@{{ title }}</h2>
                        <div class="widget-content">
                            <article class="widget-article" v-for="article in articles">
                                <div class="article-image">
                                    <a :href="article.permalink" :title="article.title" target="_blank">
                                        <span class="image" :style="{ 'background-image': 'url(' + article.image_url + ')' }"></span>
                                    </a>
                                </div>
                                <div class="title-container">
                                    <h3 class="article-title">
                                        <a :href="article.permalink" :title="article.title" target="_blank">
                                            @{{ article.title }}
                                        </a>
                                    </h3>
                                </div>
                            </article>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</widget-settings>