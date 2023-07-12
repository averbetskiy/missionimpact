sprint_editor.registerBlock('my_about_guide', function ($, $el, data) {
    var areas = [
        {
            dataKey : 'name_block',
            blockName: 'my_input',
            container : '.sp-my_about_guide-area1'
        },
        {
            dataKey : 'title',
            blockName: 'text',
            container : '.sp-my_about_guide-area2'
        },
        {
            dataKey : 'image',
            blockName: 'image',
            container : '.sp-my_about_guide-area3'
        },
        {
            dataKey : 'text',
            blockName: 'text',
            container : '.sp-my_about_guide-area4'
        },
        {
            dataKey : 'info',
            blockName: 'text',
            container : '.sp-my_about_guide-area5'
        },
        {
            dataKey : 'text1',
            blockName: 'text',
            container : '.sp-my_about_guide-area6'
        },
        {
            dataKey : 'text2',
            blockName: 'text',
            container : '.sp-my_about_guide-area7'
        },
        {
            dataKey : 'text3',
            blockName: 'text',
            container : '.sp-my_about_guide-area8'
        },
        {
            dataKey : 'text4',
            blockName: 'text',
            container : '.sp-my_about_guide-area9'
        },
        {
            dataKey : 'text5',
            blockName: 'text',
            container : '.sp-my_about_guide-area10'
        },
        {
            dataKey : 'text6',
            blockName: 'text',
            container : '.sp-my_about_guide-area11'
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
