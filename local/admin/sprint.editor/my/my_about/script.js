sprint_editor.registerBlock('my_about', function ($, $el, data) {
    var areas = [
        {
            dataKey : 'htag',
            blockName: 'htag',
            container : '.sp-my_about-area1'
        },
        {
            dataKey : 'text',
            blockName: 'text',
            container : '.sp-my_about-area2'
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
