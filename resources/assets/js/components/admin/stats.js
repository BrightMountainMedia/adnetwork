Vue.component('stats', {
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
        //
    },

    /**
     * Bootstrap the component.
     */
    ready() {
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

    events: {
        /**
         * Show the publisher profile.
         */
        showPublisher(publisherId) {
            this.navigateToPublisher(publisherId);
        }
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
        }
    }
});