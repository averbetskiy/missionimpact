sprint_editor.registerBlock('my_about_solutions', function ($, $el, data) {
    var areas = [
        {
            dataKey : 'name_block',
            blockName: 'my_input',
            container : '.sp-my_about_solutions-area1'
        },
        {
            dataKey : 'title',
            blockName: 'text',
            container : '.sp-my_about_solutions-area2'
        },
        {
            dataKey : 'link',
            blockName: 'my_input',
            container : '.sp-my_about_solutions-area3'
        },
        {
            dataKey : 'text_button',
            blockName: 'my_input',
            container : '.sp-my_about_solutions-area4'
        },
        {
            dataKey : 'digit',
            blockName: 'text',
            container : '.sp-my_about_solutions-area5'
        },
        {
            dataKey : 'info',
            blockName: 'text',
            container : '.sp-my_about_solutions-area6'
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
