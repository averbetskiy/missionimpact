sprint_editor.registerBlock('my_solutions', function ($, $el, data) {
    var areas = [
        {
            dataKey : 'title',
            blockName: 'text',
            container : '.sp-my_solutions-area1'
        },
        {
            dataKey : 'link',
            blockName: 'my_input',
            container : '.sp-my_solutions-area2'
        },
        {
            dataKey : 'text_button',
            blockName: 'my_input',
            container : '.sp-my_solutions-area3'
        },
        {
            dataKey : 'image1',
            blockName: 'image',
            container : '.sp-my_solutions-area4'
        },
        {
            dataKey : 'text1',
            blockName: 'text',
            container : '.sp-my_solutions-area5'
        },
        {
            dataKey : 'image2',
            blockName: 'image',
            container : '.sp-my_solutions-area6'
        },
        {
            dataKey : 'text2',
            blockName: 'text',
            container : '.sp-my_solutions-area7'
        },
        {
            dataKey : 'image3',
            blockName: 'image',
            container : '.sp-my_solutions-area8'
        },
        {
            dataKey : 'text3',
            blockName: 'text',
            container : '.sp-my_solutions-area9'
        },
        {
            dataKey : 'cases',
            blockName: 'iblock_elements',
            container : '.sp-my_solutions-area10'
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
