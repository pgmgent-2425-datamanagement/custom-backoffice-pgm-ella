<?php

// app/Controllers/FileManagerController.php
namespace App\Controllers;

// FileManagerController handles browsing, adding, and deleting files in the uploads folder.
class FileManagerController extends BaseController 
{

    // Displays the files in a given folder (or root folder if none specified)
    public static function index($folder = '') {
        // scandir() retrieves all files and directories inside the specified folder.
        $files = scandir(BASE_DIR . '/public/uploads/' . $folder);

        // Loads the filemanager view, providing the list of files and current folder path.
        self::loadView('/filemanager/index', [
            'title' => 'Filemanager',
            'files' => $files,
            'currentPath' => $folder
        ]);
    }

    // Handles uploading a new file to a given folder
    public static function add($folder = '') {
        // Checks if a file was submitted via the form and if there were no upload errors.
        if (isset($_FILES['file_path']) && $_FILES['file_path']['error'] == 0) {
            // Determines the destination folder on the server.
            $uploads_dir = BASE_DIR . '/public/uploads/' . $folder;
            // Creates a unique filename to avoid overwriting existing files.
            $file_name = uniqid() . '_' . basename($_FILES['file_path']['name']);
            $file_path = $uploads_dir . '/' . $file_name;

            // Moves the uploaded temporary file to the uploads folder.
            if (move_uploaded_file($_FILES['file_path']['tmp_name'], $file_path)) {
                // Redirects back to the filemanager view for the current folder.
                header('Location: /filemanager/' . $folder);
                exit;
            } else {
                die('Failed to upload the file.');
            }
        }

        // Loads the view to display the file upload form.
        self::loadView('/filemanager/add', [
            'title' => 'Add File',
            'currentPath' => $folder
        ]);
    }

    // Handles deleting a file from the server
    public static function delete($path) {
        // Constructs the full path of the file to delete.
        $fullPath = BASE_DIR . '/public/uploads/' . $path;
        if (file_exists($fullPath)) {
            // Deletes the file if it exists.
            unlink($fullPath);
        } else {
            die('File not found.');
        }

        // After deletion, redirects back to the folder view in filemanager.
        $folder = dirname($path);  // Extracts the folder path from the full file path.
        header('Location: /filemanager/' . $folder);
        exit;
    }
}