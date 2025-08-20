    <main>
        <h1>Choose the flowers for your personalised bouquet!</h1>
        <a href="/flowers/add" class="button">Add Flower</a>
        <ul class="flower-list">
            <?php foreach ($flowers as $flower) {
                include 'flowerItem.php';
            } ?>
        </ul>
    </main>