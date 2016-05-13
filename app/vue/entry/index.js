
window.Index = {

  el: '#pagekit-logger-index',

  data: function() {
    return {
      logs: window.$data.logs
    }
  },

  ready: function(){

  },

  components: {
    'index-component': require('./../components/index.vue')
  }
};
Vue.ready(window.Index);
