sprint_editor.registerBlock('my_project_members', function ($, $el, data) {
    var areas = [
        {
            dataKey : 'htag',
            blockName: 'htag',
            container : '.sp-my_project_members-area1'
        },
        {
            dataKey : 'text',
            blockName: 'text',
            container : '.sp-my_project_members-area2'
        },
        {
            dataKey : 'desc',
            blockName: 'text',
            container : '.sp-my_project_members-area3'
        },
        {
            dataKey : 'speakers',
            blockName: 'iblock_elements',
            container : '.sp-my_project_members-area4'
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
