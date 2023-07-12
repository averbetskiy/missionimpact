sprint_editor.registerBlock('my_project_program_new', function ($, $el, data) {
    var areas = [
        {
            dataKey : 'type',
            blockName: 'my_input',
            container : '.sp-my_project_program_new-area1'
        },
        {
            dataKey : 'title',
            blockName: 'text',
            container : '.sp-my_project_program_new-area2'
        },
        {
            dataKey : 'link',
            blockName: 'my_input',
            container : '.sp-my_project_program_new-area3'
        },
        {
            dataKey : 'text_button',
            blockName: 'my_input',
            container : '.sp-my_project_program_new-area4'
        },
        {
            dataKey : 'events',
            blockName: 'iblock_elements',
            container : '.sp-my_project_program_new-area5'
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
