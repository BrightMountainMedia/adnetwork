Vue.component('add-publisher', {
    /**
     * The component's data.
     */
    data() {
        return {
            addingPublisher: false,
        };
    },

    /**
     * The component has been created by Vue.
     */
    created() {
        var self = this;

        Bus.$on('addPublisher', function () {
            self.addingPublisher = true;

            $('#modal-add-publisher').modal('show');
        });
    }
});