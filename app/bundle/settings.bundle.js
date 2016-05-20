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
/******/ ({

/***/ 0:
/***/ function(module, exports, __webpack_require__) {

	
	window.Settings = {

	    el: "#pagekit-logger-settings",

	    data: function() {
	        return {

	        }
	    },

	    components: {
	        'settings' : __webpack_require__(18)
	    }
	};

	Vue.ready(window.Settings);


/***/ },

/***/ 7:
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

/***/ 18:
/***/ function(module, exports, __webpack_require__) {

	var __vue_script__, __vue_template__
	__vue_script__ = __webpack_require__(19)
	if (__vue_script__ &&
	    __vue_script__.__esModule &&
	    Object.keys(__vue_script__).length > 1) {
	  console.warn("[vue-loader] app\\vue\\components\\settings\\settings.vue: named exports in *.vue files are ignored.")}
	__vue_template__ = __webpack_require__(20)
	module.exports = __vue_script__ || {}
	if (module.exports.__esModule) module.exports = module.exports.default
	if (__vue_template__) {
	(typeof module.exports === "function" ? (module.exports.options || (module.exports.options = {})) : module.exports).template = __vue_template__
	}
	if (false) {(function () {  module.hot.accept()
	  var hotAPI = require("vue-hot-reload-api")
	  hotAPI.install(require("vue"), true)
	  if (!hotAPI.compatible) return
	  var id = "C:\\wamp2.5\\www\\logger\\packages\\nativerank\\pagekit-logger\\app\\vue\\components\\settings\\settings.vue"
	  if (!module.hot.data) {
	    hotAPI.createRecord(id, module.exports)
	  } else {
	    hotAPI.update(id, module.exports, __vue_template__)
	  }
	})()}

/***/ },

/***/ 19:
/***/ function(module, exports, __webpack_require__) {

	'use strict';

	var local = window.location;

	module.exports = {
	    data: function data() {

	        return {

	            settings: window.$data.settings
	        };
	    },


	    filters: {
	        'isLevel': function isLevel(lvl) {

	            return lvl === this.settings.log_level;
	        }
	    },

	    methods: {
	        saveSettings: function saveSettings() {

	            var settings = {

	                keepDates: this.settings.log_dates,

	                keepMessages: this.settings.log_messages,

	                logLevel: this.settings.log_level
	            };

	            var path = local.pathname.replace('settings', 'save-default-settings');

	            this.$http.post(path, { settings: settings }).then(function (res) {

	                if (res.data.success === true) {

	                    location.reload();
	                } else {

	                    console.log(res.data);

	                    UIkit.modal.alert("Save settings failed. Message: '" + res.data.exception_message + "'");
	                }
	            }).catch(function (err) {

	                throw new Error(err);
	            });
	        }
	    },

	    mixins: [__webpack_require__(7)]

	};

/***/ },

/***/ 20:
/***/ function(module, exports) {

	module.exports = "\n\n<form class=\"uk-form\" @submit.prevent=\"saveSettings\">\n    <fieldset>\n        <legend>Default Settings</legend>\n        <div class=\"uk-form-row\">\n            <label>\n                <input type=\"checkbox\" v-model=\"settings.log_dates\" :checked=\"settings.log_dates\">\n                Save Dates</label>\n        </div>\n        <div class=\"uk-form-row\">\n            <label>\n                <input type=\"checkbox\" v-model=\"settings.log_messages\" :checked=\"settings.log_messages\">\n                Save Messages\n            </label>\n        </div>\n        <div class=\"uk-form-row\">\n            <select v-model=\"settings.log_level\">\n                <option v-for=\"level in errorLevels\" :value=\"level[0]\" :selected=\"level[0] | isLevel\">\n                    {{ level[1] }}\n                </option>\n            </select>\n            <span class=\"uk-form-help-inline\"><i class=\"uk-icon-info-circle\" data-uk-tooltip title=\"The default error level used when creating a log if one isn't specified.\"></i></span>\n        </div>\n        <button class=\"uk-button uk-button-primary uk-margin-top\" type=\"submit\">Save</button>\n    </fieldset>\n</form>\n\n";

/***/ }

/******/ });