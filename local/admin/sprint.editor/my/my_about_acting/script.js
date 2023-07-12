sprint_editor.registerBlock('my_about_acting', function ($, $el, data) {
    var areas = [
        {
            dataKey : 'text',
            blockName: 'text',
            container : '.sp-my_about_acting-area1'
        },
        {
            dataKey : 'image1',
            blockName: 'image',
            container : '.sp-my_about_acting-area2'
        },
        {
            dataKey : 'text1',
            blockName: 'text',
            container : '.sp-my_about_acting-area3'
        },
        {
            dataKey : 'image2',
            blockName: 'image',
            container : '.sp-my_about_acting-area4'
        },
        {
            dataKey : 'text2',
            blockName: 'text',
            container : '.sp-my_about_acting-area5'
        },
        {
            dataKey : 'image3',
            blockName: 'image',
            container : '.sp-my_about_acting-area6'
        },
        {
            dataKey : 'text3',
            blockName: 'text',
            container : '.sp-my_about_acting-area7'
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
