sprint_editor.registerBlock('my_about_cases_text', function ($, $el, data) {
    var areas = [
        {
            dataKey : 'name_block',
            blockName: 'my_input',
            container : '.sp-my_about_cases_text-area1'
        },
        {
            dataKey : 'title',
            blockName: 'text',
            container : '.sp-my_about_cases_text-area2'
        },
        {
            dataKey : 'sub_title',
            blockName: 'text',
            container : '.sp-my_about_cases_text-area3'
        },
        {
            dataKey : 'link',
            blockName: 'my_input',
            container : '.sp-my_about_cases_text-area4'
        },
        {
            dataKey : 'text_button',
            blockName: 'my_input',
            container : '.sp-my_about_cases_text-area5'
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
