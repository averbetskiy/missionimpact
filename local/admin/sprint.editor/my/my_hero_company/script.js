sprint_editor.registerBlock('my_hero_company', function ($, $el, data) {
    var areas = [
        {
            dataKey : 'logos',
            blockName: 'iblock_elements',
            container : '.sp-my_hero_company-logos'
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
