sprint_editor.registerBlock('my_project_contacts', function ($, $el, data) {
    var areas = [
        {
            dataKey : 'text',
            blockName: 'text',
            container : '.sp-my_project_contacts-area1'
        },
        {
            dataKey : 'htag',
            blockName: 'htag',
            container : '.sp-my_project_contacts-area2'
        },
        {
            dataKey : 'desc',
            blockName: 'text',
            container : '.sp-my_project_contacts-area3'
        },
        {
            dataKey : 'link',
            blockName: 'my_input',
            container : '.sp-my_project_contacts-area4'
        },
        {
            dataKey : 'text_button',
            blockName: 'my_input',
            container : '.sp-my_project_contacts-area5'
        },
        {
            dataKey : 'map',
            blockName: 'yandex_map',
            container : '.sp-my_project_contacts-area6'
        },
        {
            dataKey : 'color',
            blockName: 'my_input',
            container : '.sp-my_project_contacts-area7'
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
