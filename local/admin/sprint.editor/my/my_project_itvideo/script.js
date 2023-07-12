sprint_editor.registerBlock('my_project_itvideo', function ($, $el, data) {
    var areas = [
        {
            dataKey : 'poster',
            blockName: 'files',
            container : '.sp-my_project_itvideo-area1'
        },
        {
            dataKey : 'video',
            blockName: 'video',
            container : '.sp-my_project_itvideo-area2'
        },
        {
            dataKey : 'video_files',
            blockName: 'files',
            container : '.sp-my_project_itvideo-area3'
        },
        {
            dataKey : 'text1',
            blockName: 'text',
            container : '.sp-my_project_itvideo-area4'
        },
        {
            dataKey : 'text2',
            blockName: 'text',
            container : '.sp-my_project_itvideo-area5'
        },
        {
            dataKey : 'text3',
            blockName: 'text',
            container : '.sp-my_project_itvideo-area6'
        },
        {
            dataKey : 'report',
            blockName: 'files',
            container : '.sp-my_project_itvideo-area7'
        },
        {
            dataKey : 'text_report',
            blockName: 'text',
            container : '.sp-my_project_itvideo-area8'
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
