sprint_editor.registerBlock('my_project_features', function ($, $el, data) {
    var areas = [
        {
            dataKey : 'htag_result',
            blockName: 'htag',
            container : '.sp-my_project_features-area1'
        },
        {
            dataKey : 'text_result',
            blockName: 'text',
            container : '.sp-my_project_features-area2'
        },
        {
            dataKey : 'digit1',
            blockName: 'text',
            container : '.sp-my_project_features-area3'
        },
        {
            dataKey : 'title1',
            blockName: 'text',
            container : '.sp-my_project_features-area4'
        },
        {
            dataKey : 'digit2',
            blockName: 'text',
            container : '.sp-my_project_features-area5'
        },
        {
            dataKey : 'title2',
            blockName: 'text',
            container : '.sp-my_project_features-area6'
        },
        {
            dataKey : 'digit3',
            blockName: 'text',
            container : '.sp-my_project_features-area7'
        },
        {
            dataKey : 'title3',
            blockName: 'text',
            container : '.sp-my_project_features-area8'
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