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
                <td>Dates</td>
            </tr>
            </thead>
            <tbody>
            <template v-for="message in messages">
                <tr class="" >
                    <td>{{ message.loggerName }}</td>
                    <td>{{ message.errorLevel | mapErrorLevel }}</td>
                    <td>{{ message.message }}</td>
                    <td>{{ message.count }}</td>
                    <td><a class="uk-icon-calendar uk-icon-medium" data-uk-modal="{target: '#{{ message.id }}'}"></a></td>
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
                        <li v-for="date in message.dates" class="uk-margin-bottom">
                            {{ date }}
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</template>
<script>

    module.exports = {

        props: ['messages'],

        mixins: [require('./../mixins/mixins.js')]
    }

</script>