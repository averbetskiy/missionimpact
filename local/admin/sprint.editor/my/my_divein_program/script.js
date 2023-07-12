sprint_editor.registerBlock('my_divein_program', function ($, $el, data) {
    var areas = [
        {
            dataKey : 'name_block',
            blockName: 'htag',
            container : '.sp-my_divein_program-area1'
        },
        {
            dataKey : 'desc',
            blockName: 'text',
            container : '.sp-my_divein_program-area2'
        },
        {
            dataKey : 'link',
            blockName: 'my_input',
            container : '.sp-my_divein_program-area3'
        },
        {
            dataKey : 'text_botton',
            blockName: 'my_input',
            container : '.sp-my_divein_program-area4'
        },
        {
            dataKey : 'program',
            blockName: 'iblock_elements',
            container : '.sp-my_divein_program-area5'
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
