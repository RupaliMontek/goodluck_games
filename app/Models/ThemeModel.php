<?php namespace App\Models;

use CodeIgniter\Model;

class ThemeModel extends Model
{
    protected $table = 'theme'; // Your table name
    protected $primaryKey = 'id'; // Your primary key column

    // Define the fields that are allowed to be inserted or updated
    protected $allowedFields = ['id', 'name']; // Adjust these fields based on your actual table structure

    // Optionally, you can define validation rules and messages here
    protected $validationRules    = [];
    protected $validationMessages = [];

    // Method to get the theme
    public function getTheme()
    {
        return $this->first(); // Fetch the first row from the 'theme' table
    }
}
?>
