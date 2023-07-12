sprint_editor.registerBlock('my_text', function ($, $el, data) {
    var areas = [
        {
            dataKey : 'text',
            blockName: 'text',
            container : '.sp-my_text-area1'
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
