<table>
  <tbody>
    <tr>
      <th>Ip:</th>
      <td><?php echo $computer->getIp() ?></td>
    </tr>
    <tr>
      <th>Mac:</th>
      <td><?php echo $computer->getMac() ?></td>
    </tr>
    <tr>
      <th>Name:</th>
      <td><?php echo $computer->getName() ?></td>
    </tr>
    <tr>
      <td colspan="2"><?php echo button_to('Wake me up!', 'computer/wakeup?id='.$computer->getId())?>
      
        <?php echo button_to('Check remote desktop', 'computer/remote?id='.$computer->getId())?></td>
    </tr>
  </tbody>
</table>
<a href="<?php echo url_for('computer/index') ?>">List</a>
<table>
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