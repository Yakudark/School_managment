<form method="post" class="form mx-auto" style="width:100% ;max-width:400px">
    <h4 class="mt-2">Ajouter un.e enseignant.e</h4>
    <input autofocus class="form-control" type="text" name="name" placeholder="Nom de l'enseignant.e">

    <a href="<?= ROOT ?>/single_class/<?= $row->class_id ?>?tab=lecturers">
        <button type='button' class="btn btn-danger mt-3">Annuler</button>
    </a>

    <button class="btn btn-primary mt-3 float-end" name="search">Recherche</button>

    <div class="clearfix"></div>
</form>

<div class="container-fluid">

    <?php if (isset($results) && ($results)) : ?>
        <table class="table table-striped table-hover mt-4">
            <tr>
                <th>Nom</th>
                <th>Action</th>
            </tr>
            <?php
            foreach ($results as $row) : ?>
                <tr>
                    <td><?= $row->firstname ?> <?= $row->lastname ?></td>
                    <td>
                        <button class="btn btn-sm btn-danger">Ajouter</button>
                    </td>
                </tr>

            <?php endforeach; ?>
        </table>
    <?php else : ?>
        <?php if (count($_POST) > 0) : ?>
            <div class="alert alert-warning mt-4" role="alert">
                Aucun utilisateur trouvé
            </div>
        <?php endif; ?>
    <?php endif; ?>

</div>