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
        $averagePace = $this->calculateAveragePace($userId);
        
        //Bron: https://stackoverflow.com/questions/18576762/php-stdclass-to-array
        $distancesArray = json_decode(json_encode($distances), true);
        $durationsArray = json_decode(json_encode($durations), true);
        $pacesArray = json_decode(json_encode($paces), true);
        $caloriesArray = json_decode(json_encode($calories), true);

        if (isset($distancesArray['double'])) {

            $totalDistance = array_sum($distancesArray['double']);
            $totalDuration = array_sum($durationsArray['double']);
            $totalCalories = array_sum($caloriesArray['int']);

            return view('runningHistory.runningHistoryResponse', [
                'distances' => $distancesArray['double'],
                'durations' => $durationsArray['double'],
                'paces' => $pacesArray['double'],
                'calories' => $caloriesArray['int'],
                'averagePace' => $averagePace,
                'totalDistance' => $totalDistance,
                'totalDuration' => $totalDuration,
                'totalCalories' => $totalCalories,
            ]);

        } else {
            print("No data found for this user.");
        }
    }

    public function addRunningActivity(Request $request)
    {
        $userId = $request->input('userId');
        $distance = $request->input('distance');
        $time = $request->input('time');

        $soapClient = Soap::to('http://localhost:5252/Service.asmx');
        $soapClient->AddRunningActivity(['userId' => $userId, 'distanceInKm' => $distance, 'timeInMinutes' => $time]);

        return view('runningHistory.runningHistoryAddActivitySuccessful', ['userID' => $userId]);
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

    public function calculateAveragePace($userId)
    {
        $soapClient = Soap::to('http://localhost:5252/Service.asmx');
        return $soapClient->CalculateAveragePace(['userId' => $userId])->response->CalculateAveragePaceResult;
    }
}