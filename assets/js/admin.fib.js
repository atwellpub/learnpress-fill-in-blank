;(function ($) {
    window.FIB_Admin = {
        initEditor: function (instance, args) {
            args = $.extend({
                selector: '',
                content_css: '',
                setup: function () {

                }
            }, args || {});

            args.setup && args.setup.apply(instance);
        },
        vueComponent: {
            methods: {}
        }
    }

})(jQuery);