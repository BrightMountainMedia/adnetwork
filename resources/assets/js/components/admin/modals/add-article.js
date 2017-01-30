function adminAddArticleForm () {
    return {
        article_id: 0,
        image_url: '',
        title: '',
        permalink: '',
        order: 0,
        widget: 0
    };
}

Vue.component('add-article', {
    /**
     * The component's data.
     */
    data() {
        return {
            addingArticle: false,
            
            order_options: [
                { text: 'N/A', value: '0' },
                { text: '1', value: '1' },
                { text: '2', value: '2' },
                { text: '3', value: '3' },
                { text: '4', value: '4' },
                { text: '5', value: '5' }
            ],
            widget_options: [
                { text: 'In Widget', value: '1' },
                { text: 'Not In Widget', value: '0' }
            ],

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
                    
                    Bus.$emit('updateWidgetArticles');
                    Bus.$emit('updateOtherArticles');
                });
        }
    }
});