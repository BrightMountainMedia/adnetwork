/**
 * Export the root BMTM application.
 */
module.exports = {
    el: 'body',

    /**
     * The application's data.
     */
    data: {
        user: [],

        supportForm: new BMTMForm({
            from: '',
            subject: '',
            message: ''
        })
    },


    /**
     * The component has been created by Vue.
     */
    created() {
        //
    },


    /**
     * Prepare the application.
     */
    ready() {
        this.whenReady();
    },


    events: {
        /*
         * Update the current user of the application.
         */
        updateUser() {
            this.getUser();
        },

        /**
         * Show the customer support e-mail form.
         */
        showSupportForm() {
            if (this.user) {
                this.supportForm.from = this.user.email;
            }

            $('#modal-support').modal('show');

            setTimeout(() => {
                $('#support-subject').focus();
            }, 500);
        }
    },


    methods: {
        /**
         * Finish bootstrapping the application.
         */
        whenReady() {
            console.log('We have now finished bootstrapping the application');
        },

        /*
         * Get the current user of the application.
         */
        getUser() {
            this.$http.get('/user/current')
                .then(response => {
                    this.user = response.data;
                });
        },

        /**
         * Send a customer support request.
         */
        sendSupportRequest() {
            this.$http.post('/support/email', this.supportForm)
                .then(() => {
                    $('#modal-support').modal('hide');

                    this.showSupportRequestSuccessMessage();

                    this.supportForm.subject = '';
                    this.supportForm.message = '';
                });
        },

        /**
         * Show an alert informing the user their support request was sent.
         */
        showSupportRequestSuccessMessage() {
            swal({
                title: 'Got It!',
                text: 'We have received your message and will respond soon!',
                type: 'success',
                showConfirmButton: false,
                timer: 2000
            });
        }
    }
};