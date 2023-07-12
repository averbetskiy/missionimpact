sprint_editor.registerBlock('my_video_block', function ($, $el, data) {
    var areas = [
        {
            dataKey : 'text',
            blockName: 'text',
            container : '.sp-my_video_block-area1'
        },
        {
            dataKey : 'author',
            blockName: 'iblock_elements',
            container : '.sp-my_video_block-area2'
        },
        {
            dataKey : 'univer',
            blockName: 'iblock_elements',
            container : '.sp-my_video_block-area3'
        },
        {
            dataKey : 'image',
            blockName: 'image',
            container : '.sp-my_video_block-area4'
        },
        {
            dataKey : 'video',
            blockName: 'video',
            container : '.sp-my_video_block-area5'
        },
        {
            dataKey : 'video_files',
            blockName: 'files',
            container : '.sp-my_video_block-area6'
        },
        {
            dataKey : 'time',
            blockName: 'my_input',
            container : '.sp-my_video_block-area7'
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
