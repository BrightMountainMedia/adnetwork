Vue.component('widget-settings', {
    /**
     * The component's data.
     */
    data() {
        return {
            form: new BMTMForm({
                title: '',
                count: 0,
            }),

            title: [],
            articles: [],
        };
    },

    /**
     * The component has been created by Vue.
     */
    created() {
        var self = this;

        Bus.$on('updateWidgetSettings', function (article) {
            self.getWidgetSettings();
        });
    },

    /**
     * Prepare the component.
     */
    mounted() {
        this.getWidgetSettings();
    },

    methods: {
        /**
         * Get the widget settings
         */
        getWidgetSettings() {
            this.$http.get('/api/widget_title')
                .then(response => {
                    this.form.title = this.title = response.data;
                });

            this.$http.get('/api/widget_count')
                .then(response => {
                    this.form.count = response.data;
                });

            this.$http.get('/api/widget_articles')
                .then(response => {
                    this.articles = response.data;
                });
        },

        /**
         * Update the widget settings.
         */
        update() {
            this.$http.put('/admin/widget/widget_settings_update', this.form)
                .then(response => {
                    if ( response.data.successful ) {
                        this.form.successful = true;
                        this.title = response.data.title.value;
                        this.articles = response.data.articles;
                        
                        Bus.$emit('updateWidgetArticles');
                        Bus.$emit('updateOtherArticles');
                    } else if ( response.data.error ) {
                        this.form.error = true;
                    }
                });
        }
    }
});