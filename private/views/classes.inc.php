<div class="card-group justify-content-center ">

    <table class="table table-striped table-hover">
        <tr>
            <th></th>
            <th>Cours</th>
            <th>Créé par</th>
            <th>Date</th>
            <th>
                <a href="<?= ROOT ?>/classes/add">
                    <button class="btn btn-sm btn-primary"><i class="icon-fa fa fa-plus"></i>Ajouter un cours</button>
                </a>
            </th>
        </tr>
        <?php if (isset($rows) && $rows) : ?>
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

                        <?php if (Auth::access('Enseignant.e')) : ?>
                            <a href="<?= ROOT ?>/classes/edit/<?= $row->id ?>" title="Modifier le cours">
                                <button class="btn btn-sm btn-info text-white"><i class="fa fa-edit"></i></button>
                            </a>
                            <a href="<?= ROOT ?>/classes/delete/<?= $row->id ?>" title="Supprimer le cours">
                                <button class="btn btn-sm btn-danger"><i class="fa fa-trash-alt"></i></button>
                            </a>
                        <?php endif; ?>
                    </td>
                </tr>

            <?php endforeach; ?>
        <?php else : ?>
            <h4>Aucun cours trouvé</h4>
        <?php endif; ?>
    </table>
</div>