// Simple time fix - just display current time correctly
function updateTime() {
    const now = new Date();
    const options = {
        weekday: 'long',
        year: 'numeric',
        month: 'long',
        day: 'numeric',
        hour: 'numeric',
        minute: 'numeric',
        second: 'numeric',
        hour12: true,
        timeZone: 'Asia/Manila'
    };
    const timeString = now.toLocaleString('en-US', options);
    document.getElementById('systemTime').textContent = timeString;
}

// Update immediately and every second
updateTime();
setInterval(updateTime, 1000);
