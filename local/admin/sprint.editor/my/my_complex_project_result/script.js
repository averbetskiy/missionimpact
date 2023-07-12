sprint_editor.registerBlock('my_complex_project_result', function ($, $el, data) {
    var areas = [
        {
            dataKey : 'htag_result',
            blockName: 'htag',
            container : '.sp-my_complex_project_result-area1'
        },
        {
            dataKey : 'text_result',
            blockName: 'text',
            container : '.sp-my_complex_project_result-area2'
        },
        {
            dataKey : 'digit1',
            blockName: 'text',
            container : '.sp-my_complex_project_result-area3'
        },
        {
            dataKey : 'title1',
            blockName: 'text',
            container : '.sp-my_complex_project_result-area4'
        },
        {
            dataKey : 'digit2',
            blockName: 'text',
            container : '.sp-my_complex_project_result-area5'
        },
        {
            dataKey : 'title2',
            blockName: 'text',
            container : '.sp-my_complex_project_result-area6'
        },
        {
            dataKey : 'digit3',
            blockName: 'text',
            container : '.sp-my_complex_project_result-area7'
        },
        {
            dataKey : 'title3',
            blockName: 'text',
            container : '.sp-my_complex_project_result-area8'
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