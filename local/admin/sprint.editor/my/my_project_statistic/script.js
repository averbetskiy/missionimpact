sprint_editor.registerBlock('my_project_statistic', function ($, $el, data) {
    var areas = [
        {
            dataKey : 'name_block',
            blockName: 'my_input',
            container : '.sp-my_project_statistic-area1'
        },
        {
            dataKey : 'title',
            blockName: 'text',
            container : '.sp-my_project_statistic-area2'
        },
        {
            dataKey : 'desc',
            blockName: 'text',
            container : '.sp-my_project_statistic-area3'
        },
        {
            dataKey : 'digit1',
            blockName: 'text',
            container : '.sp-my_project_statistic-area4'
        },
        {
            dataKey : 'title1',
            blockName: 'text',
            container : '.sp-my_project_statistic-area5'
        },
        {
            dataKey : 'text1',
            blockName: 'text',
            container : '.sp-my_project_statistic-area6'
        },
        {
            dataKey : 'digit2',
            blockName: 'text',
            container : '.sp-my_project_statistic-area7'
        },
        {
            dataKey : 'title2',
            blockName: 'text',
            container : '.sp-my_project_statistic-area8'
        },
        {
            dataKey : 'text2',
            blockName: 'text',
            container : '.sp-my_project_statistic-area9'
        },
        {
            dataKey : 'title2',
            blockName: 'text',
            container : '.sp-my_project_statistic-area8'
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
