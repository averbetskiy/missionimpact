sprint_editor.registerBlock('my_project_contacts_link', function ($, $el, data) {
    var areas = [
        {
            dataKey : 'text',
            blockName: 'text',
            container : '.sp-my_project_contacts_link-area1'
        },
        {
            dataKey : 'link',
            blockName: 'my_input',
            container : '.sp-my_project_contacts_link-area2'
        },
        {
            dataKey : 'text_botton',
            blockName: 'my_input',
            container : '.sp-my_project_contacts_link-area3'
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
