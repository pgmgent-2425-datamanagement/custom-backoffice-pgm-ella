<?php

namespace App\Controllers;

use App\Models\Profile;

// ProfileController handles listing profiles
class ProfileController extends BaseController {

    // This method retrieves all profiles and loads the profiles view
    public static function list()
    {
        $profiles = self::all(); // NOTE: This seems like it should be Profile::all()

        // Load the view for listing profiles and pass the data
        self::loadView('/profiles', [
            'title' => 'Profiles',   // Title for the page
            'profiles' => $profiles  // Array of profile data
        ]);
    }
}