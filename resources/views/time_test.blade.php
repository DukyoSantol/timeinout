<!DOCTYPE html>
<html>
<head>
    <title>Time Test</title>
</head>
<body>
    <h1>Time Debug Test</h1>
    
    <h2>Laravel Time (should be correct):</h2>
    <p>{{ now()->setTimezone('Asia/Manila')->format('l, F j, Y h:i:s A') }}</p>
    
    <h2>Raw Timestamp:</h2>
    <p>{{ now()->setTimezone('Asia/Manila')->format('Y-m-d\TH:i:s') }}</p>
    
    <h2>PHP Time:</h2>
    <p>{{ date('l, F j, Y h:i:s A') }}</p>
    
    <h2>Current Timestamp:</h2>
    <p>{{ time() }}</p>
    
    <h2>JavaScript Test:</h2>
    <p id="jsTime">Loading...</p>
    
    <script>
        // Test what JavaScript sees
        const serverTime = new Date('{{ now()->setTimezone('Asia/Manila')->format('Y-m-d\TH:i:s') }}');
        document.getElementById('jsTime').textContent = 'JavaScript sees: ' + serverTime.toString();
        
        console.log('Server time string:', '{{ now()->setTimezone('Asia/Manila')->format('Y-m-d\TH:i:s') }}');
        console.log('JavaScript Date object:', serverTime);
    </script>
</body>
</html>
