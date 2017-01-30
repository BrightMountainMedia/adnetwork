/**
 * Export the root BMTM application.
 */
module.exports = {
    el: 'body',

    /**
     * The application's data.
     */
    data: {
        user: []
    },


    /**
     * The component has been created by Vue.
     */
    created() {
        var self = this;

        Bus.$on('updateUser', function () {
            self.getUser();
        });
    },

    /**
     * Prepare the application.
     */
    mounted() {
        // this.getUser();
    },

    methods: {
        /*
         * Get the current user of the application.
         */
        getUser() {
            this.$http.get('/user/current')
                .then(response => {
                    this.user = response.data;
                });
        }
    }
};