Vue.component('admin-settings', {
    props: ['user'],

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

            showingArticles: false,
        };
    },

    /**
     * Prepare the component.
     */
    mounted() {
        this.usePushStateForTabs('.admin-settings-tabs');
        this.getPublishers();
    },

    methods: {
        /**
         * Get the publishers
         */
        getPublishers() {
            this.$http.get('/admin/publishers')
                .then(response => {
                    this.publishers = response.data.publishers;
                });
        }
    }
});