using System;
using Models;
using Newtonsoft.Json;
namespace runningRecords.Models;

public class RunningHistoryService : IRunningHistoryService
{
    private static Dictionary<string, List<RunActivity>> userRunActivities = new();

    public double CalculateAveragePace(string userId)
    {
        if (userRunActivities.ContainsKey(userId) && userRunActivities[userId].Count > 0)
        {
            var totalPace = userRunActivities[userId].Select(activity => activity.Pace).Sum();
            return Math.Round(totalPace / userRunActivities[userId].Count, 2);
        }

        return -1;
    }

    public void AddRunningActivity(string userId, double distanceInKm, double timeInMinutes)
    {
        if (!userRunActivities.ContainsKey(userId))
        {
            userRunActivities[userId] = new List<RunActivity>();
        }

        var pace = distanceInKm > 0 ? Math.Round(timeInMinutes / distanceInKm, 2) : 0;   
        var activity = new RunActivity
        {
            DistanceInKm = distanceInKm,
            Duration = timeInMinutes,
            Pace = pace,
            CaloriesBurned = CalculateCaloriesBurned(timeInMinutes)
        };

        userRunActivities[userId].Add(activity);
    }   

    private int CalculateCaloriesBurned(double timeInMinutes)
    {
        const int MET = 7;
        double weightKg = 76;

        double timeInHours = timeInMinutes / 60.0;
        double caloriesBurned = MET * weightKg * timeInHours;

        return (int)caloriesBurned;
    }
   
 
   /* Dit wilt maar niet werken => oplossing: alles met Primitive data types doen
    public string GetActivities(string userId)
    {
        if (userRunActivities.ContainsKey(userId))
        {
            return JsonConvert.SerializeObject(userRunActivities[userId]);
        }
    
        return "[]";
    }
    */

    public List<double> GetAllDistances(string userId)
    {
        if (userRunActivities.ContainsKey(userId))
        {
            return userRunActivities[userId].Select(activity => activity.DistanceInKm).ToList();
        }

        return new List<double>();
    }

    public List<double> GetAllDurations(string userId)
    {
        if (userRunActivities.ContainsKey(userId))
        {
            return userRunActivities[userId].Select(activity => activity.Duration).ToList();
        }

        return new List<double>();
    }

    public List<double> GetAllPaces(string userId)
    {
        if (userRunActivities.ContainsKey(userId))
        {
            return userRunActivities[userId].Select(activity => activity.Pace).ToList();
        }

        return new List<double>();
    }

    public List<int> GetAllCaloriesBurned(string userId)
    {
        if (userRunActivities.ContainsKey(userId))
        {
            return userRunActivities[userId].Select(activity => activity.CaloriesBurned).ToList();
        }

        return new List<int>();
    }
}
