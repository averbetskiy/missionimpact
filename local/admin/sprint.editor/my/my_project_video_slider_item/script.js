sprint_editor.registerBlock('my_project_video_slider_item', function ($, $el, data) {
    var areas = [
        {
            dataKey : 'image',
            blockName: 'image',
            container : '.sp-my_project_video_slider_item-area1'
        },
        {
            dataKey : 'video',
            blockName: 'video',
            container : '.sp-my_project_video_slider_item-area2'
        },
        {
            dataKey : 'video_files',
            blockName: 'files',
            container : '.sp-my_project_video_slider_item-area3'
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
