sprint_editor.registerBlock('my_main_section_3_2', function ($, $el, data) {
    var areas = [
        {
            dataKey : 'name_list',
            blockName: 'my_input',
            container : '.sp-my_main_section_3_2-area1'
        },
        {
            dataKey : 'value1',
            blockName: 'text',
            container : '.sp-my_main_section_3_2-area2'
        },
        {
            dataKey : 'title1',
            blockName: 'text',
            container : '.sp-my_main_section_3_2-area3'
        },
        {
            dataKey : 'value2',
            blockName: 'text',
            container : '.sp-my_main_section_3_2-area4'
        },
        {
            dataKey : 'title2',
            blockName: 'text',
            container : '.sp-my_main_section_3_2-area5'
        },
        {
            dataKey : 'value3',
            blockName: 'text',
            container : '.sp-my_main_section_3_2-area6'
        },
        {
            dataKey : 'title3',
            blockName: 'text',
            container : '.sp-my_main_section_3_2-area7'
        },
        {
            dataKey : 'value4',
            blockName: 'text',
            container : '.sp-my_main_section_3_2-area8'
        },
        {
            dataKey : 'title4',
            blockName: 'text',
            container : '.sp-my_main_section_3_2-area9'
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
