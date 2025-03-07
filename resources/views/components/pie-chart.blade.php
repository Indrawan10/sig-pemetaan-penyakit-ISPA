<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Pie Chart</title>
    <!-- Memuat library Chart.js dari CDN -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>
    <div style="width: 400px; height: 500px; margin: auto;">
        <canvas id="pieChart"></canvas>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            fetch('/api/pie-chart-data')
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    if (!data || data.length === 0) {
                        console.warn('No data received from API');
                        return;
                    }

                    var ctx = document.getElementById('pieChart').getContext('2d');
                    var pieChart = new Chart(ctx, {
                        type: 'pie',
                        data: {
                            labels: data.map(item => item.nama_desa),
                            datasets: [{
                                label: 'Total Kasus ISPA',
                                data: data.map(item => item.total_kasus_ispa), // Ganti total_penduduk dengan total_kasus_ispa
                                backgroundColor: [
                                    '#FF6384',  // Merah
                                    '#36A2EB',  // Biru
                                    '#FFCE56',  // Kuning
                                    '#4BC0C0',  // Tosca
                                    '#9966FF',  // Ungu
                                    '#FF9F40'   // Orange
                                ],
                                borderColor: [
                                    '#FF6384',
                                    '#36A2EB',
                                    '#FFCE56',
                                    '#4BC0C0',
                                    '#9966FF',
                                    '#FF9F40'
                                ],
                                borderWidth: 1
                            }]
                        },
                        options: {
                            responsive: true,
                            plugins: {
                                legend: {
                                    position: 'top',
                                },
                                title: {
                                    display: true,
                                    text: 'Total Kasus ISPA per Desa' // Ubah judul grafik
                                },
                                tooltip: {
                                    callbacks: {
                                        label: function(context) {
                                            return `${context.label}: ${context.raw} kasus ISPA`; // Ubah teks tooltip
                                        }
                                    }
                                }
                            }
                        }
                    });
                })
                .catch(error => {
                    console.error('Error fetching data:', error);
                    document.getElementById('pieChart').insertAdjacentHTML('afterend',
                        '<div class="alert alert-danger">Gagal memuat data. Silakan coba lagi.</div>'
                    );
                });
        });
    </script>
</body>

</html>
