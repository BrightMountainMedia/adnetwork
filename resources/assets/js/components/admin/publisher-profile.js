Vue.component('publisher-profile', {
    /**
     * The component's data.
     */
    data() {
        return {
            loading: false,
            publisher: null,
            stats: null,
            error: null,
        };
    },

    /**
     * The component has been created by Vue.
     */
    created() {
        var self = this;

        Bus.$on('showPublisherProfile', function(id) {
            self.getPublisherProfile(id);
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
         * Show the stat modal.
         */
        addStat() {
            Bus.$emit('addStat', this.publisher);
        },

        /**
         * Get the publisher profile.
         */
        getPublisherProfile(id) {
            this.loading = true;
            this.error = null;
            // Mousetrap.bind('esc', e => this.showSearch());

            this.$http.get('/admin/publisher/' + id + '/publisher_profile')
                .then(response => {
                    if ( response.data.publisher && response.data.stats ) {
                        this.publisher = response.data.publisher;
                        this.stats = response.data.stats;
                        this.loading = false;
                    } else if ( response.data.error ) {
                        this.error = response.data.error;
                        this.department = null;
                        this.positions = null;
                        this.loading = false;
                    }
                });
        },

        /**
         * Show the search results and hide the department profile.
         */
        showSearch() {
            Bus.$emit('showSearch');

            this.publisher = null;
        },

        /**
         * Show the stat profile and hide the publisher profile.
         */
        showStat(stat) {
            Bus.$emit('showStat', stat);

            this.publisher = null;
        },

        fill_rate(stat) {
            return stat.served / stat.impressions * 100;
        },

        eCPM_calc(stat) {
            return stat.income / stat.served * 1000;
        }
    },

    computed: {
        view() {
            return '/publisher/' + this.publisher.id;
        }
    }
});
