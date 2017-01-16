Vue.component('articles', {
    /**
     * The component's data.
     */
    data() {
        return {
            widgetArticles: [],
            otherArticles: [],
        };
    },

    /**
     * The component has been created by Vue.
     */
    created() {
        var self = this;

        Bus.$on('updateWidgetArticles', function () {
            self.getWidgetArticles();
        });

        Bus.$on('updateOtherArticles', function () {
            self.getOtherArticles();
        });
    },

    /**
     * Prepare the component.
     */
    mounted() {
        this.getWidgetArticles();
        this.getOtherArticles();
    },

    methods: {
        /**
         * Show the article modal.
         */
        addArticle() {
            Bus.$emit('addArticle');
        },

        /**
         * Edit the article modal.
         */
        editArticle(article) {
            Bus.$emit('editArticle', article);
        },

        /**
         * Get the widget articles
         */
        getWidgetArticles() {
            this.$http.get('/admin/widget_articles')
                .then(response => {
                    this.widgetArticles = response.data.articles;
                });
        },

        /**
         * Get the other articles
         */
        getOtherArticles() {
            this.$http.get('/admin/other_articles')
                .then(response => {
                    this.otherArticles = response.data.articles;
                });
        }
    }
});