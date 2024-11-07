<form method="POST" enctype="multipart/form-data">
    <h2>Add Flower</h2>

    <!-- Flower Name -->
    <div class="form-group">
        <label for="name">Flower Name:</label>
        <input type="text" name="name" id="name" required>
    </div>

    <!-- Flower Price -->
    <div class="form-group">
        <label for="price">Price (€):</label>
        <input type="number" name="price" id="price" step="0.01" required>
    </div>

    <!-- Flower Image (Upload) -->
    <div class="form-group">
        <label for="image">Flower Image:</label>
        <input type="file" name="image" id="image" required>
    </div>

    <!-- Flower Description -->
    <div class="form-group">
        <label for="description">Description:</label>
        <textarea name="description" id="description" rows="4" required></textarea>
    </div>

    <!-- Add Button -->
    <button type="submit">Add Flower</button>
</form>
