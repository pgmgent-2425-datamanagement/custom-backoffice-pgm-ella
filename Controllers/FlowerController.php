<?php

namespace App\Controllers;

use App\Models\Flower;

class FlowerController extends BaseController
{

    public static function list()
    {
        $flowers = Flower::all();

        self::loadView('/flowers/index', [
            'title' => 'Flowers',
            'flowers' => $flowers
        ]);
    }

    // public static function edit
    public static function edit(int $id)
    {
        $flower = Flower::find($id);

        // Check if the form is submitted
        if (isset($_POST['name']) && isset($_POST['price']) && isset($_POST['description'])) {
            // Get the form data
            $name = $_POST['name'];
            $price = $_POST['price'];
            $description = $_POST['description'];

            // Handle file upload for the image
            if (!empty($_FILES['image']['name'])) {
                // Handle image upload (move to the correct folder)
                $imagePath = 'images/' . basename($_FILES['image']['name']);
                move_uploaded_file($_FILES['image']['tmp_name'], $imagePath);
            } else {
                // Keep the current image if no new image is uploaded
                $imagePath = $flower->image;
            }

            // Update the flower data
            $flower->name = $name;
            $flower->price = $price;
            $flower->description = $description;
            $flower->image = $imagePath;

            // Save the updated flower back to the database
            $flower->save();

            // Redirect to the flower's detail page after updating
            header("Location: /flowers");
            exit;
        }

        self::loadView('/flowers/edit', [
            'title' => 'Edit Flower',
            'flower' => $flower
        ]);
    }

    // public static function add

    public static function add() {

        // Check if the form is submitted (POST request)
        if (isset($_POST['name']) && isset($_POST['price']) && isset($_POST['description'])) {
            // Get the form data
            $name = $_POST['name'];
            $price = $_POST['price'];
            $description = $_POST['description'];
    
            // Handle image upload
            if (!empty($_FILES['image']['name'])) {
                // Handle image upload (move to the images folder)
                $imagePath = 'images/' . uniqid() . '_' . basename($_FILES['image']['name']);
                move_uploaded_file($_FILES['image']['tmp_name'], $imagePath);
            } else {
                $imagePath = '';
            }
    
            // Create a new flower object and save it to the database
            $flower = new Flower();
            $flower->name = $name;
            $flower->price = $price;
            $flower->description = $description;
            $flower->image = $imagePath;
    
            if ($flower->add()) {
                // Redirect to the flowers list or to the newly added flower's view page
                header("Location: /flowers");
                exit;
            }
        }

        self::loadView('/flowers/add', [
            'title' => 'Add Flower'
        ]);
    }

    // public static function delete
    public static function delete(int $id)
    {
        $flower = Flower::find($id);

        // Delete the flower from the database
        $flower->delete();

        // Redirect to the flowers list after deleting
        header("Location: /flowers");
        exit;
    }
}
