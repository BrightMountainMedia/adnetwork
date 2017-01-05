Vue.component('stats', {
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
            loading: false,
            publisher: null,
            stats: null,
            showingPublisherProfile: false,

            statsForm: new BMTMForm({
                user_id: '',
                date: '',
                site: '',
                impressions: '',
                served: '',
                fill: '',
                income: '',
                ecpm: '',
                tag: ''
            }),
        };
    },

    /**
     * The component has been created by Vue.
     */
    created() {
        var self = this;

        Bus.$on('showPublisher', function (publisherId) {
            self.navigateToPublisher(publisherId);
        });

        Bus.$on('hashChanged', function (hash, parameters) {
            if (hash != 'publisher') {
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
        this.usePushStateForTabs('.list-group');
        // this.statsForm.user_id = this.publisher.id;
        // this.statsForm.date = this.stat.date;
        // this.statsForm.site = this.stat.site;
        // this.statsForm.impressions = this.stat.impressions;
        // this.statsForm.served = this.stat.served;
        // this.statsForm.fill = this.stat.fill;
        // this.statsForm.income = this.stat.income;
        // this.statsForm.ecpm = this.stat.ecpm;
        // this.statsForm.tag = this.stat.tag;
    },

    methods: {
        /**
         * Add the stats.
         */
        addStats() {
            this.$http.post('/admin/add-stats/add_stats', this.statsForm)
                .then((response) => {
                    window.location.href = response.data;
                });
        },

        /**
         * Update the stats.
         */
        update() {
            this.$http.put('/admin/add-stats/'+ this.publisher.id + '/stats_update', this.statsForm)
                .then(() => {
                    //
                });
        },

        /**
         * Navigate to the publisher.
         */
        navigateToPublisher(publisherId) {
            this.showPublisherProfile(publisherId);
        },

        /*
         * Show the publisher profile for the given publisher.
         */
        showPublisherProfile(publisherId) {
            history.pushState(null, null, '#/publisher/' + publisherId);

            this.loadPublisherProfile(publisherId);
        },

        /**
         * Load the publisher profile for the given publisher.
         */
        loadPublisherProfile(publisherId) {
            this.getpublisherProfile(publisherId);

            this.showingPublisherProfile = true;
        },

        /**
         * Get the publisher profile.
         */
        getpublisherProfile(id) {
            this.loading = true;

            this.$http.get('/admin/add-stats/' + id + '/publisher_profile')
                .then(response => {
                    this.publisher = response.data.publisher;
                    this.statsForm.user_id = this.publisher.id;
                    this.stats = response.data.stats;
                    this.loading = false;
                });
        },

        /**
         * Show the Publishers.
         */
        showPublishers() {
            history.pushState(null, null, '/admin/add-stats');
            this.showingPublisherProfile = false;
            this.publisher = null;
            this.stats = null;
        },

        getTotal(stat) {
            if ( stat.tag.includes('total') ) {
                console.log(stat);
                return ':style="bold"';
            }
        }
    }
});