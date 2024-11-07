<form method="POST" action="/flowers/edit/<?= $flower->id ?>" enctype="multipart/form-data">
    <h2>Edit Flower</h2>

    <!-- Flower Name -->
    <div class="form-group">
        <label for="name">Flower Name:</label>
        <input type="text" name="name" id="name" value="<?= htmlspecialchars($flower->name) ?>" required>
    </div>

    <!-- Flower Price -->
    <div class="form-group">
        <label for="price">Price (€):</label>
        <input type="number" name="price" id="price" value="<?= htmlspecialchars($flower->price) ?>" step="0.01" required>
    </div>

    <!-- Flower Image (Upload) -->
    <div class="form-group">
        <label for="image">Flower Image:</label>
        <input type="file" name="image" id="image">
        <p>Current Image: <img src="/images/<?= htmlspecialchars($flower->image) ?>" alt="<?= htmlspecialchars($flower->name) ?>" width="100"></p>
    </div>

    <!-- Flower Description -->
    <div class="form-group">
        <label for="description">Description:</label>
        <textarea name="description" id="description" rows="4" required><?= htmlspecialchars($flower->description) ?></textarea>
    </div>

    <!-- Update Button -->
    <button type="submit">Update Flower</button>
</form>
