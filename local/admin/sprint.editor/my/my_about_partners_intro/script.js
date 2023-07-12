sprint_editor.registerBlock('my_about_partners_intro', function ($, $el, data) {
    var areas = [
        {
            dataKey : 'name_block',
            blockName: 'my_input',
            container : '.sp-my_about_partners_intro-area1'
        },
        {
            dataKey : 'htag',
            blockName: 'htag',
            container : '.sp-my_about_partners_intro-area2'
        },
        {
            dataKey : 'sub_title',
            blockName: 'text',
            container : '.sp-my_about_partners_intro-area3'
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
