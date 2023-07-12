sprint_editor.registerBlock('my_input', function ($, $el, data, settings) {

        settings = settings || {};

        data = $.extend({
            value: ''
        }, data);

        this.getData = function () {
            return data;
        };

        this.collectData = function () {
            if (!$.fn.trumbowyg) {
                return data;
            }

            data.value = $el.find('.sp-input').val();

            return data;
        };

        this.afterRender = function () {

        };
    }
);
