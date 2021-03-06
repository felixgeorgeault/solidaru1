<?php

use App\{Attachment\CategoryAttachment, Auth, Connection, HTML\Form, Model\Category, ObjectHelper, Table\CategoryTable, Validators\CategoryValidator};

Auth::check();
$pdo = Connection::getPDO();
$table = new CategoryTable($pdo);
/** @var Category|false */
$item = $table->find($params['id']);
$errors = [];
$fields = ['name', 'slug', 'content', 'created_at', 'image', ];
if (!empty($_POST)) {
    $data = array_merge($_POST, $_FILES);
    $v = new CategoryValidator($data, $table, $item->getID());
    ObjectHelper::hydrate($item, $data, $fields);

    if ($v->validate()) {
        $categoryAttachment = new CategoryAttachment;
        $categoryAttachment->upload($item);
        $table->updatePC($item);
        header('Location: ' . $router->url('admin_category', ['id' => $params['id']]) . '?modified=1');
    } else {
        $errors = $v->errors();
    }

}

$form = new Form($item, $errors);
?>
<h2 class="mt4 medium-title">
    <svg class="svg-big">
        <use xlink:href="/img/svg/sprite.svg#edit"></use>
    </svg>
    Éditer la catégorie "<?= $item->getName() ?>"
</h2>
<hr>
<?php if (isset($_GET['modified'])): ?>
    <p class="alert alert-success">La catégorie a bien été modifiée</p>
<?php endif ?>
<?php if (isset($_GET['delete_thumbnail'])): ?>
    <p class="alert alert-success">L'image à la une à bien été supprimée</p>
<?php endif ?>
<?php require '_form.php' ?>

<?php
// Flatpickr
$css_flatpickr = '<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.6.13/flatpickr.min.css">';
$beforeBodyContent = ob_before($css_flatpickr);
$js_flatpickr = <<<HTML
<script src="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.6.13/flatpickr.min.js"></script>
<script src="/js/datePicker.js"></script>
HTML;
$afterBodyContent = ob_after($js_flatpickr);
