<h1 style="font-family:sans-serif; text-align:center; margin:20px 0; color:#333;">
    Dashboard
</h1>

<div style="display:grid; grid-template-columns:1fr 1fr; gap:30px; max-width:1000px; margin:0 auto;">
    <div style="background:#fff; padding:20px; border-radius:12px; box-shadow:0 2px 8px rgba(0,0,0,0.1);">
        <canvas id="ordersChart"></canvas>
    </div>
    <div style="background:#fff; padding:20px; border-radius:12px; box-shadow:0 2px 8px rgba(0,0,0,0.1);">
        <canvas id="topChart"></canvas>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
const ordersLabels = <?= json_encode(array_column($orders, 'd')) ?>;
const ordersData   = <?= json_encode(array_map('intval', array_column($orders, 'c'))) ?>;

new Chart(document.getElementById('ordersChart'), {
    type: 'line',
    data: {
        labels: ordersLabels,
        datasets: [{
            label: 'Orders per Day',
            data: ordersData,
            borderColor: '#e74c3c',
            backgroundColor: 'rgba(231, 76, 60, 0.2)',
            tension: 0.4,
            fill: true,
            pointRadius: 5,
            pointBackgroundColor: '#e74c3c'
        }]
    },
    options: {
        responsive: true,
        plugins: {
            legend: { display: false },
            title: { display: true, text: '📈 Orders (Last 7 Days)', font: { size: 16 } }
        }
    }
});

const topLabels = <?= json_encode(array_column($top, 'name')) ?>;
const topData   = <?= json_encode(array_map('intval', array_column($top, 'c'))) ?>;

new Chart(document.getElementById('topChart'), {
    type: 'bar',
    data: {
        labels: topLabels,
        datasets: [{
            label: 'Top Flowers',
            data: topData,
            backgroundColor: ['#3498db','#9b59b6','#1abc9c','#f39c12','#e67e22'],
            borderRadius: 6
        }]
    },
    options: {
        responsive: true,
        plugins: {
            legend: { display: false },
            title: { display: true, text: '🌼 Most Popular Flowers', font: { size: 16 } }
        },
        scales: {
            y: { beginAtZero: true }
        }
    }
});
</script>