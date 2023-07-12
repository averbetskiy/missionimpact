sprint_editor.registerBlock('my_project_features_text', function ($, $el, data) {
    var areas = [
        {
            dataKey : 'htag_result',
            blockName: 'htag',
            container : '.sp-my_project_features_text-area1'
        },
        {
            dataKey : 'text_result',
            blockName: 'text',
            container : '.sp-my_project_features_text-area2'
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