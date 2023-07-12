sprint_editor.registerBlock('my_about_hero', function ($, $el, data) {
    var areas = [
        {
            dataKey : 'image',
            blockName: 'image',
            container : '.sp-my_about_hero-area1'
        },
        {
            dataKey : 'text',
            blockName: 'text',
            container : '.sp-my_about_hero-area2'
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
