<?php 
namespace App\Controllers;

use App\Models\MaintenanceModel;
use CodeIgniter\Controller;
use CodeIgniter\HTTP\ResponseInterface;

class MaintenanceController extends Controller
{
    public function __construct()
    {
        $this->session = \Config\Services::session();
     //   date_default_timezone_set('Asia/Kolkata');
    }
    public function index() 
    {
        echo view('templates/header');
        echo view('templates/sidebar');
        echo view('super_admin/maintenance_page');
        echo view('templates/footer');
    }
    public function maintenanceControl() 
    {
        $maintenanceModel = new MaintenanceModel();
        $isMaintenanceEnabled = $maintenanceModel->isMaintenanceEnabled(); 
        echo view('templates/header');
        echo view('templates/sidebar');
        echo view('maintenance_control', ['is_maintenance_enabled' => $isMaintenanceEnabled]);
        echo view('templates/footer');
        
        
    }

    public function toggleMaintenance()
{
    $enabled = filter_var($this->request->getPost('enabled'), FILTER_VALIDATE_BOOLEAN); // Convert to boolean
    $maintenanceModel = new MaintenanceModel();
    $maintenanceModel->setMaintenanceMode($enabled); // Update maintenance mode status

    return $this->response->setJSON(['status' => 'success', 'enabled' => $enabled]);
}

}
?>