fetch('../php/get_data.php')
    .then(response => response.json())
    .then(data => {
        // 月の順にデータをソート
        data.sort((a, b) => a.month - b.month);

        const ctx = document.getElementById('myChart').getContext('2d');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: data.map(row => row.month),
                datasets: [{
                    label: '支出(Outcome)',
                    data: data.map(row => row.total),
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }, {
                    label: '収入(Income)',
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
