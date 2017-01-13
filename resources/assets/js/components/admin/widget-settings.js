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
            this.$http.get('/admin/widget_settings')
                .then(response => {
                    this.form.title = this.title = response.data.widget_title.value;
                    this.form.count = response.data.widget_count.value;
                    this.articles = response.data.articles;
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
                    } else if ( response.data.error ) {
                        this.form.error = true;
                    }
                });
        }
    }
});