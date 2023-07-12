sprint_editor.registerBlock('my_courses_link', function ($, $el, data) {
    var areas = [
        {
            dataKey : 'link',
            blockName: 'my_input',
            container : '.sp-my_courses_link-area1'
        },
        {
            dataKey : 'text',
            blockName: 'my_input',
            container : '.sp-my_courses_link-area2'
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
