function adminEditStatForm (stat) {
    if ( stat ) {
        return {
            user_id: stat.user_id,
            date: stat.date,
            site: stat.site,
            impressions: stat.impressions,
            served: stat.served,
            income: stat.income,
            tag: stat.tag
        };
    } else {
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
}

Vue.component('edit-stat', {
    props: ['publisher'],

    /**
     * The component's data.
     */
    data() {
        return {
            editingStat: false,
            statsForm: new BMTMForm(adminEditStatForm())
        };
    },

    /**
     * The component has been created by Vue.
     */
    created() {
        var self = this;

        Bus.$on('editStat', function (stat) {
            self.statsForm = new BMTMForm(adminEditStatForm(stat));

            self.editingStat = true;

            $('#modal-edit-stat').modal('show');
        });
    },

    methods: {
        /**
         * Save the stat
         */
        saveStat(publisher) {
            this.$http.post('/admin/publisher/edit_stat', this.statsForm)
                .then(response => {
                    this.editingStat = false;
                    $('#modal-edit-stat').modal('hide');
                    Bus.$emit('showPublisherProfile', response.data.publisher.id);
                });
        },
    }
});