
 // Select all password toggle icons
    document.querySelectorAll('.form-password-toggle .input-group-text').forEach(icon => {
        icon.addEventListener('click', function () {
            let input = this.parentElement.querySelector('input');

            if (input.type === "password") {
                input.type = "text";
                this.querySelector("i").classList.remove("bi-eye");
                this.querySelector("i").classList.add("bi-eye-slash");
            } else {
                input.type = "password";
                this.querySelector("i").classList.remove("bi-eye-slash");
                this.querySelector("i").classList.add("bi-eye");
            }
        });
    });

// sidebar in All page

  const toggleIcon = document.querySelector('.toggle-icon');
        const sidebar = document.querySelector('.sidebar');
        const content = document.querySelector('.content');

        toggleIcon.addEventListener('click', () => {
            const isOpen = sidebar.classList.toggle('collapsed');
            content.classList.toggle('collapsed');
            toggleIcon.classList.toggle('bi-list', !isOpen);
            toggleIcon.classList.toggle('bi-x', isOpen);
            toggleIcon.setAttribute('aria-expanded', isOpen);
        });

// Recent Movement in home page
var xValues = [];
        var yValues = [];
        generateData("Math.sin(x)", 0, 10, 0.5);

        new Chart("myChart", {
            type: "line",
            data: {
                labels: xValues,
                datasets: [{
                    label: "sin(x)",
                    fill: false,
                    pointRadius: 3,
                    borderColor: "rgba(0, 123, 255, 0.7)",
                    backgroundColor: "rgba(0, 123, 255, 0.7)",
                    borderWidth: 2,
                    data: yValues
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                legend: { display: true },
                scales: {
                    xAxes: [{
                        display: true,
                        scaleLabel: { display: true, labelString: 'x' }
                    }],
                    yAxes: [{
                        display: true,
                        scaleLabel: { display: true, labelString: 'sin(x)' }
                    }]
                }
            }
        });

        function generateData(value, i1, i2, step = 1) {
            for (let x = i1; x <= i2; x += step) {
                yValues.push(eval(value));
                xValues.push(x);
            }
        }
// Browser Usage browserChart in home page

 const ctx = document.getElementById('browserChart').getContext('2d');
        new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: ['Chrome', 'Firefox', 'IE'],
                datasets: [{
                    data: [4401, 4003, 1589],
                    backgroundColor: ['#4285F4', '#FF9500', '#DB4437'],
                    borderWidth: 0
                }]
            },
            options: {
                cutout: '75%',
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        backgroundColor: '#111',
                        titleColor: '#fff',
                        bodyColor: '#fff',
                        cornerRadius: 8,
                        padding: 10
                    }
                }
            }
        });
// Monthly Sales chartjs-dashboard-bar in home page

document.addEventListener("DOMContentLoaded", function () {
    const ctx = document.getElementById("chartjs-dashboard-bar").getContext("2d");

    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun",
                "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
            datasets: [{
                label: "This year",
                data: [54, 67, 41, 55, 62, 45, 55, 73, 60, 76, 48, 79],
                backgroundColor: "#0d6efd" // Bootstrap primary color
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                }
            },
            scales: {
                y: {
                    grid: { display: false },
                    ticks: {
                        stepSize: 20
                    }
                },
                x: {
                    grid: { color: "transparent" }
                }
            }
        }
    });
});

