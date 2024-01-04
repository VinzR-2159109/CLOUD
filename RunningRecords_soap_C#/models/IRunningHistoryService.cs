using System.ServiceModel;
using runningRecords.Models;

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
}



