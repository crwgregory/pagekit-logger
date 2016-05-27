<template>
    <div id="exception-{{ exception.id }}" class="uk-modal">
        <div class="uk-modal-dialog uk-modal-dialog-large">
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
                <tr>
                    <td>{{ exception.file }}</td>
                    <td>{{ exception.line }}</td>
                    <td>{{ exception.exceptionClass }}</td>
                </tr>
                </tbody>
            </table>

            <div class="uk-grid">
                <div class="uk-width-medium-2-10">
                    <ul class="uk-tab uk-tab-left" data-uk-tab="{connect: '#exception-info-{{ exception.id }}'}">
                        <li><a href="">Messages</a></li>
                        <li><a href="">Dates</a></li>
                    </ul>
                </div>
                <div class="uk-width-medium-1-2">
                    <ul id="exception-info-{{ exception.id }}" class="uk-switcher">
                        <li class="uk-active">
                            <div class="uk-width-1-1 uk-panel uk-margin-bottom">
                                <ul class="uk-list">
                                    <li v-for="message in exception.message" track-by="$index" class="uk-margin-bottom">
                                        {{ message }}
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li>
                            <div class="uk-width-1-1 uk-panel uk-margin-bottom">
                                <ul class="uk-list">
                                    <li v-for="date in exception.dates" track-by="$index" class="uk-margin-bottom">
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
</template>
<script>
    module.exports = {

        props: ['exception']

    }
</script>
