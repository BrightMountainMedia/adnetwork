<articles inline-template>
    <div>
        <div class="panel panel-default panel-flush">
            <!-- Create Button -->
            <button type="submit" class="btn btn-primary btn-block" @click="addArticle()">
                <i class="fa fa-plus"></i> Add Article
            </button>
        </div>

        <!-- List all Articles -->
        <div class="panel panel-default">
            <div class="panel-heading">Articles</div>

            <div class="panel-body">
                <div class="col-sm-6">
                    <article class="article-container" v-for="(article, index) in articles" v-if="index < (articles.length / 2)">
                        <img class="article-image" :src="
                        article.image_url" :alt="article.title" @click="editArticle(article)" />
                        <h3 class="article-title" @click="editArticle(article)">
                            @{{ article.title }}
                        </h3>
                    </article>
                </div>
                <div class="col-sm-6">
                    <article class="article-container" v-for="(article, index) in articles" v-if="index >= (articles.length / 2)">
                        <img class="article-image" :src="
                        article.image_url" :alt="article.title" @click="editArticle(article)" />
                        <h3 class="article-title" @click="editArticle(article)">
                            @{{ article.title }}
                        </h3>
                    </article>
                </div>
            </div>
        </div>

        <div>
            @include('admin.modals.add-article')
        </div>

        <div>
            @include('admin.modals.edit-article')
        </div>
    </div>
</articles>