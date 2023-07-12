sprint_editor.registerBlock('my_project_future_events', function ($, $el, data) {
    var areas = [
        {
            dataKey : 'text',
            blockName: 'text',
            container : '.sp-my_project_future_events-area1'
        },
        {
            dataKey : 'text_button',
            blockName: 'text',
            container : '.sp-my_project_future_events-area2'
        },
        {
            dataKey : 'link',
            blockName: 'my_input',
            container : '.sp-my_project_future_events-area3'
        },
        {
            dataKey : 'checkbox',
            blockName: 'my_checkbox',
            container : '.sp-my_project_future_events-area4'
        },
        {
            dataKey : 'blog',
            blockName: 'iblock_elements',
            container : '.sp-my_project_future_events-area5'
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
