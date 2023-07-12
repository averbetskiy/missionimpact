sprint_editor.registerBlock('my_hero', function ($, $el, data) {
    var areas = [
        {
            dataKey : 'image',
            blockName: 'image',
            container : '.sp-my_hero-area1'
        },
        {
            dataKey : 'text',
            blockName: 'text',
            container : '.sp-my_hero-area2'
        },
        {
            dataKey : 'desc',
            blockName: 'text',
            container : '.sp-my_hero-area3'
        },
        {
            dataKey : 'logo',
            blockName: 'image',
            container : '.sp-my_hero-area4'
        },
        {
            dataKey : 'text_col1',
            blockName: 'text',
            container : '.sp-my_hero-area5'
        },
        {
            dataKey : 'text_col2',
            blockName: 'text',
            container : '.sp-my_hero-area6'
        },
        {
            dataKey : 'link',
            blockName: 'my_input',
            container : '.sp-my_hero-area7'
        },
        {
            dataKey : 'name_button',
            blockName: 'my_input',
            container : '.sp-my_hero-area8'
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
