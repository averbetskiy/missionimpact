sprint_editor.registerBlock('my_main_hero_list', function ($, $el, data) {
    var areas = [
        {
            dataKey : 'type',
            blockName: 'my_input',
            container : '.sp-my_main_hero_list-area1'
        },
        {
            dataKey : 'link',
            blockName: 'text',
            container : '.sp-my_main_hero_list-area2'
        },
        {
            dataKey : 'link_text',
            blockName: 'text',
            container : '.sp-my_main_hero_list-area3'
        },
        {
            dataKey : 'date',
            blockName: 'text',
            container : '.sp-my_main_hero_list-area4'
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
