<? /** @var $block array */?>
<?
$blockText = [];
$blockItems = [];
foreach ($block['blocks'] as $item){
    if($item['name'] == 'my_project_contacts_map'){
        $blockText = $item;
    }else if($item['name'] == 'my_project_contacts_link'){
        $blockItems[] = $item;
    }
}
?>
<div class="projectContacts2">
    <div class="container">
        <div class="projectContacts2__head">
            <p class="index__heading __multiply"><?=str_replace(['<p>','</p>'],"",$blockText['text']['value'])?></p>
            <?if($blockText['htag']['value']){?>
                <<?=$blockText['htag']['type']?> class="projectContacts__title"><?=htmlspecialchars_decode($blockText['htag']['value'])?></<?=$blockText['htag']['type']?>>
            <?}?>
    </div>
    <div class="projectContacts2__wrap">
        <?foreach($blockItems as $item){?>
            <div class="projectContacts2__col">
                <div class="projectContacts2__col-title"><?=$item['text']['value']?></div>
                <div class="projectContacts2__col-link">
                    <?if($item['link']['value']){?>
                        <a href="<?=str_replace(['<p>','</p>'],"",$item['link']['value'])?>" class="hoverMe" data-attr="<?=$item['text_botton']['value']?>">
                            <?=$item['text_botton']['value']?>
                        </a>
                    <?}?>
                </div>
            </div>
        <?}?>
    </div>
	<?php if ($blockText['map']['placemarks']): ?>
        <div class="projectContacts2__map">
            <div id="map"></div>
            <script src="https://api-maps.yandex.ru/2.1/?lang=ru_RU&amp;apikey=2249fce5-710e-4c9e-871f-a00ad21a5307" type="text/javascript"></script>
            <script>
                ymaps.ready(init);

                function init() {
                    var myMap = new ymaps.Map("map", {
                            center: [<?=$blockText['map']['center'][0]?>, <?=$blockText['map']['center'][1]?>],
                            zoom: <?=$blockText['map']['zoom']?>
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
                        .add(new ymaps.Placemark([<?=$blockText['map']['placemarks'][0]['coords'][0]?>, <?=$blockText['map']['placemarks'][0]['coords'][1]?>], {
                            balloonContent: '<?=$blockText['map']['placemarks'][0]['text']?>'
                        }, {
                            preset: 'islands#icon',
                            iconColor: '<?=$blockText['color']['value']?>'
                        }));
                }
            </script>
        </div>
	<?php endif; ?>
</div>
</div>
