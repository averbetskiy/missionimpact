sprint_editor.registerBlock('my_poll', function ($, $el, data) {
    var areas = [
        {
            dataKey : 'poll',
            blockName: 'my_input',
            container : '.sp-my_poll-area1'
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
