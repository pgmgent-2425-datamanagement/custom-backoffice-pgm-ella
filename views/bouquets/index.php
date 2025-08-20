<h1><?= $title ?></h1>
<ul>
    {# Loop through each bouquet and display its name #}
    {% for bouquet in bouquets %}
        <li>{{ bouquet.name }}</li>
    {% endfor %}
</ul>