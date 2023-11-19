using System;
using Models;

namespace runningRecords.Models;

public class RunningHistoryService : IRunningHistoryService
{
    private static Dictionary<string, List<RunActivity>> userRunActivities = new();
    private readonly Dictionary<string, double> users = new();

    public List<RunActivity> GetRunningHistory(string userId)
    {
        if (userRunActivities.ContainsKey(userId))
        {
            return userRunActivities[userId];
        }

        return new List<RunActivity>();
    }

    public double CalculateAveragePace(string userId)
    {
        if (userRunActivities.ContainsKey(userId) && userRunActivities[userId].Count > 0)
        {
            var totalPace = userRunActivities[userId].Select(activity => activity.Pace).Sum();
            return totalPace / userRunActivities[userId].Count;
        }

        return 0.0;
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
            Duration = TimeSpan.FromMinutes(timeInMinutes),
            Pace = pace,
            CaloriesBurned = CalculateCaloriesBurned(timeInMinutes, userId)
        };

        userRunActivities[userId].Add(activity);
    }   

    private int CalculateCaloriesBurned(double timeInMinutes, string userId)
    {
        const int MET = 7;
        double weightKg = users.ContainsKey(userId) ? users[userId] : 76;

        double timeInHours = timeInMinutes / 60.0;
        double caloriesBurned = MET * weightKg * timeInHours;

        return (int)caloriesBurned;
    }

    private Dictionary<string, double> AddSampleUsers(int numberOfUsers = 5)
    {
        Random random = new();

        for (int i = 0; i < numberOfUsers; i++)
        {
            string userId = random.Next(111, 1000).ToString();
            double weight = Math.Round(random.NextDouble() * 20 + 60.0,1);

            users[userId] = weight;;
        }

        return users;
    }

    private static void AddSampleActivities(string userId = "123", int numberOfActivities = 25)
    {
        if (!userRunActivities.ContainsKey(userId))
        {
            userRunActivities[userId] = new List<RunActivity>();

            Random random = new();

            for (int i = 0; i < numberOfActivities; i++)
            {
                double distance = Math.Round(random.NextDouble() * 10 + 3.0, 3);
                TimeSpan duration = TimeSpan.FromMinutes(random.Next(20, 120));
                double pace = Math.Round(duration.TotalMinutes / distance, 2);
                int caloriesBurned = random.Next(200, 800);

                var activity = new RunActivity
                {
                    DistanceInKm = distance,
                    Duration = duration,
                    Pace = pace,
                    CaloriesBurned = caloriesBurned
                };

                userRunActivities[userId].Add(activity);
            }
        }
    }

    public Dictionary<string, double> AddSamples()
    {
        Dictionary<string, double> sampleUsers = AddSampleUsers(5);

        foreach (var user in sampleUsers)
        {
            AddSampleActivities(user.Key, 10);
        }
        return sampleUsers;
    }
}
