<?php

namespace App\Models; // Define the namespace for the model, organizing it under App\Models

#[\AllowDynamicProperties] // PHP 8.2 attribute to allow dynamic properties on this class

class BaseModel {

    protected $table; // The database table name associated with this model
    protected $pk;    // The primary key column for the table
    protected $db;    // PDO database connection object

    public static function __callStatic ($method, $arg) {
        $obj = new static; // Create a new instance of the called class
        $result = call_user_func_array(array($obj, $method), $arg); // Call the method on the instance with arguments
        if (method_exists($obj, $method))
            return $result; // Return result if the method exists
        return $obj; // Otherwise return the model instance itself
    }

    public function __construct() {

        if(!isset($this->table)) { // If table name is not defined
            $single = strtolower($this->getClassName(get_called_class())); // Get class name in lowercase
            switch(substr($single, -1)) {
                case 'y':
                    // If class ends with 'y', e.g., Category -> categories
                    $this->table = substr($single, 0, -1) . 'ies';
                    break;
                case 's':
                    // If class ends with 's', e.g., News -> news
                    $this->table = $single;
                    break;
                default:
                    // Otherwise, append 's', e.g., User -> users
                    $this->table .= $single . 's';
            }
        }

        if(!isset($this->pk)) {
            $this->pk = 'id'; // Default primary key is 'id'
        }

        if(!isset($this->db)) {
            global $db; // Use the global PDO connection if not set
            $this->db = $db;
        }
    }

    private function all () {
        $sql = 'SELECT * FROM `' . $this->table . '`'; // Prepare SQL to select all rows
        $pdo_statement = $this->db->prepare($sql);
        $pdo_statement->execute(); // Execute the query
        $db_items = $pdo_statement->fetchAll(); // Fetch all results
        return self::castToModel($db_items); // Convert raw data to model instances
    }

    public function find (int $id) {
        $sql = 'SELECT * FROM `' . $this->table . '` WHERE `' . $this->pk . '` = :p_id'; // SQL for one record
        $pdo_statement = $this->db->prepare($sql);
        $pdo_statement->execute([':p_id' => $id]);
        $db_item = $pdo_statement->fetchObject(); // Fetch single object
        return self::castToModel($db_item); // Cast to model
    }

    protected function castToModel($object) {
        if(!is_object($object) && isset($object[0]) && is_array($object[0])) {
            // If it's an array of items, loop through each
            $items = [];
            foreach($object as $db_item) {
                $items[] = $this->castToModel($db_item);
            }
            return $items;
        }
        $db_item = (object) $object; // Convert array to object if necessary
        $model_name = get_class($this); // Get the class name of the current model
        $item = new $model_name(); // Instantiate the model
        foreach($db_item as $column => $value) {
            $item->{$column} = $value; // Populate model properties
        } 
        return $item;
    }

    private function deleteById (int $id) {
        $sql = 'DELETE FROM `' . $this->table . '` WHERE `' . $id . '` = :p_id'; // SQL to delete
        $pdo_statement = $this->db->prepare($sql);
        return $pdo_statement->execute([':p_id' => $id]);
    }

    public function delete () {
        $this->deleteById($this->pk); // Delete the current object by primary key
    }

    private function getClassName($classname) {
        return (substr($classname, strrpos($classname, '\\') + 1)); // Extract class name without namespace
    }
}