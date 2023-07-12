sprint_editor.registerBlock('my_terms_htag', function ($, $el, data) {
    var areas = [
        {
            dataKey : 'htag',
            blockName: 'htag',
            container : '.sp-my_terms_htag-area1'
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
