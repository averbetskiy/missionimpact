sprint_editor.registerBlock('my_about_cases', function ($, $el, data) {
    var areas = [
        {
            dataKey : 'cases',
            blockName: 'iblock_elements',
            container : '.sp-my_about_cases-area1'
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
