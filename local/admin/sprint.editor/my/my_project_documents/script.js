sprint_editor.registerBlock('my_project_documents', function ($, $el, data) {
    var areas = [
        {
            dataKey : 'name_block',
            blockName: 'my_input',
            container : '.sp-my_project_documents-area1'
        },
        {
            dataKey : 'text',
            blockName: 'text',
            container : '.sp-my_project_documents-area2'
        },
        {
            dataKey : 'documents',
            blockName: 'files',
            container : '.sp-my_project_documents-area3'
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