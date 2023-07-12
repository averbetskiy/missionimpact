let ajaxUrl = '/ajax.php';

$.extend({
    getUrlVars: function () {
        var vars = [], hash;
        var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
        for (var i = 0; i < hashes.length; i++) {
            hash = hashes[i].split('=');
            vars.push(hash[0]);
            vars[hash[0]] = hash[1];
        }
        return vars;
    }
});

$(document).ready(function () {

    /**
    * Подмена ссылки кнопки Посмотреть в адм. части. Ссылка на элемент в зависимости от версии сайта.
    **/
    if ($('*').is('#asd_iblock_show_element')) {
        let data = $.getUrlVars();
        $.ajax({
            method: 'post',
            url: ajaxUrl,
            data: {
                'ID' : data.ID,
                'action' : 'getUrlById',
            },
            dataType: 'json',
        }).done(function (result) {
            $('#asd_iblock_show_element').attr('href',result);
        });
    }

});
