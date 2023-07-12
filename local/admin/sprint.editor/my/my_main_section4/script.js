sprint_editor.registerBlock('my_main_section4', function ($, $el, data) {
    var areas = [
        {
            dataKey : 'name_block',
            blockName: 'htag',
            container : '.sp-my_main_section4-area1'
        },
        {
            dataKey : 'title',
            blockName: 'text',
            container : '.sp-my_main_section4-area2'
        },
        {
            dataKey : 'link',
            blockName: 'my_input',
            container : '.sp-my_main_section4-area3'
        },
        {
            dataKey : 'text_botton',
            blockName: 'my_input',
            container : '.sp-my_main_section4-area4'
        },
        {
            dataKey : 'events',
            blockName: 'iblock_elements',
            container : '.sp-my_main_section4-area5'
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
