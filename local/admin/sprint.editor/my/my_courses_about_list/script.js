sprint_editor.registerBlock('my_courses_about_list', function ($, $el, data) {
    var areas = [
        {
            dataKey : 'title',
            blockName: 'text',
            container : '.sp-my_courses_about_list-area1'
        },
        {
            dataKey : 'text',
            blockName: 'text',
            container : '.sp-my_courses_about_list-area2'
        },
    ];

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
