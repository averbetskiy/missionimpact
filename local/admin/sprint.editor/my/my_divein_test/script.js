sprint_editor.registerBlock('my_divein_test', function ($, $el, data) {
    var areas = [
        {
            dataKey : 'name_block',
            blockName: 'htag',
            container : '.sp-my_divein_test-area1'
        },
        {
            dataKey : 'desc',
            blockName: 'text',
            container : '.sp-my_divein_test-area2'
        },
        {
            dataKey : 'link',
            blockName: 'my_input',
            container : '.sp-my_divein_test-area3'
        },
        {
            dataKey : 'text_botton',
            blockName: 'my_input',
            container : '.sp-my_divein_test-area4'
        },
        {
            dataKey : 'test',
            blockName: 'iblock_elements',
            container : '.sp-my_divein_test-area5'
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
