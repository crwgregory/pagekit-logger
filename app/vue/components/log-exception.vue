<template>
    <div class="uk-panel uk-panel-box uk-panel-box-primary">
        <h1 class="uk-panel-title">Exceptions</h1>
        <table class="uk-table uk-table-hover">
            <thead>
            <tr>
                <td></td>
                <td><b>Logger Name</b></td>
                <td><b>Exception Class</b></td>
                <td><b>Error Level</b></td>
                <td><b>Message</b></td>
                <td><b>Count</b></td>
            </tr>
            </thead>
            <tbody>
            <template v-for="exception in exceptions">
                <tr class="" >
                    <td><div class="uk-button" data-uk-offcanvas="{target: '#{{ exception.id }}'}">Details</div></td>
                    <td>{{ exception.loggerName }}</td>
                    <td>{{ exception.exceptionClass }}</td>
                    <td>{{ exception.errorLevel | mapErrorLevel }}</td>
                    <td>{{ exception.message }}</td>
                    <td>{{ exception.count }}</td>
                </tr>
                <!--<tr>-->
                    <!--<td class="accordion-td">-->
                        <!--<div class="uk-accordion-content">-->
                            <!--<div class="uk-panel uk-panel-box">-->
                                <!--<table class="uk-table">-->
                                    <!--<thead>-->
                                    <!--<tr>-->
                                        <!--<th>File</th>-->
                                        <!--<th>Line</th>-->
                                        <!--<th>Dates</th>-->
                                    <!--</tr>-->
                                    <!--</thead>-->
                                    <!--<tbody>-->
                                    <!--<tr>-->
                                        <!--<td>{{ exception.file }}</td>-->
                                        <!--<td>{{ exception.line }}</td>-->
                                        <!--<td>{{ exception.dates }}</td>-->
                                    <!--</tr>-->
                                    <!--</tbody>-->
                                <!--</table>-->
                            <!--</div>-->
                        <!--</div>-->
                    <!--</td>-->
                <!--</tr>-->
            </template>
            </tbody>
        </table>
        <div v-for="exception in exceptions" :id="exception.id" class="uk-offcanvas">
            <div class="uk-offcanvas-bar">
                <div class="uk-panel">
                    <div class="uk-panel-title">
                        File
                    </div>
                    <div class="uk-text-break">
                        {{ exception.file }}
                    </div>
                </div>
                <div class="uk-panel">
                    <div class="uk-panel-title">
                        Line
                    </div>
                    {{ exception.line }}
                </div>
                <div class="uk-panel">
                    <div class="uk-panel-title">
                        Dates
                    </div>
                    <ul>
                        <li v-for="date in exception.dates">
                            {{ date }}
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</template>
<script>

    var errorLevels = [
        [100, 'DEBUG'],
        [200, 'INFO'],
        [250, 'NOTICE'],
        [300, 'WARNING'],
        [400, 'ERROR'],
        [500, 'CRITICAL'],
        [550, 'ALERT'],
        [600, 'EMERGENCY']
    ];

    module.exports = {

        data() {
            return {
                exceptionKeys: []
            }
        },

        props: ['exceptions'],

        ready() {
            var $this = this;

            var keys = [];

            this.exceptions.forEach(function(e) {

                var y = JSON.parse(JSON.stringify(e.exception));

                for (e in y) {

                    if (!y.hasOwnProperty(e)) continue;

                    if (keys.indexOf(e) === -1) {

                        keys.push(e);

                        $this.exceptionKeys.push(e);
                    }
                }
            });
        },
        
        filters: {
            'mapErrorLevel': function(level)
            {
                var x = '';

                errorLevels.forEach(function(el) {

                    if (level === el[0]) {

                        x = el[1];
                        return;
                    }
                });
                return x;
            }  
        },

        mixins: [require('./../mixins/mixins.js')]
    }
</script>