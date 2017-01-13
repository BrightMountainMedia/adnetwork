<article-profile inline-template>
    <div>
        <div class="row" v-if="loading">
            <div class="col-sm-12">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <i class="fa fa-btn fa-spinner fa-spin"></i>Loading
                    </div>
                </div>
            </div>
        </div>

        <div v-if=" ! loading && article">
            <div class="row">
                <div class="col-sm-12">
                    <div class="panel panel-default" v-if="article">
                        <div class="panel-heading">
                            @{{ article.title }}
                        </div>

                        <div class="panel-body">
                            <a :href="article.permalink" :title="article.title">
                                <img :src="article.image_url" :alt="article.title" class="article-image" />
                                <h2 class="article-title">@{{ article.title }}</h2>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</article-profile>