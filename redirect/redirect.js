// Function to get the URL parameter by name
function getParameterByName(name, url = window.location.href) {
    name = name.replace(/[\[\]]/g, '\\$&');
    var regex = new RegExp('[?&]' + name + '(=([^&#]*)|&|#|$)'),
        results = regex.exec(url);
    if (!results) return null;
    if (!results[2]) return '';
    return decodeURIComponent(results[2].replace(/\+/g, ' '));
}

// Get the 'destination' parameter from the URL
var destinationURL = getParameterByName('destination');

// Check if the destination URL exists and is valid
if (destinationURL) {
    // Wait for a few seconds (e.g., 5 seconds)
    setTimeout(function () {
        // Redirect to the final destination
        window.location.replace(destinationURL);
    }, 5000); // 5000 milliseconds = 5 seconds
} else {
    console.error('No destination URL specified.');
    // Optionally, display an error message or redirect to a default page
    document.body.innerHTML = '<p>Error: No destination URL specified.</p>';
}