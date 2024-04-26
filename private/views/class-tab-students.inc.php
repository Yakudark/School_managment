<nav class="navbar navbar-light">
    <form class="form-inline">
        <div class="input-group">
            <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-magnifying-glass"></i>&nbsp</span>
            <input type="text" class="form-control" placeholder="Rechercher" aria-label="Rechercher" aria-describedby="basic-addon1">
        </div>
    </form>
    <h3 class="text-center">Étudiant.e</h3>
    <div>
        <a class="link-offset-2 link-underline link-underline-opacity-0" href="<?= ROOT ?>/single_class/studentadd/<?= $row->class_id ?>?&select=true">
            <button class="btn btn-sm btn-primary"><i class="icon-fa fa fa-plus"></i>Ajouter</button>
        </a>

        <a class="link-offset-2 link-underline link-underline-opacity-0" href="<?= ROOT ?>/single_class/studentremove/<?= $row->class_id ?>?&select=true">
            <button class="btn btn-sm btn-primary"><i class="icon-fa fa fa-minus"></i>Supprimer</button>
        </a>
    </div>

</nav>

<div class="card-group justify-content-center">
    <?php if (is_array($students)) : ?>
        <?php foreach ($students as $student) : ?>

            <?php
            $row = $student->user;
            include(views_path('user'))
            ?>

        <?php endforeach; ?>


    <?php else : ?>
        <center>
            <hr>
            <h4>Aucun résultat n'a été trouvé</h4>
        </center>
    <?php endif; ?>

</div>
<?php $pager->display(); ?>