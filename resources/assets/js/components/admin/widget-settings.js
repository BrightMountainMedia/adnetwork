Vue.component('widget-settings', {
    props: ['articles'],

    /**
     * The component's data.
     */
    data() {
        return {
            form: new BMTMForm({
                widget_title: '',
                widget_count: 0,
            }),
            title: '',
            count: 0,
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
                    this.form.widget_title = this.title = response.data;
                });

            this.$http.get('/api/widget_count')
                .then(response => {
                    this.form.widget_count = this.count = response.data;
                });
        },

        /**
         * Update the widget settings.
         */
        update() {
            this.$http.post('/admin/widget/widget_settings_update', this.form)
                .then(response => {
                    if ( response.data.successful ) {
                        this.form.successful = true;

                        Bus.$emit('updateWidgetSettings');
                        Bus.$emit('updateWidgetArticles');
                        Bus.$emit('updateOtherArticles');
                    } else if ( response.data.error ) {
                        this.form.error = true;
                    }
                });
        }
    }
});