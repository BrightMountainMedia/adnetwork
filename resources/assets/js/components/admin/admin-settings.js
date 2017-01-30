Vue.component('admin-settings', {
    /**
     * Load mixins for the component.
     */
    mixins: [require('./../mixins/tab-state')],

    /**
     * The component's data.
     */
    data() {
        return {
            publishers: [],
            articles: [],
            other_articles: [],
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
        this.whenReady();
    },

    methods: {
        /**
         * Finish bootstrapping the application.
         */
        whenReady() {
            this.usePushStateForTabs('.admin-settings-tabs');
            this.getPublishers();
            this.getWidgetArticles();
            this.getOtherArticles();
        },

        /**
         * Get the publishers
         */
        getPublishers() {
            this.$http.get('/admin/publishers')
                .then(response => {
                    this.publishers = response.data.publishers;
                });
        },

        /**
         * Get the widget articles
         */
        getWidgetArticles() {
            this.$http.get('/api/widget_articles')
                .then(response => {
                    this.articles = response.data;
                });
        },

        /**
         * Get the other articles
         */
        getOtherArticles() {
            this.$http.get('/admin/other_articles')
                .then(response => {
                    this.other_articles = response.data.articles;
                });
        }
    }
});