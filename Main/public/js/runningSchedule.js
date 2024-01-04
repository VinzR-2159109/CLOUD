document.getElementById('makeScheduleBtn').addEventListener('click', function() {
    const fitnessLevel = document.getElementById('fitnessLevel').value;

    fetch('/make-running-schedule', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
        },
        body: JSON.stringify({ fitnessLevel }),
    })
    .then(response => response.json())
    .then(data => {
        const resultContainer = document.getElementById('resultContainer');
        resultContainer.innerHTML = `
            <p>${data.message}</p>
            <p>Schedule:</p>
            <ul>
                ${Object.entries(data.schedule).map(([day, details]) => `
                <li>
                    ${day}: ${details.activity === 'rest' ? 'Rest' : 'Fartlek'} - 
                    ${details.activity === 'rest' ? '' : (details.distance || details.distances.join(', ')) + ' kilometers'}
                </li>
                `).join('')}
            </ul>
        `;
    })
    .catch(error => console.error('Error:', error));
});
