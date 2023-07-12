<? /** @var $block array */?>
<div class="projectContacts">
    <div class="container">
        <div class="projectContacts__wrap">
            <div class="projectContacts__content">
                <div class="projectContacts__top">
                    <p class="index__heading __multiply"><?=str_replace(['<p>','</p>'],"",$block['text']['value'])?></p>
                    <?if($block['htag']['value']){?>
                        <<?=$block['htag']['type']?> class="projectContacts__title"><?=htmlspecialchars_decode($block['htag']['value'])?></<?=$block['htag']['type']?>>
                    <?}?>
                    <div class="projectContacts__text">
                        <?=$block['desc']['value']?>
                    </div>
                </div>
                <?if($block['link']['value']){?>
                    <a href="<?=str_replace(['<p>','</p>'],"",$block['link']['value'])?>" class="projectContacts__show hoverMe"
                       data-attr="<?=str_replace(['<p>','</p>'],"",$block['text_button']['value'])?>">
                        <?=$block['text_button']['value']?>
                    </a>
                <?}?>
            </div>
            <?if($block['map']['placemarks']){?>
                <div class="projectContacts__map" id="map"></div>
                <script src="https://api-maps.yandex.ru/2.1/?lang=ru_RU&amp;apikey=2249fce5-710e-4c9e-871f-a00ad21a5307" type="text/javascript"></script>
                <script>
                    ymaps.ready(init);

                    function init() {
                        var myMap = new ymaps.Map("map", {
                                center: [<?=$block['map']['center'][0]?>, <?=$block['map']['center'][1]?>],
                                zoom: <?=$block['map']['zoom']?>
                            }, {
                                searchControlProvider: 'yandex#search'
                            }),

                            // Создаем геообъект с типом геометрии "Точка".
                            myGeoObject = new ymaps.GeoObject({
                                // Описание геометрии.
                                geometry: {
                                    type: "Point",
                                    coordinates: [<?=0?>, <?=0?>]
                                }
                            }, {
                                // Опции.
                                // Иконка метки будет растягиваться под размер ее содержимого.
                                preset: 'islands#blackStretchyIcon',
                                // Метку можно перемещать.
                                draggable: true
                            });

                        myMap.geoObjects
                            .add(myGeoObject)
                            .add(new ymaps.Placemark([<?=$block['map']['placemarks'][0]['coords'][0]?>, <?=$block['map']['placemarks'][0]['coords'][1]?>], {
                                balloonContent: '<?=$block['map']['placemarks'][0]['text']?>'
                            }, {
                                preset: 'islands#icon',
                                iconColor: '<?=$block['color']['value']?>'
                            }));
                    }
                </script>
            <?}?>
        </div>
    </div>
</div>