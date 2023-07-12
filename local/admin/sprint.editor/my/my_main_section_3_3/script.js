sprint_editor.registerBlock('my_main_section_3_3', function ($, $el, data) {
    var areas = [
        {
            dataKey : 'text',
            blockName: 'text',
            container : '.sp-my_main_section_3_3-area1'
        },
        {
            dataKey : 'author',
            blockName: 'iblock_elements',
            container : '.sp-my_main_section_3_3-area2'
        },
        {
            dataKey : 'company',
            blockName: 'iblock_elements',
            container : '.sp-my_main_section_3_3-area3'
        },
        {
            dataKey : 'image',
            blockName: 'image',
            container : '.sp-my_main_section_3_3-area4'
        },
        {
            dataKey : 'video',
            blockName: 'video',
            container : '.sp-my_main_section_3_3-area5'
        },
        {
            dataKey : 'video_files',
            blockName: 'files',
            container : '.sp-my_main_section_3_3-area6'
        },
        {
            dataKey : 'time',
            blockName: 'my_input',
            container : '.sp-my_main_section_3_3-area7'
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
