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
                <div class="uk-flex uk-flex-column">
                    <div class="uk-width-1-1 uk-panel uk-margin-bottom">
                        <div class="uk-panel-title">
                            File
                        </div>
                        <div class="uk-text-break uk-margin-left">
                            {{ exception.file }}
                        </div>
                    </div>
                    <div class="uk-width-1-1 uk-panel uk-margin-bottom">
                        <div class="uk-panel-title">
                            Line
                        </div>
                        <div class="uk-margin-left">
                            {{ exception.line }}
                        </div>
                    </div>
                    <div class="uk-width-1-1 uk-panel uk-margin-bottom">
                        <div class="uk-panel-title">
                            Class
                        </div>
                        <div class="uk-margin-left">
                            {{ exception.exceptionClass }}
                        </div>
                    </div>
                    <div class="uk-width-1-1 uk-panel uk-margin-bottom">
                        <article>
                            <hr class="uk-article-divider">
                        </article>
                    </div>
                    <div class="uk-width-1-1 uk-panel uk-margin-bottom">
                        <div class="uk-panel-title">
                            Messages
                        </div>
                        <article class="uk-margin-left" v-for="message in exception.message">
                            <p>{{ message }}</p>
                        </article>
                    </div>
                    <div class="uk-width-1-1 uk-panel uk-margin-bottom">
                        <div class="uk-panel-title">
                            Dates
                        </div>
                        <article class="uk-margin-left" v-for="date in exception.dates">
                            <p>{{ date }}</p>
                        </article>
                    </div>
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