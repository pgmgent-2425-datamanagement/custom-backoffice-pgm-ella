<li class="flower-item">
    <img src="/<?= $flower->image ?>" alt="<?= $flower->name ?>" class="flower-image">
    <div class="flower-info">
        <h3 class="flower-title"><?= $flower->name ?></h3>
        <p class="flower-description"><?= $flower->description ?></p>
        <span class="flower-price">€ <?= $flower->price ?></span>
    </div>
    <a href="/flowers/edit/<?= $flower->id ?>" class="btn btn-edit">Edit</a>
    <a href="/flowers/delete/<?= $flower->id ?>" class="btn btn-delete">Delete</a>
</li>