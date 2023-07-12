sprint_editor.registerBlock('my_about_item_statistic', function ($, $el, data) {
    var areas = [
        {
            dataKey : 'digit',
            blockName: 'text',
            container : '.sp-my_about_item_statistic-area1'
        },
        {
            dataKey : 'title',
            blockName: 'text',
            container : '.sp-my_about_item_statistic-area2'
        },
        {
            dataKey : 'text',
            blockName: 'text',
            container : '.sp-my_about_item_statistic-area3'
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
