<?php

namespace App\Controllers;

use App\Models\Flower;

class FlowerController extends BaseController
{

    // This method retrieves all flowers from the database and loads the main flowers view
    public static function list()
    {
        $flowers = Flower::all(); // Get all Flower records from the database

        // Load the view for listing flowers and pass the data to it
        self::loadView('/flowers/index', [
            'title' => 'Flowers',  // Title of the page
            'flowers' => $flowers  // Array of flower data
        ]);
    }

    // This method handles both displaying the edit form and updating a flower
    public static function edit(int $id)
    {
        $flower = Flower::find($id); // Find a specific flower by ID

        // Check if the edit form has been submitted
        if (isset($_POST['name']) && isset($_POST['price']) && isset($_POST['description'])) {
            // Collect submitted form data
            $name = $_POST['name'];
            $price = $_POST['price'];
            $description = $_POST['description'];

            // Handle optional image upload
            if (!empty($_FILES['image']['name'])) {
                // Move the uploaded image to the 'images/' folder
                $imagePath = 'images/' . basename($_FILES['image']['name']);
                move_uploaded_file($_FILES['image']['tmp_name'], $imagePath);
            } else {
                // Keep existing image if no new image is uploaded
                $imagePath = $flower->image;
            }

            // Update flower properties with new data
            $flower->name = $name;
            $flower->price = $price;
            $flower->description = $description;
            $flower->image = $imagePath;

            // Save the updated flower back to the database
            $flower->save();

            // Redirect back to the flowers list page after updating
            header("Location: /flowers");
            exit;
        }

        // If the form isn't submitted, just load the edit form view
        self::loadView('/flowers/edit', [
            'title' => 'Edit Flower',
            'flower' => $flower
        ]);
    }

    // This method handles adding a new flower
    public static function add() {

        // Check if the form has been submitted
        if (isset($_POST['name']) && isset($_POST['price']) && isset($_POST['description'])) {
            $name = $_POST['name'];
            $price = $_POST['price'];
            $description = $_POST['description'];
    
            // Handle image upload for the new flower
            if (!empty($_FILES['image']['name'])) {
                // Save the uploaded image with a unique filename
                $imagePath = 'images/' . uniqid() . '_' . basename($_FILES['image']['name']);
                move_uploaded_file($_FILES['image']['tmp_name'], $imagePath);
            } else {
                $imagePath = '';
            }
    
            // Create a new Flower object and assign properties
            $flower = new Flower();
            $flower->name = $name;
            $flower->price = $price;
            $flower->description = $description;
            $flower->image = $imagePath;
    
            // Save the new flower to the database
            if ($flower->add()) {
                // Redirect to the flowers list after successful addition
                header("Location: /flowers");
                exit;
            }
        }

        // Load the view to display the add flower form
        self::loadView('/flowers/add', [
            'title' => 'Add Flower'
        ]);
    }

    // This method deletes a flower from the database
    public static function delete(int $id)
    {
        $flower = Flower::find($id); // Find the flower by ID

        // Delete the flower record
        $flower->delete();

        // Redirect back to the flowers list after deletion
        header("Location: /flowers");
        exit;
    }
}