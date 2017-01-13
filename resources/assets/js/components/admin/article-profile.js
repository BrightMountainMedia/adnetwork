Vue.component('article-profile', {
    /**
     * The component's data.
     */
    data() {
        return {
            loading: false,
            article: null,
            error: null,
            form: new BMTMForm({})
        };
    },

    /**
     * The component has been created by Vue.
     */
    created() {
        var self = this;

        Bus.$on('showArticleProfile', function(id) {
            self.getArticleProfile(id);
        });
    },

    /**
     * Prepare the component.
     */
    mounted() {
        // Mousetrap.bind('esc', e => this.showSearch());
    },

    methods: {
        /**
         * Get the article profile.
         */
        getArticleProfile(id) {
            this.loading = true;
            this.error = null;
            // Mousetrap.bind('esc', e => this.showSearch());

            this.$http.get('/admin/article/' + id + '/article_profile')
                .then(response => {
                    if ( response.data.article ) {
                        this.article = response.data.article;
                        this.loading = false;
                    } else if ( response.data.error ) {
                        this.error = response.data.error;
                        this.article = null;
                        this.loading = false;
                    }
                });
        },

        /**
         * Show the search results and hide the department profile.
         */
        showSearch() {
            Bus.$emit('showSearch');

            this.article = null;
        }
    },

    computed: {
        view() {
            return '/article/' + this.article.id;
        }
    }
});
