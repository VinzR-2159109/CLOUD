<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use RicorocksDigitalAgency\Soap\Facades\Soap;

class RunningHistoryController extends Controller
{
    public function index()
    {     
        return view('runningHistory/runningHistoryForm');
    }

    public function getRunningHistory(Request $request)
    {
        $userId = $request->input('userId');

        $distances = $this->getAllDistances($userId);
        $durations = $this->getAllDurations($userId);
        $paces = $this->getAllPaces($userId);
        $calories = $this->getAllCaloriesBurned($userId);

        return view('runningHistory.runningHistoryResponse', [
            'distances' => $distances,
            'durations' => $durations,
            'paces' => $paces,
            'calories' => $calories,
            'averagePace' => null,
        ]);
    }
    
    private function getAllDistances($userId)
    {
        $soapClient = Soap::to('http://localhost:5252/Service.asmx');
        return $soapClient->GetAllDistances(['userId' => $userId])->response->GetAllDistancesResult;
    }

    private function getAllDurations($userId)
    {
        $soapClient = Soap::to('http://localhost:5252/Service.asmx');
        return $soapClient->GetAllDurations(['userId' => $userId])->response->GetAllDurationsResult;
    }

    private function getAllPaces($userId)
    {
        $soapClient = Soap::to('http://localhost:5252/Service.asmx');
        return $soapClient->GetAllPaces(['userId' => $userId])->response->GetAllPacesResult;
    }   

    private function getAllCaloriesBurned($userId)
    {
        $soapClient = Soap::to('http://localhost:5252/Service.asmx');
        return $soapClient->GetAllCaloriesBurned(['userId' => $userId])->response->GetAllCaloriesBurnedResult;
    }

    public function calculateAveragePace(Request $request)
    {
        $userId = $request->input('userId');
        $soapClient = Soap::to('http://localhost:5252/Service.asmx');
        $averagePace = $soapClient->CalculateAveragePace(['userId' => $userId]);

        return view('runningHistory.runningHistoryResponse', [
            'distances' => null,
            'durations' => null,
            'paces' => null,
            'calories' => null,
            'averagePace' => $averagePace->response->CalculateAveragePaceResult,
        ]);
    }

    public function addRunningActivity(Request $request)
    {
        $userId = $request->input('userId');
        $distance = $request->input('distance');
        $time = $request->input('time');

        $soapClient = Soap::to('http://localhost:5252/Service.asmx');
        $soapClient->AddRunningActivity(['userId' => $userId, 'distanceInKm' => $distance, 'timeInMinutes' => $time]);

        return view('runningHistory.runningHistoryResponse', [
            'distances' => null,
            'durations' => null,
            'paces' => null,
            'calories' => null,
            'averagePace' => null,
            'successMessage' => 'Running activity added successfully!',
        ]);
    }
}