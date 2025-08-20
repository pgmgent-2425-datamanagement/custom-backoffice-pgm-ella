<?php
/** @var string $title */
/** @var array $clients */
?>

<h1 class="page-title"><?= htmlspecialchars($title) ?></h1>

<?php if (!empty($clients)): ?>
    <table class="clients-table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Joined At</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($clients as $client): ?>
            <tr>
                <td><?= htmlspecialchars($client->name) ?></td>
                <td><?= htmlspecialchars($client->email) ?></td>
                <td><?= date('d M Y', strtotime($client->created_at)) ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php else: ?>
    <p>No clients found.</p>
<?php endif; ?>

<style>
.page-title {
    font-size: 2rem;
    margin-bottom: 1rem;
    color: #8B0000; /* dark red text */
}

.clients-table {
    width: 100%;
    border-collapse: collapse;
    background: #fff8f0;
    border-radius: 10px;
    overflow: hidden;
    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
}

.clients-table th,
.clients-table td {
    padding: 0.75rem 1rem;
    border-bottom: 1px solid #f0e5df;
    text-align: left;
}

.clients-table th {
    background-color: #B22222;
    color: #fff;
}

.clients-table tr:hover {
    background-color: #ffe8e0;
}
</style>