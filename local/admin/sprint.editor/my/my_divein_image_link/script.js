sprint_editor.registerBlock('my_divein_image_link', function ($, $el, data) {
    var areas = [
        {
            dataKey : 'title',
            blockName: 'text',
            container : '.sp-my_divein_image_link-area1'
        },
        {
            dataKey : 'subtitle',
            blockName: 'text',
            container : '.sp-my_divein_image_link-area2'
        },
        {
            dataKey : 'link',
            blockName: 'my_input',
            container : '.sp-my_divein_image_link-area3'
        },
        {
            dataKey : 'text_link',
            blockName: 'my_input',
            container : '.sp-my_divein_image_link-area4'
        },
        {
            dataKey : 'image',
            blockName: 'image',
            container : '.sp-my_divein_image_link-area5'
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
