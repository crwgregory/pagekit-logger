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
	      hasMessages: false
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
	    'log-message'   : __webpack_require__(5)
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
	__vue_template__ = __webpack_require__(4)
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

	module.exports = {
	    data: function data() {
	        return {
	            exceptionKeys: []
	        };
	    },


	    props: ['exceptions'],

	    mixins: [__webpack_require__(3)]
	};

/***/ },
/* 3 */
/***/ function(module, exports) {

	
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

/***/ },
/* 4 */
/***/ function(module, exports) {

	module.exports = "\n<div class=\"uk-panel uk-panel-box uk-panel-box-primary\">\n    <h1 class=\"uk-panel-title\">Exceptions</h1>\n    <table class=\"uk-table uk-table-hover\">\n        <thead>\n        <tr>\n            <td><b>Logger Name</b></td>\n            <td><b>Error Level</b></td>\n            <td><b>Class</b></td>\n            <td><b>Count</b></td>\n            <td><b>Details</b></td>\n        </tr>\n        </thead>\n        <tbody>\n        <template v-for=\"exception in exceptions\">\n            <tr>\n                <td>{{ exception.loggerName }}</td>\n                <td>{{ exception.errorLevel | mapErrorLevel }}</td>\n                <td>{{ exception.exceptionClass }}</td>\n                <td>{{ exception.count }}</td>\n                <td><a class=\"uk-icon-file-text-o uk-icon-medium\" data-uk-modal=\"{target: '#{{ exception.id }}'}\"></a></td>\n            </tr>\n        </template>\n        </tbody>\n    </table>\n    <div v-for=\"exception in exceptions\" :id=\"exception.id\" class=\"uk-modal\">\n        <div class=\"uk-modal-dialog\">\n            <a class=\"uk-modal-close uk-close\"></a>\n            <div class=\"uk-flex uk-flex-column\">\n                <div class=\"uk-width-1-1 uk-panel uk-margin-bottom\">\n                    <div class=\"uk-panel-title\">\n                        File\n                    </div>\n                    <div class=\"uk-text-break uk-margin-left\">\n                        {{ exception.file }}\n                    </div>\n                </div>\n                <div class=\"uk-width-1-1 uk-panel uk-margin-bottom\">\n                    <div class=\"uk-panel-title\">\n                        Line\n                    </div>\n                    <div class=\"uk-margin-left\">\n                        {{ exception.line }}\n                    </div>\n                </div>\n                <div class=\"uk-width-1-1 uk-panel uk-margin-bottom\">\n                    <div class=\"uk-panel-title\">\n                        Class\n                    </div>\n                    <div class=\"uk-margin-left\">\n                        {{ exception.exceptionClass }}\n                    </div>\n                </div>\n                <div class=\"uk-width-1-1 uk-panel uk-margin-bottom\">\n                    <article>\n                        <hr class=\"uk-article-divider\">\n                    </article>\n                </div>\n                <div class=\"uk-width-1-1 uk-panel uk-margin-bottom\">\n                    <div class=\"uk-panel-title\">\n                        Messages\n                    </div>\n                    <article class=\"uk-margin-left\" v-for=\"message in exception.message\">\n                        <p>{{ message }}</p>\n                    </article>\n                </div>\n                <div class=\"uk-width-1-1 uk-panel uk-margin-bottom\">\n                    <div class=\"uk-panel-title\">\n                        Dates\n                    </div>\n                    <article class=\"uk-margin-left\" v-for=\"date in exception.dates\">\n                        <p>{{ date }}</p>\n                    </article>\n                </div>\n            </div>\n        </div>\n    </div>\n</div>\n";

/***/ },
/* 5 */
/***/ function(module, exports, __webpack_require__) {

	var __vue_script__, __vue_template__
	__vue_script__ = __webpack_require__(6)
	if (__vue_script__ &&
	    __vue_script__.__esModule &&
	    Object.keys(__vue_script__).length > 1) {
	  console.warn("[vue-loader] app\\vue\\components\\log-message.vue: named exports in *.vue files are ignored.")}
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
	  var id = "C:\\wamp2.5\\www\\logger\\packages\\nativerank\\pagekit-logger\\app\\vue\\components\\log-message.vue"
	  if (!module.hot.data) {
	    hotAPI.createRecord(id, module.exports)
	  } else {
	    hotAPI.update(id, module.exports, __vue_template__)
	  }
	})()}

/***/ },
/* 6 */
/***/ function(module, exports, __webpack_require__) {

	'use strict';

	module.exports = {

	    props: ['messages'],

	    mixins: [__webpack_require__(3)]
	};

/***/ },
/* 7 */
/***/ function(module, exports) {

	module.exports = "\n<div class=\"uk-panel uk-panel-box\">\n    <h1 class=\"uk-panel-title\">Messages</h1>\n    <table class=\"uk-table uk-table-hover\">\n        <thead>\n        <tr>\n            <td><b>Logger Name</b></td>\n            <td><b>Error Level</b></td>\n            <td><b>Message</b></td>\n            <td><b>Count</b></td>\n            <td>Dates</td>\n        </tr>\n        </thead>\n        <tbody>\n        <template v-for=\"message in messages\">\n            <tr class=\"\" >\n                <td>{{ message.loggerName }}</td>\n                <td>{{ message.errorLevel | mapErrorLevel }}</td>\n                <td>{{ message.message }}</td>\n                <td>{{ message.count }}</td>\n                <td><a class=\"uk-icon-calendar uk-icon-medium\" data-uk-modal=\"{target: '#{{ message.id }}'}\"></a></td>\n            </tr>\n        </template>\n        </tbody>\n    </table>\n</div>\n<div v-for=\"message in messages\" :id=\"message.id\" class=\"uk-modal\">\n    <div class=\"uk-modal-dialog\">\n        <a class=\"uk-modal-close uk-close\"></a>\n        <div class=\"uk-flex uk-flex-column\">\n            <div class=\"uk-width-1-1 uk-panel uk-margin-bottom\">\n                <div class=\"uk-panel-title\">\n                    Dates\n                </div>\n                <ul>\n                    <li v-for=\"date in message.dates\">\n                        {{ date }}\n                    </li>\n                </ul>\n            </div>\n        </div>\n    </div>\n</div>\n";

/***/ }
/******/ ]);