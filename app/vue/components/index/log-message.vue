<template>
    <div class="uk-panel uk-panel-box">
        <h1 class="uk-panel-title">Messages</h1>
        <table class="uk-table uk-table-hover">
            <thead>
            <tr>
                <td><b>Logger Name</b></td>
                <td><b>Error Level</b></td>
                <td><b>Message</b></td>
                <td><b>Count</b></td>
                <td><b>Dates</b></td>
                <td></td>
            </tr>
            </thead>
            <tbody>
            <template v-for="message in messages">
                <tr>
                    <td>{{ message.loggerName }}</td>
                    <td>{{ message.errorLevel | mapErrorLevel }}</td>
                    <td>{{ message.message }}</td>
                    <td>{{ message.count }}</td>
                    <td><a class="uk-icon-calendar uk-icon-medium" data-uk-modal="{target: '#{{ message.id }}'}"></a></td>
                    <td class="uk-text-center uk-icon-medium uk-width-1-10"><a style="color: #E44E56" class="uk-icon-remove" @click="deleteLog(message.logHash)"></a></td>
                </tr>
            </template>
            </tbody>
        </table>
    </div>
    <div v-for="message in messages" :id="message.id" class="uk-modal">
        <div class="uk-modal-dialog">
            <a class="uk-modal-close uk-close"></a>
            <div class="uk-flex uk-flex-column">
                <div class="uk-width-1-1 uk-panel uk-margin-bottom">
                    <div class="uk-panel-title">
                        Dates
                    </div>
                    <ul class="uk-list">
                        <li v-for="date in message.dates" track-by="$index" class="uk-margin-bottom">
                            {{ date }}
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</template>
<script>

    var local = window.location;

    module.exports = {

        props: ['messages'],

        mixins: [require('./../../mixins/mixins.js')],

        methods: {

            deleteLog (hash) {

                var $this = this;

                UIkit.modal.confirm("Are you sure you want to delete this log?", function(){

                    $this.$http.delete(local.href + '/delete', {log_hash: hash}).then(function(res){

                        if (res.data.success === true) {

                            location.reload();

                        } else {

                            UIkit.modal.alert("Delete failed. Message: '" + res.data.exception_message + "'");
                        }
                    }).catch(function(err) {

                        throw new Error(err);
                    });
                });
            }
        }
    }

</script>