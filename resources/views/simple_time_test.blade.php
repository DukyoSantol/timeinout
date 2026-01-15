<!DOCTYPE html>
<html>
<head>
    <title>Simple Time Test</title>
</head>
<body>
    <h1>Simple Time Debug</h1>
    
    <h2>Step 1: Laravel Time (should be correct):</h2>
    <p id="laravelTime">{{ now()->setTimezone('Asia/Manila')->format('l, F j, Y h:i:s A') }}</p>
    
    <h2>Step 2: Raw Laravel Time:</h2>
    <p id="rawTime">{{ now()->setTimezone('Asia/Manila')->format('Y-m-d\TH:i:s') }}</p>
    
    <h2>Step 3: JavaScript Test:</h2>
    <p id="jsTest">Loading...</p>
    
    <h2>Step 4: Final Time Display:</h2>
    <p id="finalTime" style="font-size: 24px; font-weight: bold; color: red;">Loading...</p>
    
    <script>
        console.log('=== TIME DEBUG START ===');
        
        // Step 1: Get what Laravel actually generated
        const laravelTimeElement = document.getElementById('laravelTime');
        const rawTimeElement = document.getElementById('rawTime');
        
        console.log('Laravel time element:', laravelTimeElement.textContent);
        console.log('Raw time element:', rawTimeElement.textContent);
        
        // Step 2: Parse the raw time
        const rawTimeString = rawTimeElement.textContent.trim();
        console.log('Raw time string:', rawTimeString);
        
        const baseTime = new Date(rawTimeString);
        console.log('Parsed base time:', baseTime.toString());
        console.log('Is base time valid?', !isNaN(baseTime.getTime()));
        
        // Step 3: Test manual time creation
        const pageLoadTime = Date.now();
        console.log('Page load time:', pageLoadTime);
        
        // Step 4: Create final time display
        function updateFinalTime() {
            const elapsed = Date.now() - pageLoadTime;
            const currentTime = new Date(baseTime.getTime() + elapsed);
            
            // Format exactly like Laravel
            const days = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
            const months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
            
            const dayName = days[currentTime.getDay()];
            const monthName = months[currentTime.getMonth()];
            const date = currentTime.getDate();
            const year = currentTime.getFullYear();
            
            let hours = currentTime.getHours();
            const minutes = currentTime.getMinutes().toString().padStart(2, '0');
            const seconds = currentTime.getSeconds().toString().padStart(2, '0');
            const ampm = hours >= 12 ? 'PM' : 'AM';
            hours = hours % 12;
            hours = hours ? hours : 12;
            
            const formattedTime = `${dayName}, ${monthName} ${date}, ${year} ${hours}:${minutes}:${seconds} ${ampm}`;
            
            document.getElementById('finalTime').textContent = formattedTime;
            document.getElementById('jsTest').textContent = `Elapsed: ${Math.floor(elapsed/1000)}s | Current: ${formattedTime}`;
            
            console.log('Final time:', formattedTime);
        }
        
        // Start the clock
        updateFinalTime();
        setInterval(updateFinalTime, 1000);
        
        console.log('=== TIME DEBUG END ===');
    </script>
</body>
</html>
