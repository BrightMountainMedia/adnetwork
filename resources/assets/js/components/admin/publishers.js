Vue.component('publishers', {
    props: ['publishers'],

    /**
     * The component's data.
     */
    data() {
        return {
            searchForm: new BMTMForm({
                query: ''
            }),

            searching: false,
            noSearchResults: false,
            searchResults: [],

            showingPublisherProfile: false,
            showingStatProfile: false
        };
    },

    /**
     * The component has been created by Vue.
     */
    created() {
        var self = this;

        Bus.$on('showSearch', function(){
            self.navigateToSearch();
        });

        Bus.$on('showPublisher', function (publisher) {
            self.navigateToPublisher(publisher);
        });

        Bus.$on('showStat', function(stat){
            self.navigateToStat(stat);
        });

        Bus.$on('hashChanged', function (hash, parameters) {
            if (hash != 'publisher') {
                return true;
            }

            if (parameters && parameters.length > 0) {
                self.loadPublisherProfile({ id: parameters[0] });
            }  else {
                self.showSearch();
            }

            return true;
        });
    },

    methods: {
        /**
         * Show the publisher modal.
         */
        addPublisher() {
            Bus.$emit('addPublisher');
        },

        /**
         * Perform a search for the given query.
         */
        search() {
            this.searching = true;
            this.noSearchResults = false;

            this.$http.post('/admin/publishers/publisher_search', JSON.stringify(this.searchForm))
                .then(response => {
                    this.searchResults = response.data;
                    this.noSearchResults = this.searchResults.length === 0;

                    this.searching = false;
                });
        },

        /**
         * Show the search results and update the browser history.
         */
        navigateToSearch() {
            history.pushState(null, null, '#/publisher');

            this.showSearch();
        },

        /**
         * Show the search results.
         */
        showSearch() {
            this.showingPublisherProfile = false;

            Vue.nextTick(function () {
                $('#admin-publisher-search').focus();
            });
        },

        /**
         * Navigate to the publisher.
         */
        navigateToPublisher(publisher) {
            this.showPublisherProfile(publisher);
        },

        /*
         * Show the publisher profile for the given publisher.
         */
        showPublisherProfile(publisher) {
            history.pushState(null, null, '#/publisher/' + publisher.id);

            this.loadPublisherProfile(publisher);
        },

        /**
         * Load the publisher profile for the given publisher.
         */
        loadPublisherProfile(publisher) {
            Bus.$emit('showPublisherProfile', publisher.id);

            this.showingPublisherProfile = true;
        },

        /**
         * Show the search results and update the browser history.
         */
        navigateToStat(stat) {
            this.showingPublisherProfile = false;
            this.showStatProfile(stat);
        },

        /**
         * Show the stat profile for the given stat.
         */
        showStatProfile(stat) {
            history.pushState(null, null, '#/publisher/' + stat.publisher_id + '/stat/' + stat.id);

            this.loadStatProfile(stat);
        },

        /**
         * Load the stat profile for the given stat.
         */
        loadStatProfile(stat) {
            Bus.$emit('showStatProfile', stat.id);

            this.showingStatProfile = true;
        }
    }
});