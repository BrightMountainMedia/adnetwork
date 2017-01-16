function adminEditArticleForm (article) {
    if ( article ) {
        return {
            article_id: article.id,
            image_url: article.image_url,
            title: article.title,
            permalink: article.permalink,
            widget: article.widget,
            active: article.active,
        };
    } else {
        return {
            article_id: 0,
            image_url: '',
            title: '',
            permalink: '',
            widget: 0,
            active: 0,
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

            active_options: [
                { text: 'Active', value: '1' },
                { text: 'Not Active', value: '0' }
            ],
            widget_options: [
                { text: 'In Widget', value: '1' },
                { text: 'Not In Widget', value: '0' }
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
                    if ( response.data.confirm ) {
                        var result = window.confirm(response.data.confirm);
                        if ( result == true ) {
                            this.$http.put('/admin/confirmed/article/' + response.data.article_id + '/edit_article', response.data.request)
                                .then(response => {
                                    this.editingArticle = false;

                                    $('#modal-edit-article').modal('hide');

                                    Bus.$emit('updateWidgetArticles');
                                    Bus.$emit('updateOtherArticles');
                                    Bus.$emit('updateWidgetSettings');
                                });
                        } else {
                            this.editingArticle = false;

                            $('#modal-edit-article').modal('hide');

                            Bus.$emit('updateWidgetArticles');
                            Bus.$emit('updateOtherArticles');
                            Bus.$emit('updateWidgetSettings');
                        }
                    }

                    if ( response.data.article ) {
                        this.editingArticle = false;

                        $('#modal-edit-article').modal('hide');

                        Bus.$emit('updateWidgetArticles');
                        Bus.$emit('updateOtherArticles');
                        Bus.$emit('updateWidgetSettings');
                    }
                });
        }
    }
});