sprint_editor.registerBlock('my_about_text_statistic', function ($, $el, data) {
    var areas = [
        {
            dataKey : 'name_block',
            blockName: 'my_input',
            container : '.sp-my_about_text_statistic-area1'
        },
        {
            dataKey : 'title',
            blockName: 'text',
            container : '.sp-my_about_text_statistic-area2'
        },
        {
            dataKey : 'text_bottom',
            blockName: 'text',
            container : '.sp-my_about_text_statistic-area3'
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
