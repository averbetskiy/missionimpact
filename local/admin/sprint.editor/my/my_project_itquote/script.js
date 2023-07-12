sprint_editor.registerBlock('my_project_itquote', function ($, $el, data) {
    var areas = [
        {
            dataKey : 'text',
            blockName: 'text',
            container : '.sp-my_project_itquote-area1'
        },
        {
            dataKey : 'speaker',
            blockName: 'iblock_elements',
            container : '.sp-my_project_itquote-area2'
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
