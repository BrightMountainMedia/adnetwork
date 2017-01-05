function adminAddStatForm () {
    return {
        user_id: 0,
        date: '',
        site: '',
        impressions: '',
        served: '',
        income: '',
        tag: ''
    };
}

Vue.component('add-stat', {
    props: ['publisher'],

    /**
     * The component's data.
     */
    data() {
        return {
            addingStat: false,
            statsForm: new BMTMForm(adminAddStatForm())
        };
    },

    /**
     * The component has been created by Vue.
     */
    created() {
        var self = this;

        Bus.$on('addStat', function () {
            self.statsForm = new BMTMForm(adminAddStatForm());

            self.addingStat = true;

            $('#modal-add-stat').modal('show');
        });
    },

    methods: {
        /**
         * Save the stat
         */
        saveStat(publisher) {
            this.$http.post('/admin/publisher/add_stat', this.statsForm)
                .then(response => {
                    this.addingStat = false;
                    $('#modal-add-stat').modal('hide');
                    Bus.$emit('showPublisherProfile', response.data.publisher.id);
                });
        },
    }
});