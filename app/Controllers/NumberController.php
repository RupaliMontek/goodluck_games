<?php

namespace App\Controllers;

use App\Models\NumbersModel;
use CodeIgniter\Controller;

class NumberController extends Controller
{
    public function index()
    {
        $numbersModel = new NumbersModel();
        $excludedNumbers = $numbersModel->getExcludedNumbers();

        $randomNumbers = $this->generateRandomNumbers($excludedNumbers);
    }

    private function generateRandomNumbers($excludedNumbers)
    {
        $minNumber = 0;
        $maxNumber = 9;

        do {
            $randomNumber = rand($minNumber, $maxNumber);
        } while (in_array($randomNumber, $excludedNumbers));

        return $randomNumber;
    }
}
