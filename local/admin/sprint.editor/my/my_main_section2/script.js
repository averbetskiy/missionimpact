sprint_editor.registerBlock('my_main_section2', function ($, $el, data) {
    var areas = [
        {
            dataKey : 'name_block',
            blockName: 'htag',
            container : '.sp-my_main_section2-area1'
        },
        {
            dataKey : 'title',
            blockName: 'text',
            container : '.sp-my_main_section2-area2'
        },
        {
            dataKey : 'sub_title',
            blockName: 'text',
            container : '.sp-my_main_section2-area3'
        },
        {
            dataKey : 'link',
            blockName: 'my_input',
            container : '.sp-my_main_section2-area4'
        },
        {
            dataKey : 'text_botton',
            blockName: 'my_input',
            container : '.sp-my_main_section2-area5'
        },
        {
            dataKey : 'solutions',
            blockName: 'iblock_elements',
            container : '.sp-my_main_section2-area6'
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
