sprint_editor.registerBlock('my_form', function ($, $el, data) {
    var areas = [
        {
            dataKey : 'form',
            blockName: 'my_input',
            container : '.sp-my_form-area1'
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
