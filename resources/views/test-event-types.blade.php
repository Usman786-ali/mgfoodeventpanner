<!DOCTYPE html>
<html>

<head>
    <title>Event Types Test</title>
</head>

<body>
    <h1>Active Event Types Test</h1>

    @php
        $eventTypes = \App\Models\EventType::active()->get();
    @endphp

    <p><strong>Total Active Event Types:</strong> {{ $eventTypes->count() }}</p>

    <h2>List:</h2>
    <ul>
        @foreach($eventTypes as $type)
            <li>{{ $type->name }} (Order: {{ $type->order }})</li>
        @endforeach
    </ul>

    <h2>Dropdown Preview:</h2>
    <select style="padding: 10px; font-size: 16px; width: 300px;">
        <option value="">Select Event Type</option>
        @foreach($eventTypes as $type)
            <option value="{{ $type->name }}">{{ $type->name }}</option>
        @endforeach
    </select>
</body>

</html>