# Running History SOAP Service Documentation

## Overview

The Running History SOAP Service provides functionality to retrieve and manage running activities for users. It exposes various methods to retrieve distances, durations, paces, and calories burned for running activities, calculate average pace, add new running activities, and add sample data for testing purposes.

## Service Contract

### IRunningHistoryService Interface

```csharp
namespace Models;

[ServiceContract]
public interface IRunningHistoryService
{
    [OperationContract]
    List<double> GetAllDistances(string userId);

    [OperationContract]
    List<double> GetAllDurations(string userId);

    [OperationContract]
    List<double> GetAllPaces(string userId);

    [OperationContract] 
    List<int> GetAllCaloriesBurned(string userId);
    
    [OperationContract]
    double CalculateAveragePace(string userId);

    [OperationContract]
    void AddRunningActivity(string userId, double distanceInKm, double timeInMinutes);

    [OperationContract]
    void AddSamples();
}
