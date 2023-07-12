sprint_editor.registerBlock('my_main_section5', function ($, $el, data) {
    var areas = [
        {
            dataKey : 'name_block',
            blockName: 'htag',
            container : '.sp-my_main_section5-area1'
        },
        {
            dataKey : 'title',
            blockName: 'text',
            container : '.sp-my_main_section5-area2'
        },
        {
            dataKey : 'link',
            blockName: 'my_input',
            container : '.sp-my_main_section5-area3'
        },
        {
            dataKey : 'text_botton',
            blockName: 'my_input',
            container : '.sp-my_main_section5-area4'
        },
        {
            dataKey : 'news',
            blockName: 'iblock_elements',
            container : '.sp-my_main_section5-area5'
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
