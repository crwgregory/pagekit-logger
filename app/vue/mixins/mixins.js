
module.exports = {

  data: function() {
    return {
      errorLevels : [
        [100, 'DEBUG'],
        [200, 'INFO'],
        [250, 'NOTICE'],
        [300, 'WARNING'],
        [400, 'ERROR'],
        [500, 'CRITICAL'],
        [550, 'ALERT'],
        [600, 'EMERGENCY']
      ]
    }
  },

  filters: {
    'mapErrorLevel': function(level)
    {
      var x = '';

      this.errorLevels.forEach(function(el) {

        if (level === el[0]) {

          x = el[1];

        }
      });
      return x;
    }
  }
};