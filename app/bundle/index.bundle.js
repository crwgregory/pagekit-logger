/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};

/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {

/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId])
/******/ 			return installedModules[moduleId].exports;

/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			exports: {},
/******/ 			id: moduleId,
/******/ 			loaded: false
/******/ 		};

/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);

/******/ 		// Flag the module as loaded
/******/ 		module.loaded = true;

/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}


/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;

/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;

/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "scripts/";

/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(0);
/******/ })
/************************************************************************/
/******/ ([
/* 0 */
/***/ function(module, exports, __webpack_require__) {

	
	window.Index = {

	  el: '#pagekit-logger-index',

	  data: function() {
	    return {
	      logs: window.$data.logs,
	      exceptions: [],
	      messages: [],
	      hasExceptions : false,
	      hasMessages: false,

	    }
	  },

	  ready: function(){
	    var $this = this;

	    this.logs.forEach(function(log) {

	      if (log.exception) {

	        $this.exceptions.push(log.exception);

	        $this.$set('hasExceptions', true);

	      } else {

	        $this.messages.push(log.message);

	        $this.$set('hasMessages', true);
	      }
	    });
	  },

	  components: {
	    'log-exception' : __webpack_require__(1),
	    'log-message'   : __webpack_require__(8)
	  }
	};
	Vue.ready(window.Index);


/***/ },
/* 1 */
/***/ function(module, exports, __webpack_require__) {

	var __vue_script__, __vue_template__
	__vue_script__ = __webpack_require__(2)
	if (__vue_script__ &&
	    __vue_script__.__esModule &&
	    Object.keys(__vue_script__).length > 1) {
	  console.warn("[vue-loader] app\\vue\\components\\log-exception.vue: named exports in *.vue files are ignored.")}
	__vue_template__ = __webpack_require__(7)
	module.exports = __vue_script__ || {}
	if (module.exports.__esModule) module.exports = module.exports.default
	if (__vue_template__) {
	(typeof module.exports === "function" ? (module.exports.options || (module.exports.options = {})) : module.exports).template = __vue_template__
	}
	if (false) {(function () {  module.hot.accept()
	  var hotAPI = require("vue-hot-reload-api")
	  hotAPI.install(require("vue"), true)
	  if (!hotAPI.compatible) return
	  var id = "C:\\wamp2.5\\www\\logger\\packages\\nativerank\\pagekit-logger\\app\\vue\\components\\log-exception.vue"
	  if (!module.hot.data) {
	    hotAPI.createRecord(id, module.exports)
	  } else {
	    hotAPI.update(id, module.exports, __vue_template__)
	  }
	})()}

/***/ },
/* 2 */
/***/ function(module, exports, __webpack_require__) {

	'use strict';

	var _stringify = __webpack_require__(3);

	var _stringify2 = _interopRequireDefault(_stringify);

	function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

	var errorLevels = [[100, 'DEBUG'], [200, 'INFO'], [250, 'NOTICE'], [300, 'WARNING'], [400, 'ERROR'], [500, 'CRITICAL'], [550, 'ALERT'], [600, 'EMERGENCY']];

	module.exports = {
	    data: function data() {
	        return {
	            exceptionKeys: []
	        };
	    },


	    props: ['exceptions'],

	    ready: function ready() {
	        var $this = this;

	        var keys = [];

	        this.exceptions.forEach(function (e) {

	            var y = JSON.parse((0, _stringify2.default)(e.exception));

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
	        'mapErrorLevel': function mapErrorLevel(level) {
	            var x = '';

	            errorLevels.forEach(function (el) {

	                if (level === el[0]) {

	                    x = el[1];
	                    return;
	                }
	            });
	            return x;
	        }
	    },

	    mixins: [__webpack_require__(6)]
	};

/***/ },
/* 3 */
/***/ function(module, exports, __webpack_require__) {

	module.exports = { "default": __webpack_require__(4), __esModule: true };

/***/ },
/* 4 */
/***/ function(module, exports, __webpack_require__) {

	var core  = __webpack_require__(5)
	  , $JSON = core.JSON || (core.JSON = {stringify: JSON.stringify});
	module.exports = function stringify(it){ // eslint-disable-line no-unused-vars
	  return $JSON.stringify.apply($JSON, arguments);
	};

/***/ },
/* 5 */
/***/ function(module, exports) {

	var core = module.exports = {version: '2.4.0'};
	if(typeof __e == 'number')__e = core; // eslint-disable-line no-undef

/***/ },
/* 6 */
/***/ function(module, exports) {

	
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

/***/ },
/* 7 */
/***/ function(module, exports) {

	module.exports = "\n<div class=\"uk-panel uk-panel-box uk-panel-box-primary\">\n    <h1 class=\"uk-panel-title\">Exceptions</h1>\n    <table class=\"uk-table uk-table-hover\">\n        <thead>\n        <tr>\n            <td></td>\n            <td><b>Logger Name</b></td>\n            <td><b>Exception Class</b></td>\n            <td><b>Error Level</b></td>\n            <td><b>Message</b></td>\n            <td><b>Count</b></td>\n        </tr>\n        </thead>\n        <tbody>\n        <template v-for=\"exception in exceptions\">\n            <tr class=\"\" >\n                <td><div class=\"uk-button\" data-uk-offcanvas=\"{target: '#{{ exception.id }}'}\">Details</div></td>\n                <td>{{ exception.loggerName }}</td>\n                <td>{{ exception.exceptionClass }}</td>\n                <td>{{ exception.errorLevel | mapErrorLevel }}</td>\n                <td>{{ exception.message }}</td>\n                <td>{{ exception.count }}</td>\n            </tr>\n            <!--<tr>-->\n                <!--<td class=\"accordion-td\">-->\n                    <!--<div class=\"uk-accordion-content\">-->\n                        <!--<div class=\"uk-panel uk-panel-box\">-->\n                            <!--<table class=\"uk-table\">-->\n                                <!--<thead>-->\n                                <!--<tr>-->\n                                    <!--<th>File</th>-->\n                                    <!--<th>Line</th>-->\n                                    <!--<th>Dates</th>-->\n                                <!--</tr>-->\n                                <!--</thead>-->\n                                <!--<tbody>-->\n                                <!--<tr>-->\n                                    <!--<td>{{ exception.file }}</td>-->\n                                    <!--<td>{{ exception.line }}</td>-->\n                                    <!--<td>{{ exception.dates }}</td>-->\n                                <!--</tr>-->\n                                <!--</tbody>-->\n                            <!--</table>-->\n                        <!--</div>-->\n                    <!--</div>-->\n                <!--</td>-->\n            <!--</tr>-->\n        </template>\n        </tbody>\n    </table>\n    <div v-for=\"exception in exceptions\" :id=\"exception.id\" class=\"uk-offcanvas\">\n        <div class=\"uk-offcanvas-bar\">\n            <div class=\"uk-panel\">\n                <div class=\"uk-panel-title\">\n                    File\n                </div>\n                <div class=\"uk-text-break\">\n                    {{ exception.file }}\n                </div>\n            </div>\n            <div class=\"uk-panel\">\n                <div class=\"uk-panel-title\">\n                    Line\n                </div>\n                {{ exception.line }}\n            </div>\n            <div class=\"uk-panel\">\n                <div class=\"uk-panel-title\">\n                    Dates\n                </div>\n                <ul>\n                    <li v-for=\"date in exception.dates\">\n                        {{ date }}\n                    </li>\n                </ul>\n            </div>\n        </div>\n    </div>\n</div>\n";

/***/ },
/* 8 */
/***/ function(module, exports, __webpack_require__) {

	var __vue_script__, __vue_template__
	__vue_script__ = __webpack_require__(9)
	if (__vue_script__ &&
	    __vue_script__.__esModule &&
	    Object.keys(__vue_script__).length > 1) {
	  console.warn("[vue-loader] app\\vue\\components\\log-message.vue: named exports in *.vue files are ignored.")}
	__vue_template__ = __webpack_require__(10)
	module.exports = __vue_script__ || {}
	if (module.exports.__esModule) module.exports = module.exports.default
	if (__vue_template__) {
	(typeof module.exports === "function" ? (module.exports.options || (module.exports.options = {})) : module.exports).template = __vue_template__
	}
	if (false) {(function () {  module.hot.accept()
	  var hotAPI = require("vue-hot-reload-api")
	  hotAPI.install(require("vue"), true)
	  if (!hotAPI.compatible) return
	  var id = "C:\\wamp2.5\\www\\logger\\packages\\nativerank\\pagekit-logger\\app\\vue\\components\\log-message.vue"
	  if (!module.hot.data) {
	    hotAPI.createRecord(id, module.exports)
	  } else {
	    hotAPI.update(id, module.exports, __vue_template__)
	  }
	})()}

/***/ },
/* 9 */
/***/ function(module, exports) {

	'use strict';

	module.exports = {

	    props: ['log']

	};

/***/ },
/* 10 */
/***/ function(module, exports) {

	module.exports = "\n\n<div class=\"uk-width-1-1\">\n\n    {{ log }}\n\n</div>\n\n";

/***/ }
/******/ ]);