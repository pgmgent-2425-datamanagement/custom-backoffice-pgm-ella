<?php

namespace App\Controllers;

use Profile;

class ProfileController extends BaseController {

    public static function list() {
        session_start();

        if (!isset($_SESSION['user_id'])) {
            self::redirect('/login');
        }

        $profileModel = new Profile();
        $user = $profileModel->find($_SESSION['user_id']); // get profile by user_id

        self::loadView('/profile/index', [
            'title' => 'Profile',
            'user' => $user
        ]);
    }
}