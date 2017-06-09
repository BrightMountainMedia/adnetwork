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
            form: new BMTMForm({})
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
         * Show the edit stat modal.
         */
        editStat(stat) {
            Bus.$emit('editStat', stat);
        },

        /**
         * Upload the publisher's stats.
         */
        uploadStats(e) {
            e.preventDefault();

            var self = this;

            this.form.startProcessing();

            // We need to gather a fresh FormData instance with the profile photo appended to
            // the data so we can POST it up to the server. This will allow us to do async
            // uploads of the profile photos. We will update the department after this action.
            $.ajax({
                url: `/admin/publisher/${this.publisher.id}/upload_stats`,
                data: this.gatherFormData(),
                cache: false,
                contentType: false,
                processData: false,
                type: 'POST',
                headers: {
                    'X-XSRF-TOKEN': Cookies.get('XSRF-TOKEN')
                },
                success: function () {
                    Bus.$emit('showPublisherProfile', self.publisher.id);

                    self.form.finishProcessing();
                },
                error: function (error) {
                    self.form.setErrors(error.responseJSON);
                }
            });
        },

        /**
         * Gather the form data for the stats upload.
         */
        gatherFormData() {
            const data = new FormData();

            data.append('stats', this.$refs.stats.files[0]);

            return data;
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

        fill_rate(stat) {
            return (stat.served / stat.impressions * 100 || 0);
        },

        eCPM_calc(stat) {
            return (stat.income / stat.served * 1000 || 0);
        }
    },

    computed: {
        view() {
            return '/publisher/' + this.publisher.id;
        }
    }
});
