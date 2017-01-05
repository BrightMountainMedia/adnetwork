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
        };
    },

    /**
     * The component has been created by Vue.
     */
    created() {
        var self = this;

        Bus.$on('hashChanged', function (hash, parameters) {
            if (hash != 'admin') {
                return true;
            }

            if (parameters && parameters.length > 0) {
                self.loadPublisherProfile({ id: parameters[0] });
            }  else {
                self.showPublishers();
            }

            return true;
        });
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