sprint_editor.registerBlock('my_it_hero', function ($, $el, data) {
    var areas = [
        {
            dataKey : 'image',
            blockName: 'image',
            container : '.sp-my_it_hero-area1'
        },
        {
            dataKey : 'text',
            blockName: 'text',
            container : '.sp-my_it_hero-area2'
        },
        {
            dataKey : 'desc',
            blockName: 'text',
            container : '.sp-my_it_hero-area3'
        },
        {
            dataKey : 'logo',
            blockName: 'image',
            container : '.sp-my_it_hero-area4'
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
