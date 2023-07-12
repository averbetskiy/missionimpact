sprint_editor.registerBlock('my_divein_intro', function ($, $el, data) {
    var areas = [
        {
            dataKey : 'name_block',
            blockName: 'htag',
            container : '.sp-my_divein_intro-area1'
        },
        {
            dataKey : 'htag',
            blockName: 'htag',
            container : '.sp-my_divein_intro-area2'
        },
        {
            dataKey : 'desc',
            blockName: 'text',
            container : '.sp-my_divein_intro-area3'
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
