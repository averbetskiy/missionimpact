sprint_editor.registerBlock('my_main_hero_text', function ($, $el, data) {
    var areas = [
        {
            dataKey : 'text',
            blockName: 'my_input',
            container : '.sp-my_main_hero_text-area1'
        },
        {
            dataKey : 'text_mob',
            blockName: 'my_input',
            container : '.sp-my_main_hero_text-area2'
        },
        {
            dataKey : 'image',
            blockName: 'image',
            container : '.sp-my_main_hero_text-area3'
        },
        {
            dataKey : 'imageMobile',
            blockName: 'image',
            container : '.sp-my_main_hero_text-area7'
        },
        {
            dataKey : 'event',
            blockName: 'iblock_elements',
            container : '.sp-my_main_hero_text-area4'
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
            container : '.sp-my_main_hero_text-area9'
        },
        {
            dataKey : 'text_internal',
            blockName: 'my_input',
            container : '.sp-my_main_hero_text-area10'
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
