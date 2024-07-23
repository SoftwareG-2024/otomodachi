document.getElementById('loadData').addEventListener('click', function () {
    fetch('../php/get_data.php')
        .then(response => response.json())
        .then(data => {
            // Sort the data by month
            data.sort((a, b) => a.month.localeCompare(b.month));

            const ctx = document.getElementById('myChart').getContext('2d');
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: data.map(row => row.month),
                    datasets: [{
                        label: 'Total',
                        data: data.map(row => row.total),
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 1
                    }, {
                        label: 'Income',
                        data: data.map(row => row.income),
                        backgroundColor: 'rgba(153, 102, 255, 0.2)',
                        borderColor: 'rgba(153, 102, 255, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        });
});
