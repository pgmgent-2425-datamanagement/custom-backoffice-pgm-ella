<h1>Files</h1>
<ul>
  <?php foreach ($files as $f): ?>
    <li>
      <a href="<?= $f['url'] ?>" target="_blank"><?= htmlspecialchars($f['name']) ?></a>
      (<?= round($f['size']/1024,1) ?> KB)
    </li>
  <?php endforeach; ?>
</ul>