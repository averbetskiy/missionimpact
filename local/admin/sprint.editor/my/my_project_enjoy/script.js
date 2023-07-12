sprint_editor.registerBlock('my_project_enjoy', function ($, $el, data) {
    var areas = [
        {
            dataKey : 'htag',
            blockName: 'text',
            container : '.sp-my_project_enjoy-area1'
        },
        {
            dataKey : 'text',
            blockName: 'text',
            container : '.sp-my_project_enjoy-area2'
        },
        {
            dataKey : 'link',
            blockName: 'text',
            container : '.sp-my_project_enjoy-area3'
        },
        {
            dataKey : 'blog',
            blockName: 'iblock_elements',
            container : '.sp-my_project_enjoy-area4'
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
