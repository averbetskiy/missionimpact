sprint_editor.registerBlock('my_about_partners_cases', function ($, $el, data) {
    var areas = [];

    this.getData = function () {
        return data;
    };

    this.collectData = function () {
        return data;
    };

    this.getAreas = function(){
        return areas;
    };
});
