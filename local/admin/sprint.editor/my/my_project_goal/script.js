sprint_editor.registerBlock('my_project_goal', function ($, $el, data) {
    var areas = [
        {
            dataKey : 'htag',
            blockName: 'htag',
            container : '.sp-my_project_goal-area1'
        },
        {
            dataKey : 'text',
            blockName: 'text',
            container : '.sp-my_project_goal-area2'
        },
        {
            dataKey : 'desc',
            blockName: 'text',
            container : '.sp-my_project_goal-area3'
        },
        {
            dataKey : 'images',
            blockName: 'my_hero_media',
            container : '.sp-my_project_goal-area4'
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
