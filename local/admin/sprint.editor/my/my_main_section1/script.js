sprint_editor.registerBlock('my_main_section1', function ($, $el, data) {
    var areas = [
        {
            dataKey : 'name_block',
            blockName: 'htag',
            container : '.sp-my_main_section1-area1'
        },
        {
            dataKey : 'title',
            blockName: 'htag',
            container : '.sp-my_main_section1-area2'
        },
        {
            dataKey : 'link',
            blockName: 'my_input',
            container : '.sp-my_main_section1-area3'
        },
        {
            dataKey : 'text_button',
            blockName: 'my_input',
            container : '.sp-my_main_section1-area4'
        },
        {
            dataKey : 'title_bottom',
            blockName: 'text',
            container : '.sp-my_main_section1-area5'
        },
        {
            dataKey : 'image',
            blockName: 'image',
            container : '.sp-my_main_section1-area6'
        },
        {
            dataKey : 'image_text',
            blockName: 'text',
            container : '.sp-my_main_section1-area7'
        },
        {
            dataKey : 'title1',
            blockName: 'text',
            container : '.sp-my_main_section1-area8'
        },
        {
            dataKey : 'type1',
            blockName: 'text',
            container : '.sp-my_main_section1-area9'
        },
        {
            dataKey : 'title2',
            blockName: 'text',
            container : '.sp-my_main_section1-area10'
        },
        {
            dataKey : 'type2',
            blockName: 'text',
            container : '.sp-my_main_section1-area11'
        },
        {
            dataKey : 'title3',
            blockName: 'text',
            container : '.sp-my_main_section1-area12'
        },
        {
            dataKey : 'type4',
            blockName: 'text',
            container : '.sp-my_main_section1-area13'
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
