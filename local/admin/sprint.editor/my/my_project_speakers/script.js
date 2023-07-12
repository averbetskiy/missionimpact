sprint_editor.registerBlock('my_project_speakers', function ($, $el, data) {
    var areas = [
        {
            dataKey : 'htag',
            blockName: 'htag',
            container : '.sp-my_project_speakers-area1'
        },
        {
            dataKey : 'text',
            blockName: 'text',
            container : '.sp-my_project_speakers-area2'
        },
        {
            dataKey : 'desc',
            blockName: 'text',
            container : '.sp-my_project_speakers-area3'
        },
        {
            dataKey : 'speakers',
            blockName: 'iblock_elements',
            container : '.sp-my_project_speakers-area4'
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
