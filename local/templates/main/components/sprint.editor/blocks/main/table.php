<? /** @var $block array */ ?>
<table>
    <thead>
        <? foreach ($block['rows'] as $cols){ ?>
            <tr>
                <? foreach ($cols as $col): $col = Sprint\Editor\Blocks\Table::prepareColumn($col); ?>
                    <td <? if ($col['style']): ?>style="<?= $col['style'] ?>"<? endif; ?>
                        <? if ($col['colspan']): ?>colspan="<?= $col['colspan'] ?>"<? endif; ?>
                        <? if ($col['rowspan']): ?>rowspan="<?= $col['rowspan'] ?>"<? endif; ?>
                    ><?= $col['text'] ?></td>
                <? endforeach; ?>
            </tr>
            <?break;?>
        <? } ?>
    </thead>
    <tbody>
        <?$i=0;?>
        <? foreach ($block['rows'] as $cols){ ?>
            <?if($i == 0){
                $i++;
                continue;
            }?>
            <tr>
                <? foreach ($cols as $col): $col = Sprint\Editor\Blocks\Table::prepareColumn($col); ?>
                    <td <? if ($col['style']): ?>style="<?= $col['style'] ?>"<? endif; ?>
                        <? if ($col['colspan']): ?>colspan="<?= $col['colspan'] ?>"<? endif; ?>
                        <? if ($col['rowspan']): ?>rowspan="<?= $col['rowspan'] ?>"<? endif; ?>
                    ><?= $col['text'] ?></td>
                <? endforeach; ?>
            </tr>

        <? } ?>
    </tbody>
</table>
