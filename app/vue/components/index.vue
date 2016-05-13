<template>
  <div class="uk-grid">

    <div class="uk-width-1-1">

      <div v-if="hasExceptions">
        <table class="uk-table">
          <thead>
          <tr>
            <template v-for="key in exceptionKeys">
              <td>{{ key }}</td>
            </template>
          </tr>
          </thead>
          <tbody>
          <tr>
            <template v-for="exception in exceptions">
              <log-exception :log="exception.exception" :key="$key"></log-exception>
            </template>
          </tr>
          </tbody>
        </table>
      </div>



    </div>

    <!--<log-message :log="value.message"></log-message>-->
  </div>

</template>
<script>
  module.exports = {

    data() {

      return {
        exceptionKeys: []
      }
    },

    props: ['logs'],

    ready() {

      var $this = this;

      this.logs.forEach(function(log) {

        if (log.exception) {

          $this.exceptions.push(log);

          $this.$set('hasExceptions', true);

        } else {

          $this.messages.push(log);

          $this.$set('hasMessages', true);
        }
      });
    },

    watch: {

      'exceptions' : {

        handler: function() {

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
        }
      }
    },

    computed: {
//      exceptionKeys: function() {
//
//        var $this = this;
//
//        var keys = [];
//
//        var getKeys = new Promise(function(resolve, reject) {
//
//          $this.exceptions.forEach(function(e, i) {
//
//            var y = JSON.parse(JSON.stringify(e.exception));
//
//            for (e in y) {
//              if (!y.hasOwnProperty(e)) continue;
//              if (keys.indexOf(e) === -1) {
//                keys.push(e);
//              }
//            }
//            if ((i + 1) === $this.exceptions.length) {
//              resolve();
//            }
//          });
//        });
//
//        getKeys.then(function() {
//          return keys;
//        });
//
//      }
    },

    components: {
      'log-exception' : require('./log-exception.vue'),
      'log-message'   : require('./log-message.vue')
    },

    mixins: ['./../mixins/mixins.js']
  }
</script>
