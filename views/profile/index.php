<div class="profile-page">
    <h1>My Profile</h1>
    <p class="intro-text">Manage your personal details and account settings below.</p>

    <div class="profile-container">
        <div class="profile-photo">
            <?php if (!empty($user['photo'])): ?>
                <img src="/uploads/<?= htmlspecialchars($user['photo']) ?>" alt="Profile Picture">
            <?php else: ?>
                <img src="/images/default-profile.png" alt="Default Profile Picture">
            <?php endif; ?>
        </div>

        <form action="/profile/update" method="POST" enctype="multipart/form-data" class="profile-form">
            <div class="form-group">
                <label for="name">Full Name</label>
                <input type="text" id="name" name="name" value="<?= htmlspecialchars($user['name'] ?? '') ?>" required>
            </div>

            <div class="form-group">
                <label for="email">Email Address</label>
                <input type="email" id="email" name="email" value="<?= htmlspecialchars($user['email'] ?? '') ?>" required>
            </div>

            <div class="form-group">
                <label for="role">Role</label>
                <select id="role" name="role_id" required>
                    <?php foreach ($roles as $role): ?>
                        <option value="<?= $role['id'] ?>" <?= ($user['role_id'] ?? '') == $role['id'] ? 'selected' : '' ?>>
                            <?= htmlspecialchars($role['name']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group">
                <label for="photo">Profile Picture</label>
                <input type="file" id="photo" name="photo" accept="image/*">
                <small>Upload a JPG, PNG, or GIF (max 2MB)</small>
            </div>

            <button type="submit" class="btn-save">Save Changes</button>
        </form>
    </div>
</div>

<style>
    .profile-page {
        max-width: 700px;
        margin: 0 auto;
        padding: 2rem;
    }
    .intro-text {
        margin-bottom: 2rem;
        color: #555;
    }
    .profile-container {
        background: #fff;
        padding: 1.5rem;
        border-radius: 12px;
        box-shadow: 0 4px 10px rgba(0,0,0,0.05);
    }
    .profile-photo {
        text-align: center;
        margin-bottom: 1.5rem;
    }
    .profile-photo img {
        width: 120px;
        height: 120px;
        border-radius: 50%;
        object-fit: cover;
        border: 3px solid #ddd;
    }
    .profile-form .form-group {
        margin-bottom: 1rem;
    }
    .profile-form label {
        display: block;
        margin-bottom: 0.3rem;
        font-weight: bold;
    }
    .profile-form input, .profile-form select {
        width: 100%;
        padding: 0.5rem;
        border-radius: 6px;
        border: 1px solid #ccc;
    }
    .btn-save {
        display: block;
        background: #4ecdc4;
        color: #fff;
        padding: 0.7rem 1.2rem;
        border: none;
        border-radius: 6px;
        cursor: pointer;
        font-size: 1rem;
        margin-top: 1rem;
    }
    .btn-save:hover {
        background: #3bb9ad;
    }
</style>