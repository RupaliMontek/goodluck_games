<?php
// app/Models/MaintenanceModel.php
namespace App\Models;

use CodeIgniter\Model;

class MaintenanceModel extends Model
{
    protected $table = 'maintenance';
    protected $primaryKey = 'id';
    protected $allowedFields = ['enabled'];

    public function isMaintenanceEnabled()
    {
        $result = $this->find(1);
        return $result ? $result['enabled'] : false;
    }

    public function setMaintenanceMode(bool $enabled)
{
    $status = $enabled ? 1 : 0;

    try {
        // Update maintenance mode status in the database
        $this->update(1, ['enabled' => $status]); 
    } catch (\Exception $e) {
        // Log the error with specific details
        log_message('error', 'Error updating maintenance mode: ' . $e->getMessage());
        throw $e; // Rethrow if needed
    }
}


}

?>