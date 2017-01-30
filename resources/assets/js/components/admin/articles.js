Vue.component('articles', {
    props: ['articles', 'other_articles'],

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
        }
    }
});