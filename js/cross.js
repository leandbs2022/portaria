// Get the cross and container elements
const cross = document.getElementById('cross');
const container = document.getElementById('container-fluir');

// Set initial rotation angle and direction
let rotationAngle = 0;
let rotateClockwise = true;

// Function to move the cross
function moveCross() {
    // Update rotation angle
    if (rotateClockwise) {
        rotationAngle += 5; // Increase angle for clockwise rotation
    } else {
        rotationAngle -= 5; // Decrease angle for counter-clockwise rotation
    }

    // Apply rotation to the cross
    cross.style.transform = `translate(-50%, -50%) rotate(${rotationAngle}deg)`;

    // Check if cross reaches container edges
    const containerRect = container.getBoundingClientRect();
    const crossRect = cross.getBoundingClientRect();

    if (crossRect.right >= containerRect.right || crossRect.left <= containerRect.left) {
        // Change rotation direction if cross reaches horizontal container edges
        rotateClockwise = !rotateClockwise;
    }
}

// Set interval to move the cross every 50 milliseconds
setInterval(moveCross, 50);