sprint_editor.registerBlock('my_project_contacts_map', function ($, $el, data) {
    var areas = [
        {
            dataKey : 'text',
            blockName: 'text',
            container : '.sp-my_project_contacts_map-area1'
        },
        {
            dataKey : 'htag',
            blockName: 'htag',
            container : '.sp-my_project_contacts_map-area2'
        },
        {
            dataKey : 'map',
            blockName: 'yandex_map',
            container : '.sp-my_project_contacts_map-area3'
        },
        {
            dataKey : 'color',
            blockName: 'my_input',
            container : '.sp-my_project_contacts_map-area4'
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
