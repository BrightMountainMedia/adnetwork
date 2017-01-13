function adminAddArticleForm () {
    return {
        article_id: 0,
        image_url: '',
        title: '',
        permalink: '',
        status: 0,
    };
}

Vue.component('add-article', {
    /**
     * The component's data.
     */
    data() {
        return {
            addingArticle: false,
            articleForm: new BMTMForm(adminAddArticleForm())
        };
    },

    /**
     * The component has been created by Vue.
     */
    created() {
        var self = this;

        Bus.$on('addArticle', function () {
            self.articleForm = new BMTMForm(adminAddArticleForm());

            self.addingArticle = true;

            $('#modal-add-article').modal('show');
        });
    },

    methods: {
        /**
         * Save the article
         */
        saveArticle() {
            this.$http.post('/admin/article/add_article', this.articleForm)
                .then(response => {
                    this.addingArticle = false;
                    $('#modal-add-article').modal('hide');
                });
        }
    }
});