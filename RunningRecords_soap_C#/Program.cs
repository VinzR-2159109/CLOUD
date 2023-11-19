using Models;
using SoapCore;
using runningRecords.Models;

var builder = WebApplication.CreateBuilder(args);

// Add services to the container.
builder.Services.AddControllers();
builder.Services.AddEndpointsApiExplorer();
builder.Services.AddSwaggerGen();
builder.Services.AddSingleton<IRunningHistoryService, RunningHistoryService>();

var app = builder.Build();

// Configure the HTTP request pipeline.
if (app.Environment.IsDevelopment())
{
    app.UseSwagger();
    app.UseSwaggerUI();
}

app.UseSoapEndpoint<IRunningHistoryService>("/Service.asmx", new SoapEncoderOptions());

app.UseHttpsRedirection();
app.UseAuthorization();
app.MapControllers();
app.Run();
