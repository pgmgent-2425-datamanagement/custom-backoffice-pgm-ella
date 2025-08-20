<h1 class="title">Flowers</h1>

<form method="get" class="mb">
  <input name="q" value="<?= htmlspecialchars($q ?? '') ?>" placeholder="Search name...">
  <button type="submit">Search</button>
</form>

<p><a href="/flowers/add">+ Add Flower</a></p>

<table>
  <thead>
    <tr>
      <th><a href="?sort=id">ID</a></th>
      <th><a href="?sort=name">Name</a></th>
      <th><a href="?sort=price">Price</a></th>
      <th>Image</th>
      <th></th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($flowers as $f): ?>
      <tr>
        <td><?= $f['id'] ?></td>
        <td><?= htmlspecialchars($f['name']) ?></td>
        <td>€ <?= number_format($f['price'],2) ?></td>
        <td><img src="/<?= htmlspecialchars($f['image']) ?>" alt="" width="60"></td>
        <td>
          <a href="/flowers/edit/<?= $f['id'] ?>">Edit</a>
          <a href="/flowers/delete/<?= $f['id'] ?>" onclick="return confirm('Delete?')">Delete</a>
        </td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>