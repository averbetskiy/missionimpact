sprint_editor.registerBlock('my_project_team', function ($, $el, data) {
    var areas = [
        {
            dataKey : 'htag',
            blockName: 'text',
            container : '.sp-my_project_team-area1'
        },
        {
            dataKey : 'text',
            blockName: 'text',
            container : '.sp-my_project_team-area2'
        },
        {
            dataKey : 'desc',
            blockName: 'text',
            container : '.sp-my_project_team-area3'
        },
        {
            dataKey : 'mask',
            blockName: 'text',
            container : '.sp-my_project_team-area4'
        },
        {
            dataKey : 'speakers',
            blockName: 'iblock_elements',
            container : '.sp-my_project_team-area5'
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
