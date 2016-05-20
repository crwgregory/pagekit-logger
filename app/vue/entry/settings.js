
window.Settings = {

    el: "#pagekit-logger-settings",

    data: function() {
        return {

        }
    },

    components: {
        'settings' : require('./../components/settings/settings.vue')
    }
};

Vue.ready(window.Settings);
