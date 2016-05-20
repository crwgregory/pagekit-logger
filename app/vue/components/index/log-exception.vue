<template>
    <div class="uk-panel uk-panel-box uk-panel-box-primary">
        <h1 class="uk-panel-title">Exceptions</h1>
        <table class="uk-table">
            <thead>
            <tr>
                <td><b>Logger Name</b></td>
                <td><b>Error Level</b></td>
                <td><b>Class</b></td>
                <td><b>Count</b></td>
                <td><b>Details</b></td>
                <td><b>Settings</b></td>
            </tr>
            </thead>
            <tbody>
            <template v-for="exception in exceptions">
                <tr>
                    <td>{{ exception.loggerName }}</td>
                    <td>{{ exception.errorLevel | mapErrorLevel }}</td>
                    <td>{{ exception.exceptionClass }}</td>
                    <td>{{ exception.count }}</td>
                    <td><a class="uk-icon-file-text-o uk-icon-medium" data-uk-modal="{target: '#exception-{{ exception.id }}'}"></a></td>
                    <td><a class="uk-icon-cog uk-icon-medium" data-uk-modal="{target: '#settings-{{ exception.id }}'}"></a></td>
                </tr>
            </template>
            </tbody>
        </table>
        <template v-for="exception in exceptions">
            <exception-details :exception="exception"></exception-details>
            <exception-settings :exception="exception"></exception-settings>
        </template>
    </div>
</template>
<style>
    .log-row:hover{
        background: linear-gradient(
                        rgba(52, 209, 247, 0.5),
                        rgba(52, 209, 247, 0.5)
        );
        cursor: pointer;
    }
</style>
<script>

    module.exports = {

        data() {
            return {
                exceptionKeys: []
            }
        },

        props: ['exceptions'],

        methods: {

            showDetails (id) {

                var modal = UIkit.modal('#' + id);

                modal.show();
            }
        },

        mixins: [require('./../../mixins/mixins.js')],

        components: {
            'exception-details': require('./exception-details.vue'),
            'exception-settings': require('./exception-settings.vue')
        }
    }
</script>