Vue.component('articles', {
    /**
     * The component's data.
     */
    data() {
        return {
            articles: [],
        };
    },

    /**
     * The component has been created by Vue.
     */
    created() {
        var self = this;

        Bus.$on('getArticles', function () {
            self.getArticles();
        });
    },

    /**
     * Prepare the component.
     */
    mounted() {
        this.getArticles();
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
         * Get the articles
         */
        getArticles() {
            this.$http.get('/admin/articles')
                .then(response => {
                    this.articles = response.data.articles;
                });
        }
    }
});