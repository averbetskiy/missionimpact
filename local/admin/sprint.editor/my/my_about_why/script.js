sprint_editor.registerBlock('my_about_why', function ($, $el, data) {
    var areas = [
        {
            dataKey : 'image',
            blockName: 'image',
            container : '.sp-my_about_why-area1'
        },
        {
            dataKey : 'title',
            blockName: 'text',
            container : '.sp-my_about_why-area2'
        },
        {
            dataKey : 'text_bottom',
            blockName: 'text',
            container : '.sp-my_about_why-area3'
        },
        {
            dataKey : 'title1',
            blockName: 'text',
            container : '.sp-my_about_why-area4'
        },
        {
            dataKey : 'text1',
            blockName: 'text',
            container : '.sp-my_about_why-area5'
        },
        {
            dataKey : 'title2',
            blockName: 'text',
            container : '.sp-my_about_why-area6'
        },
        {
            dataKey : 'text2',
            blockName: 'text',
            container : '.sp-my_about_why-area7'
        },
        {
            dataKey : 'title3',
            blockName: 'text',
            container : '.sp-my_about_why-area8'
        },
        {
            dataKey : 'text3',
            blockName: 'text',
            container : '.sp-my_about_why-area9'
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
