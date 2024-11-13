<?php
namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;
use App\Models\MaintenanceModel;

class MaintenanceFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $maintenanceModel = new MaintenanceModel();

        if ($maintenanceModel->isMaintenanceEnabled()) {
            return redirect()->to('/maintenance'); // Redirect to the maintenance page if enabled
        }

        return null; // Continue with the request
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // No post-processing needed
    }
}
?>