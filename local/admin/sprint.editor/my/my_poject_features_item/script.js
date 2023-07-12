sprint_editor.registerBlock('my_poject_features_item', function ($, $el, data) {
    var areas = [
        {
            dataKey : 'digit1',
            blockName: 'text',
            container : '.sp-my_poject_features_item-area1'
        },
        {
            dataKey : 'title1',
            blockName: 'text',
            container : '.sp-my_poject_features_item-area2'
        },
        {
            dataKey : 'digit2',
            blockName: 'text',
            container : '.sp-my_poject_features_item-area3'
        },
        {
            dataKey : 'title2',
            blockName: 'text',
            container : '.sp-my_poject_features_item-area4'
        },
        {
            dataKey : 'digit3',
            blockName: 'text',
            container : '.sp-my_poject_features_item-area5'
        },
        {
            dataKey : 'title3',
            blockName: 'text',
            container : '.sp-my_poject_features_item-area6'
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