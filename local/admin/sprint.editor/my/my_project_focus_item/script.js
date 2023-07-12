sprint_editor.registerBlock('my_project_focus_item', function ($, $el, data) {
    var areas = [
        {
            dataKey : 'digit1',
            blockName: 'files',
            container : '.sp-my_project_focus_item-area1'
        },
        {
            dataKey : 'title1',
            blockName: 'text',
            container : '.sp-my_project_focus_item-area2'
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