sprint_editor.registerBlock('my_project_item_program', function ($, $el, data) {
    var areas = [
        {
            dataKey : 'type',
            blockName: 'text',
            container : '.sp-my_project_item_program-area1'
        },
        {
            dataKey : 'title',
            blockName: 'text',
            container : '.sp-my_project_item_program-area2'
        },
        {
            dataKey : 'desc',
            blockName: 'text',
            container : '.sp-my_project_item_program-area3'
        },
        {
            dataKey : 'desc_detail',
            blockName: 'text',
            container : '.sp-my_project_item_program-area4'
        },
        {
            dataKey : 'link',
            blockName: 'my_input',
            container : '.sp-my_project_item_program-area5'
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
