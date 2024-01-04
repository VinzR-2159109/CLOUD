using weatherService.Services;

var builder = WebApplication.CreateBuilder(args);
builder.Services.AddGrpc();
builder.Services.AddCors(o => o.AddPolicy("AllowAll", builder => {
    builder
        .AllowAnyOrigin()
        .AllowAnyMethod()
        .AllowAnyHeader()
        .WithExposedHeaders("Grpc-Status", "Grpc-Message", "Grpc-Encoding", "Grpc-Accept-Encoding");
}));

var app = builder.Build();
app.UseCors();
app.UseGrpcWeb();
app.MapGrpcService<WeatherServiceImpl>().EnableGrpcWeb().RequireCors("AllowAll");
app.MapGet("/", () => "use a client!");

app.Run();
