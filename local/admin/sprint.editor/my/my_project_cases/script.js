sprint_editor.registerBlock('my_project_cases', function ($, $el, data) {
    var areas = [
        {
            dataKey : 'title',
            blockName: 'my_input',
            container : '.sp-my_project_cases-area1'
        },
        {
            dataKey : 'link',
            blockName: 'my_input',
            container : '.sp-my_project_cases-area2'
        },
        {
            dataKey : 'text_button',
            blockName: 'my_input',
            container : '.sp-my_project_cases-area3'
        },
        {
            dataKey : 'events',
            blockName: 'iblock_elements',
            container : '.sp-my_project_cases-area4'
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
