<template>
    <div id="settings-{{ exception.id }}" class="uk-modal">
        <div class="uk-modal-dialog uk-modal-dialog-large">
            <a class="uk-modal-close uk-close"></a>
            <form class="uk-form" @submit.prevent="settings">
                <fieldset>
                    <legend>Settings for individual exception</legend>
                    <div class="uk-form-row"><label><input type="checkbox" v-model="isSaveDates" :checked="exception.options.keep_dates"> Save Dates</label></div>
                    <div class="uk-form-row"><label><input type="checkbox" v-model="isSaveMessages" :checked="exception.options.keep_messages"> Save Messages</label></div>
                    <button class="uk-button uk-button-primary uk-margin-top" type="submit">Save</button>
                </fieldset>
            </form>
            <button @click="deleteLog" class="uk-button uk-button-small uk-button-danger uk-margin-top">Remove Log</button>
        </div>
    </div>
</template>
<script>

    var local = window.location;

    module.exports = {

        data () {

            return {

                isSaveMessages: false,

                isSaveDates: false
            }
        },

        props: ['exception'],

        methods: {

            deleteLog () {

                var $this = this;

                UIkit.modal.confirm("Are you sure you want to delete this log?", function(){

                    var modal = UIkit.modal('#settings-' + $this.exception.id);

                    modal.hide();

                    $this.$http.delete(local.href + '/delete', {log_hash: $this.exception.logHash}).then(function(res){

                        if (res.data.success === true) {

                            location.reload();

                        } else {

                            UIkit.modal.alert("Delete failed. Message: '" + res.data.exception_message + "'");
                        }
                    }).catch(function(err) {

                        throw new Error(err);
                    });
                });
            },

            settings () {

                var settings = {

                    hash: this.exception.logHash,

                    keepDates: this.isSaveDates,

                    keepMessages: this.isSaveMessages
                };

                var modal = UIkit.modal('#settings-' + this.exception.id);

                modal.hide();

                this.$http.post(local.href + '/save-settings', {settings: settings}).then(function(res){

                    if (res.data.success === true) {

                        var modal = UIkit.modal('#settings-' + this.exception.id);

                        modal.hide();

                    } else {

                        UIkit.modal.alert("Save settings failed. Message: '" + res.data.exception_message + "'");
                    }
                }).catch(function(err) {

                    throw new Error(err);
                });
            }
        }

    }
</script>
