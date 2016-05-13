
module.exports = {

  filters: {
    'explodingCamels': function(string) {
      var toReturn = '';
      if (string) {
        for (var i = 0; i < string.length; i++) {
          var character = string.charAt(i);
          if (isNaN(character * 1)) {
            if (i != 0 && character == character.toUpperCase()) {
              toReturn += ' ';
            }
          }
          toReturn += character;
        }
      }
      return toReturn;
    }
  }
};