<nav class="navbar navbar-light">
    <form class="form-inline">
        <div class="input-group">

            <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-magnifying-glass"></i>&nbsp</span>
            <input type="text" class="form-control" placeholder="Rechercher" aria-label="Rechercher" aria-describedby="basic-addon1">
        </div>
    </form>
    <h3 class="text-center">Évaluation</h3>
    <a href="<?= ROOT ?>/single_class/testadd/<?= $row->class_id ?>?tab=test-add">
        <button class="btn btn-sm btn-primary"><i class="icon-fa fa fa-plus"></i>Ajouter une évaluation</button>
    </a>
</nav>

<table class="table table-striped table-hover">
    <tr>
        <th></th>
        <th>Évaluations</th>
        <th>Créé par</th>
        <th>Valide</th>
        <th>Date</th>
        <th></th>
    </tr>
    <?php if (isset($tests) && $tests) : ?>
        <?php foreach ($tests as $row) : ?>

            <tr>
                <td>
                    <a href="<?= ROOT ?>/single_test/<?= $row->test_id ?>" title="Détails">
                        <button class="btn btn-primary btn-sm" title="Détails"><i class="fa-solid fa-info"></i></button>
                    </a>
                </td>
                <?php $active = $row->disabled ? "Non" : "Oui"; ?>

                <td><?= $row->test ?></td>
                <td><?= $row->user->firstname ?> <?= $row->user->lastname ?></td>
                <td><?= $active ?></td>
                <td><?= get_date($row->date) ?></td>

                <td>

                    <?php if (Auth::access('Enseignant.e')) : ?>
                        <a class="link-offset-2 link-underline link-underline-opacity-0" href="<?= ROOT ?>/single_class/testedit/<?= $row->class_id ?>/<?= $row->test_id ?>?tab=tests" title="Modifier l'évaluation">
                            <button class="btn btn-sm btn-info text-white"><i class="fa fa-edit"></i></button>
                        </a>
                        <a class="link-offset-2 link-underline link-underline-opacity-0" href="<?= ROOT ?>/single_class/testdelete/<?= $row->class_id ?>/<?= $row->test_id ?>?tab=tests" title="Supprimer l'évaluation">
                            <button class="btn btn-sm btn-danger"><i class="fa fa-trash-alt"></i></button>
                        </a>
                    <?php endif; ?>
                </td>
            </tr>

        <?php endforeach; ?>
    <?php else : ?>
        <tr>
            <td colspan="6">
                <h4 class="text-center">Aucune évaluation trouvée</h4>
            </td>
        </tr>
    <?php endif; ?>
</table>