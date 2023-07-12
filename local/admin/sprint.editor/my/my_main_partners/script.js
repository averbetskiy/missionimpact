sprint_editor.registerBlock('my_main_partners', function ($, $el, data) {
    var areas = [
        {
            dataKey : 'name_block',
            blockName: 'my_input',
            container : '.sp-my_main_partners-area1'
        },
        {
            dataKey : 'title',
            blockName: 'text',
            container : '.sp-my_main_partners-area2'
        },
        {
            dataKey : 'partners',
            blockName: 'iblock_elements',
            container : '.sp-my_main_partners-area3'
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
