<?php $this->view('includes/header') ?>
<?php $this->view('includes/nav') ?>

<div class="container-fluid p-4 shadow mx-auto" style="max-width: 1000px;">
    <?php $this->view('includes/crumbs', ['crumbs' => $crumbs]) ?>

    <h5 class="text-center">Disciplines</h5>
    <div class="card-group justify-content-center ">
        <table class="table table-striped table-hover">
            <tr>
                <th></th>
                <th>Discipline</th>
                <th>Créé par</th>
                <th>Date</th>
                <th>
                    <a href="<?= ROOT ?>/classes/add">
                        <button class="btn btn-sm btn-primary"><i class="icon-fa fa fa-plus"></i>Ajouter une discipline</button>
                    </a>
                </th>
            </tr>
            <?php if ($rows) : ?>
                <?php foreach ($rows as $row) : ?>

                    <tr>
                        <td>
                            <a href="<?= ROOT ?>/single_class/<?= $row->class_id ?>" title="Détails">
                                <button class="btn btn-primary btn-sm" title="Détails"><i class="fa-solid fa-info"></i></button>
                            </a>
                        </td>
                        <td><?= $row->class ?></td>
                        <td><?= $row->user->firstname ?> <?= $row->user->lastname ?></td>
                        <td><?= get_date($row->date) ?></td>
                        <td>
                            <a href="<?= ROOT ?>/classes/edit/<?= $row->id ?>" title="Modifier la discipline">
                                <button class="btn btn-sm btn-info text-white"><i class="fa fa-edit"></i></button>
                            </a>
                            <a href="<?= ROOT ?>/classes/delete/<?= $row->id ?>" title="Supprimer la discipline">
                                <button class="btn btn-sm btn-danger"><i class="fa fa-trash-alt"></i></button>
                            </a>

                        </td>
                    </tr>

                <?php endforeach; ?>
            <?php else : ?>
                <h4>Aucune discipline trouvée</h4>
            <?php endif; ?>
        </table>
    </div>
</div>
<?php $this->view('includes/footer') ?>