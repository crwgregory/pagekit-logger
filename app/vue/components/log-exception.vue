<template>
    <div class="uk-panel uk-panel-box uk-panel-box-primary">
        <h1 class="uk-panel-title">Exceptions</h1>
        <table class="uk-table uk-table-hover">
            <thead>
            <tr>
                <td v-for="key in exceptionKeys"><b>{{ key | explodingCamels | capitalize }}</b></td>
            </tr>
            </thead>
            <tbody>
            <tr v-for="exception in exceptions">
                <td v-for="value in exception.exception">{{ value }}</td>
            </tr>
            </tbody>
        </table>
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

        ready() {
            var $this = this;

            var keys = [];

            this.exceptions.forEach(function(e, i) {

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

        mixins: [require('./../mixins/mixins.js')]
    }
</script>