<?php /* @var $computer computer */ ?>
<table class="table">
    <tbody>
    <tr>
        <th>IP:</th>
        <td><?php echo $computer->getIp() ?></td>
    </tr>
    <tr>
        <th>MAC:</th>
        <td><?php echo $computer->getMac() ?></td>
    </tr>
    <tr>
        <th>Name:</th>
        <td><?php echo $computer->getName() ?></td>
    </tr>
    <tr>
        <th>Type:</th>
        <td><?php echo $computer->getTypeLabel();?></td>
    </tr>
    <tr>
        <td colspan="2">
            <?php echo button_to('Wake me up!', 'computer/wakeup?id=' . $computer->getId(), array('class' => 'btn btn-primary'))?>
            <?php echo button_to('Check remote desktop', 'computer/remote?id=' . $computer->getId(), array('class' => 'btn'))?>
            <?php echo button_to('Edit', 'computer/edit?id=' . $computer->getId(), array('class' => 'btn'))?>
        </td>
    </tr>
    </tbody>
</table>
<table class="table">
    <thead>
    <td>Date/Time</td>
    <td>User</td>
    </thead>
    <?php foreach ($logs as $log): ?>
    <tr>
        <td><?php echo $log->getCreatedAt();?></td>
        <td><?php echo $log->getUsername();?></td>
    </tr>
    <?php endforeach; ?>
</table>