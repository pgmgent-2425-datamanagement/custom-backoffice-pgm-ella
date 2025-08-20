<div class="container">
    <h1>{{ title }}</h1>
    <p>Welcome to your profile page!</p>

    <div class="profile-info">
        <h2>Your Information</h2>
        <ul>
            <li><strong>First Name:</strong> {{ profile.first_name }}</li> <!-- 'profile' holds the user's data from the backend -->
            <li><strong>Last Name:</strong> {{ profile.last_name }}</li>
            <li><strong>Email:</strong> {{ profile.email }}</li>
            <li><strong>Address:</strong> {{ profile.address }}</li>
            <li><strong>City:</strong> {{ profile.city }}</li>
            <li><strong>State:</strong> {{ profile.state }}</li>
            <li><strong>Zip Code:</strong> {{ profile.zip_code }}</li>
        </ul>
    </div>

    <div class="actions">
        <a href="/profile/edit" class="btn btn-primary">Edit Profile</a>
    </div>