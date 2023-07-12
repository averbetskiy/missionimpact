sprint_editor.registerBlock('my_about_group', function ($, $el, data) {
    var areas = [
        {
            dataKey : 'name_block',
            blockName: 'my_input',
            container : '.sp-my_about_group-area1'
        },
        {
            dataKey : 'title',
            blockName: 'text',
            container : '.sp-my_about_group-area2'
        },
        {
            dataKey : 'text',
            blockName: 'text',
            container : '.sp-my_about_group-area3'
        },
        {
            dataKey : 'link',
            blockName: 'my_input',
            container : '.sp-my_about_group-area4'
        },
        {
            dataKey : 'text_button',
            blockName: 'my_input',
            container : '.sp-my_about_group-area5'
        },
        {
            dataKey : 'images',
            blockName: 'gallery',
            container : '.sp-my_about_group-area6'
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
