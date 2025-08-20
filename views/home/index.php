<h1 style="font-family:sans-serif; text-align:center; margin:20px 0; color:#333;">
    Dashboard
</h1>

<div style="max-width:800px; margin:0 auto;">
    <h2>Popular Flowers</h2>
    <canvas id="popularFlowersChart"></canvas>

    <h2>Bouquet Status</h2>
    <canvas id="bouquetStatusChart"></canvas>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const popularFlowersData = <?php echo json_encode($popularFlowers); ?>; 
    const bouquetStatusStats = <?php echo json_encode($bouquetStatusStats); ?>;

    // Popular Flowers chart
    new Chart(document.getElementById('popularFlowersChart'), {
        type: 'bar',
        data: {
            labels: popularFlowersData.map(f => f.name),
            datasets: [{
                label: 'Orders',
                data: popularFlowersData.map(f => f.count),
                backgroundColor: '#ff6384'
            }]
        }
    });

    // Bouquet Status chart
    new Chart(document.getElementById('bouquetStatusChart'), {
        type: 'pie',
        data: {
            labels: bouquetStatusStats.map(s => s.status),
            datasets: [{
                data: bouquetStatusStats.map(s => s.total),
                backgroundColor: ['#36a2eb', '#ffce56', '#4bc0c0']
            }]
        }
    });
</script>