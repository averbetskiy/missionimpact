sprint_editor.registerBlock('my_divein_events', function ($, $el, data) {
    var areas = [
        {
            dataKey : 'name_block',
            blockName: 'htag',
            container : '.sp-my_divein_events-area1'
        },
        {
            dataKey : 'desc',
            blockName: 'text',
            container : '.sp-my_divein_events-area2'
        },
        {
            dataKey : 'link',
            blockName: 'my_input',
            container : '.sp-my_divein_events-area3'
        },
        {
            dataKey : 'text_botton',
            blockName: 'my_input',
            container : '.sp-my_divein_events-area4'
        },
        {
            dataKey : 'events',
            blockName: 'iblock_elements',
            container : '.sp-my_divein_events-area5'
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
