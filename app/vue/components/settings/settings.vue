<template>

    <form class="uk-form" @submit.prevent="saveSettings">
        <fieldset>
            <legend>Exception Settings</legend>
            <div class="uk-form-row">
                <label>
                    <input type="checkbox" v-model="settings.log_dates" :checked="settings.log_dates">
                    Save Dates</label>
            </div>
            <div class="uk-form-row">
                <label>
                    <input type="checkbox" v-model="settings.log_messages" :checked="settings.log_messages">
                    Save Messages
                </label>
            </div>
            <legend class="uk-margin-top">Default Settings</legend>
            <div class="uk-form-row">
                <select v-model="settings.log_level">
                    <option v-for="level in errorLevels" :value="level[0]" :selected="level[0] | isLevel">
                        {{ level[1] }}
                    </option>
                </select>
                <span class="uk-form-help-inline"><i class="uk-icon-info-circle" data-uk-tooltip title="The default error level used when creating a log if one isn't specified."></i></span>
            </div>
            <button class="uk-button uk-button-primary uk-margin-large-top" type="submit">Save</button>
        </fieldset>
    </form>

</template>
<script>

    var local = window.location;

    module.exports = {

        data () {

            return {

                settings: window.$data.settings
            }
        },

        filters: {
            'isLevel' (lvl) {

                return lvl === this.settings.log_level;
            }
        },

        methods: {

            saveSettings () {

                var settings = {

                    keepDates: this.settings.log_dates,

                    keepMessages: this.settings.log_messages,

                    logLevel: this.settings.log_level
                };

                var path = local.pathname.replace('settings', 'save-default-settings');

                this.$http.post(path, {settings: settings}).then(function(res){

                    if (res.data.success === true) {

                        location.reload();

                    } else {

                        console.log(res.data);

                        UIkit.modal.alert("Save settings failed. Message: '" + res.data.exception_message + "'");
                    }
                }).catch(function(err) {

                    throw new Error(err);
                });
            }
        },
        mixins: [require('./../../mixins/mixins.js')]
    }
</script>