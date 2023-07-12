sprint_editor.registerBlock('my_detail_picture', function ($, $el, data) {
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
