<?php
/** @var string $title */
/** @var array $bouquets */
?>

<h1 class="page-title"><?= htmlspecialchars($title) ?></h1>

<div class="grid-container">
    <?php if (!empty($bouquets)): ?>
        <?php foreach ($bouquets as $bouquet): ?>
            <div class="bouquet-card">
                <img src="<?= htmlspecialchars($bouquet->image) ?>" alt="<?= htmlspecialchars($bouquet->name) ?>">
                <h2><?= htmlspecialchars($bouquet->name) ?></h2>
                <p><?= htmlspecialchars($bouquet->description) ?></p>
                <span class="price">$<?= number_format($bouquet->price, 2) ?></span>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>No bouquets available at the moment.</p>
    <?php endif; ?>
</div>

<style>
.page-title {
    font-size: 2rem;
    margin-bottom: 1rem;
    color: #8B0000; /* dark red text */
}

.grid-container {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
    gap: 1.5rem;
}

.bouquet-card {
    background: #fff8f0;
    padding: 1rem;
    border-radius: 15px;
    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    text-align: center;
    transition: transform 0.2s ease, box-shadow 0.2s ease;
}

.bouquet-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 6px 12px rgba(0,0,0,0.15);
}

.bouquet-card img {
    max-width: 100%;
    border-radius: 10px;
    margin-bottom: 0.5rem;
}

.price {
    display: block;
    margin-top: 0.5rem;
    font-weight: bold;
    color: #B22222;
}
</style>