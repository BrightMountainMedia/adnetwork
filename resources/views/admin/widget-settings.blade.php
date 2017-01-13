<widget-settings inline-template>
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
                    <div class="form-group" :class="{'has-error': form.errors.has('title')}">
                        <label class="col-sm-4 control-label" for="title">Widget Title</label>

                        <div class="col-sm-8">
                            <input type="text" class="form-control" name="title" id="title" v-model="form.title">

                            <span class="help-block" v-show="form.errors.has('title')">
                                @{{ form.errors.get('title') }}
                            </span>
                        </div>
                    </div>

                    <div class="clearfix"></div>

                    <!-- Article Count -->
                    <div class="form-group" :class="{'has-error': form.errors.has('count')}">
                        <label class="col-sm-4 control-label" for="count">Article Count</label>

                        <div class="col-sm-8">
                            <input type="text" class="form-control" name="count" id="count" v-model="form.count">

                            <span class="help-block" v-show="form.errors.has('count')">
                                @{{ form.errors.get('count') }}
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
        <div class="panel panel-default">
            <div class="panel-heading">Widget Example</div>

            <div class="panel-body">
                <div class="widget">
                    <h2 class="widget-title">@{{ title }}</h1>
                    <div class="widget-content">
                        <article class="widget-article" v-for="article in articles">
                            <div class="article-image">
                                <a :href="article.permalink" :title="article.title" target="_blank">
                                    <img :src="article.image_url" :alt="article.title" />
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
</widget-settings>