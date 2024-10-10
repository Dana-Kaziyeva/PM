document.querySelector('.search-bar input').addEventListener('input', function (event) {
    const searchQuery = event.target.value.toLowerCase();
    const courses = document.querySelectorAll('.course-card');

    courses.forEach(function (course) {
        const courseTitle = course.querySelector('h2').textContent.toLowerCase();
        if (courseTitle.includes(searchQuery)) {
            course.style.display = 'block';
        } else {
            course.style.display = 'none';
        }
    });
});

// Toggle week content visibility individually
document.querySelectorAll('.week-header').forEach(button => {
    button.addEventListener('click', () => {
        const content = button.nextElementSibling;

        // Toggle display property
        if (content.style.display === "block") {
            content.style.display = "none";
        } else {
            content.style.display = "block";
        }
    });
});

// Collapse All functionality
document.querySelector('.collapse-button').addEventListener('click', () => {
    const weekContents = document.querySelectorAll('.week-content');

    // Check if all are collapsed or expanded
    const allCollapsed = [...weekContents].every(content => content.style.display === "none");

    weekContents.forEach(content => {
        if (allCollapsed) {
            content.style.display = "block"; // Expand all if everything is collapsed
        } else {
            content.style.display = "none"; // Collapse all otherwise
        }
    });
});
