<article class="card card--category">
    <?php if ($category->getImage()): ?>
        <img src="<?= $category->getImageURL('small') ?>" alt="">
    <?php endif ?>
    <div class="card__body stack">
        <div class="card__header">
            <h2 class="card__title"><?= $category->getName() ?></h2>
            <svg class="card__svg" fill="#F0F5FF" xmlns="http://www.w3.org/2000/svg" shape-rendering="geometricPrecision" text-rendering="geometricPrecision" image-rendering="optimizeQuality" fill-rule="evenodd" clip-rule="evenodd" viewBox="0 0 512 411.22"><path d="M8.39 0h157.9c4.62 0 8.39 3.77 8.39 8.39v157.9c0 4.62-3.77 8.39-8.39 8.39H8.39c-4.62 0-8.39-3.77-8.39-8.39V8.39C0 3.77 3.77 0 8.39 0zm236.57 355.85h258.65c4.62 0 8.39 3.8 8.39 8.4v38.57c0 4.6-3.79 8.39-8.39 8.39H244.96c-4.6 0-8.39-3.77-8.39-8.39v-38.57c0-4.63 3.77-8.4 8.39-8.4zm0-118.61h258.65c4.62 0 8.39 3.79 8.39 8.39v38.57c0 4.6-3.79 8.4-8.39 8.4H244.96c-4.6 0-8.39-3.77-8.39-8.4v-38.57c0-4.62 3.77-8.39 8.39-8.39zm0-118.62h258.65c4.62 0 8.39 3.79 8.39 8.39v38.58c0 4.6-3.79 8.4-8.39 8.4H244.96c-4.6 0-8.39-3.78-8.39-8.4v-38.58c0-4.61 3.77-8.39 8.39-8.39zm0-118.62h258.65c4.62 0 8.39 3.8 8.39 8.39v38.58c0 4.59-3.79 8.39-8.39 8.39H244.96c-4.6 0-8.39-3.77-8.39-8.39V8.39c0-4.62 3.77-8.39 8.39-8.39zM8.39 236.53h157.9c4.62 0 8.39 3.77 8.39 8.39v157.91c0 4.61-3.77 8.39-8.39 8.39H8.39c-4.62 0-8.39-3.78-8.39-8.39V244.92c0-4.62 3.77-8.39 8.39-8.39z"/>
            </svg>
        </div>

        <div class="card__description muted-text">
            <p>
                <?= $category->getExerpt(380) ?>
            </p>
        </div>
        <a href="<?= $router->url('category', ['id' => $category->getID(), 'slug' => $category->getSlug()]) ?>" class="card__link" title="<?= $category->getName() ?>"> </a>

    </div>
    <div class="card__footer flex flex-start">
        <p>19 Post(s)</p>
    </div>
</article>