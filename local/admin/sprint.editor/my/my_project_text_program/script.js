sprint_editor.registerBlock('my_project_text_program', function ($, $el, data) {
    var areas = [
        {
            dataKey : 'type',
            blockName: 'my_input',
            container : '.sp-my_project_text_program-area1'
        },
        {
            dataKey : 'title',
            blockName: 'text',
            container : '.sp-my_project_text_program-area2'
        },
        {
            dataKey : 'link',
            blockName: 'my_input',
            container : '.sp-my_project_text_program-area3'
        },
        {
            dataKey : 'text_button',
            blockName: 'my_input',
            container : '.sp-my_project_text_program-area4'
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
