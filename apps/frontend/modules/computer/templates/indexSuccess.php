<table class="table table-bordered table-striped">
    <thead>
    <tr>
        <th>Name</th>
        <th class="hidden-phone hidden-tablet">Type</th>
        <th>IP</th>
        <th class="hidden-phone hidden-tablet">MAC</th>
        <th colspan="2">Actions</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($computers as $computer): ?>
    <?php /* @var $computer computer */ ?>
    <tr>
        <td>
            <a href="<?php echo url_for('computer/show?id=' . $computer->getId()) ?>"><?php echo $computer->getName() ?></a>
        </td>
        <td class="hidden-phone hidden-tablet"><?php echo $computer->getTypeLabel() ?></td>
        <td><?php echo $computer->getIp() ?></td>
        <td class="hidden-phone hidden-tablet"><?php echo $computer->getMac() ?></td>
        <td><?php echo button_to('Wake me up!', 'computer/wakeup?id=' . $computer->getId(), array('class' => 'btn btn-primary'))?></td>
        <td>
            <?php echo button_to('Check computer', 'computer/remote?id=' . $computer->getId(), array('class' => 'btn'))?>
            <!-- <?php echo button_to('Check ping', 'computer/ping?id=' . $computer->getId())?> -->
        </td>
    </tr>
        <?php endforeach; ?>
    </tbody>
</table>
