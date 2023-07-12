sprint_editor.registerBlock('my_translation', function ($, $el, data) {
    var areas = [
        {
            dataKey : 'text',
            blockName: 'text',
            container : '.sp-my_translation-area1'
        },
        {
            dataKey : 'desc',
            blockName: 'text',
            container : '.sp-my_translation-area2'
        },
        {
            dataKey : 'image',
            blockName: 'image',
            container : '.sp-my_translation-area3'
        },
        {
            dataKey : 'imageMobile',
            blockName: 'image',
            container : '.sp-my_translation-area7'
        },
        {
            dataKey : 'video',
            blockName: 'video',
            container : '.sp-my_main_hero_text-area5'
        },
        {
            dataKey : 'video_files',
            blockName: 'files',
            container : '.sp-my_main_hero_text-area6'
        },
        {
            dataKey : 'text_external',
            blockName: 'my_input',
            container : '.sp-my_main_hero_text-area8'
        },
        {
            dataKey : 'iframeVideo',
            blockName: 'text',
            container : '.sp-my_translation-area9'
        },
        {
            dataKey : 'text_internal',
            blockName: 'my_input',
            container : '.sp-my_main_hero_text-area10'
        },
        {
            dataKey : 'anchor',
            blockName: 'my_input',
            container : '.sp-my_main_hero_text-area11'
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
