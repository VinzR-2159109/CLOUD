from google.protobuf import descriptor as _descriptor
from google.protobuf import message as _message
from typing import ClassVar as _ClassVar, Optional as _Optional

DESCRIPTOR: _descriptor.FileDescriptor

class WeatherRequest(_message.Message):
    __slots__ = ["location"]
    LOCATION_FIELD_NUMBER: _ClassVar[int]
    location: str
    def __init__(self, location: _Optional[str] = ...) -> None: ...

class WeatherResponse(_message.Message):
    __slots__ = ["temperature", "conditions"]
    TEMPERATURE_FIELD_NUMBER: _ClassVar[int]
    CONDITIONS_FIELD_NUMBER: _ClassVar[int]
    temperature: str
    conditions: str
    def __init__(self, temperature: _Optional[str] = ..., conditions: _Optional[str] = ...) -> None: ...
