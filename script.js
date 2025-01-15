const infoForm = document.getElementById('infoForm');
const displayInfo = document.getElementById('displayInfo');
const displayName = document.getElementById('displayName');
const displayEmail = document.getElementById('displayEmail');
const displayAge = document.getElementById('displayAge');
const displayCity = document.getElementById('displayCity');
const displayBio = document.getElementById('displayBio');

infoForm.addEventListener('submit', function(event) {
    event.preventDefault(); // Prevent form from submitting normally

    // Get values from the form
    const name = document.getElementById('name').value;
    const email = document.getElementById('email').value;
    const age = document.getElementById('age').value;
    const city = document.getElementById('city').value;
    const bio = document.getElementById('bio').value;

    // Display the information
    displayName.textContent = name;
    displayEmail.textContent = email;
    displayAge.textContent = age;
    displayCity.textContent = city;
    displayBio.textContent = bio;

    displayInfo.style.display = 'block'; // Show the display area
});