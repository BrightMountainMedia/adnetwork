function adminEditArticleForm (article) {
    if ( article ) {
        return {
            article_id: article.id,
            image_url: article.image_url,
            title: article.title,
            permalink: article.permalink,
            status: article.status,
        };
    } else {
        return {
            article_id: 0,
            image_url: '',
            title: '',
            permalink: '',
            status: 0,
        };
    }
}

Vue.component('edit-article', {
    /**
     * The component's data.
     */
    data() {
        return {
            editingArticle: false,

            status_options: [
                { text: 'Active', value: '1' },
                { text: 'Not Active', value: '0' }
            ],

            articleForm: new BMTMForm(adminEditArticleForm())
        };
    },

    /**
     * The component has been created by Vue.
     */
    created() {
        var self = this;

        Bus.$on('editArticle', function (article) {
            self.articleForm = new BMTMForm(adminEditArticleForm(article));

            self.editingArticle = true;

            $('#modal-edit-article').modal('show');
        });
    },

    methods: {
        /**
         * Save the article
         */
        saveArticle() {
            this.$http.put('/admin/article/' + this.articleForm.article_id + '/edit_article', this.articleForm)
                .then(response => {
                    this.editingArticle = false;

                    $('#modal-edit-article').modal('hide');

                    Bus.$emit('getArticles');
                    Bus.$emit('updateWidgetSettings');
                });
        }
    }
});