<h1>Add Flower</h1>
<form method="post" enctype="multipart/form-data">
  <label>Name <input name="name" required></label>
  <label>Description <input name="description" required></label>
  <label>Price <input name="price" type="number" step="0.01" required></label>
  <label>Image <input type="file" name="image" accept="image/*"></label>
  <button type="submit">Save</button>
</form>