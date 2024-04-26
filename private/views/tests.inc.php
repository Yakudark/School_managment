<div class="card-group justify-content-center ">

    <table class="table table-striped table-hover">
        <tr>
            <th></th>
            <th>Évaluations</th>
            <th>Créé par</th>
            <th>Valide</th>
            <th>Date</th>
            <th></th>
        </tr>
        <?php if (isset($rows) && $rows) : ?>
            <?php foreach ($rows as $row) : ?>

                <tr>
                    <td>
                        <a href="<?= ROOT ?>/single_test/<?= $row->test_id ?>">
                            <button class="btn btn-sm btn-primary"><i class="fa fa-chevron-right"></i></button>
                        </a>
                    </td>
                    <?php $active = $row->disabled ? "No" : "Yes"; ?>
                    <td><?= $row->test ?></td>
                    <td><?= $row->user->firstname ?> <?= $row->user->lastname ?></td>
                    <td><?= $active ?></td>
                    <td><?= get_date($row->date) ?></td>

                    <td>

                    </td>

                </tr>

            <?php endforeach; ?>
        <?php else : ?>
            <tr>
                <td colspan="5">
                    <h4 class="text-center">Aucune évaluation trouvée</h4>
                </td>
            </tr>
        <?php endif; ?>
    </table>
</div>