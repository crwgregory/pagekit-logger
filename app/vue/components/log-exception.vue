<template>
    <div class="uk-panel uk-panel-box uk-panel-box-primary">
        <h1 class="uk-panel-title">Exceptions</h1>
        <table class="uk-table uk-table-hover">
            <thead>
            <tr>
                <td><b>Logger Name</b></td>
                <td><b>Error Level</b></td>
                <td><b>Class</b></td>
                <td><b>Count</b></td>
                <td><b>Details</b></td>
            </tr>
            </thead>
            <tbody>
            <template v-for="exception in exceptions">
                <tr>
                    <td>{{ exception.loggerName }}</td>
                    <td>{{ exception.errorLevel | mapErrorLevel }}</td>
                    <td>{{ exception.exceptionClass }}</td>
                    <td>{{ exception.count }}</td>
                    <td><a class="uk-icon-file-text-o uk-icon-medium" data-uk-modal="{target: '#{{ exception.id }}'}"></a></td>
                </tr>
            </template>
            </tbody>
        </table>
        <div v-for="exception in exceptions" :id="exception.id" class="uk-modal">
            <div class="uk-modal-dialog">
                <a class="uk-modal-close uk-close"></a>
                <table class="uk-table uk-table-hover">
                    <thead>
                    <tr>
                        <td><b>File Location</b></td>
                        <td><b>Line Number</b></td>
                        <td><b>Exception Class</b></td>
                    </tr>
                    </thead>
                    <tbody>
                    <template v-for="exception in exceptions">
                        <tr>
                            <td>{{ exception.file }}</td>
                            <td>{{ exception.line }}</td>
                            <td>{{ exception.exceptionClass }}</td>
                        </tr>
                    </template>
                    </tbody>
                </table>

                <div class="uk-grid">
                    <div class="uk-width-medium-2-10">
                        <ul class="uk-tab uk-tab-left" data-uk-tab="{connect: '#exception-info'}">
                            <li><a href="">Messages</a></li>
                            <li><a href="">Dates</a></li>
                        </ul>
                    </div>
                    <div class="uk-width-medium-1-2">
                        <ul id="exception-info" class="uk-switcher">
                            <li class="uk-active">
                                <div class="uk-width-1-1 uk-panel uk-margin-bottom">
                                    <ul class="uk-list">
                                        <li v-for="message in exception.message" class="uk-margin-bottom">
                                            {{ message }}
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li>
                                <div class="uk-width-1-1 uk-panel uk-margin-bottom">
                                    <ul class="uk-list">
                                        <li v-for="date in exception.dates" class="uk-margin-bottom">
                                            {{ date }}
                                        </li>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>

                <!--<ul class="uk-tab" data-uk-tab="{connect: '#exception-info'}">-->
                <!--</ul>-->
                <!--<ul id="exception-info" class="uk-switcher uk-margin">-->

                <!--</ul>-->
                </div>
            </div>
        </div>
    </div>
</template>
<script>

    module.exports = {

        data() {
            return {
                exceptionKeys: []
            }
        },

        props: ['exceptions'],

        mixins: [require('./../mixins/mixins.js')]
    }
</script>