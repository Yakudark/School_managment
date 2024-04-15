<nav class="navbar navbar-light bg-light">
    <form class="form-inline">
        <div class="input-group">
            <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-magnifying-glass"></i>&nbsp</span>
            <input type="text" class="form-control" placeholder="Rechercher" aria-label="Rechercher" aria-describedby="basic-addon1">
        </div>
    </form>

    <div>
        <a href="<?= ROOT ?>/single_class/lectureradd/<?= $row->class_id ?>?&select=true">
            <button class="btn btn-sm btn-primary"><i class="icon-fa fa fa-plus"></i>Ajouter</button>
        </a>

        <a href="<?= ROOT ?>/single_class/lecturerremove/<?= $row->class_id ?>?&select=true">
            <button class="btn btn-sm btn-primary"><i class="icon-fa fa fa-minus"></i>Supprimer</button>
        </a>
    </div>

</nav>

<div class="card-group justify-content-center">
    <?php if (is_array($lecturers)) : ?>
        <?php foreach ($lecturers as $lecturer) : ?>

            <?php
            $row = $lecturer->user;
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