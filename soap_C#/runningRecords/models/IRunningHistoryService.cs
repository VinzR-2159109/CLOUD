using System.ServiceModel;
using runningRecords.Models;

namespace Models;

[ServiceContract]
public interface IRunningHistoryService
{
    [OperationContract]
    List<RunActivity> GetRunningHistory(string userId);

    [OperationContract]
    double CalculateAveragePace(string userId);

    [OperationContract]
    void AddRunningActivity(string userId, double distanceInKm, double timeInMinutes);

    [OperationContract]
    Dictionary<string, double> AddSamples();
}



