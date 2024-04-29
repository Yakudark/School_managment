<center>
    <h5>Questions</h5>
</center>

<div class="btn-group">
    <button type="button" class="btn btn-success dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
        Action
    </button>
    <ul class="dropdown-menu">
        <li><a class="dropdown-item" href="<?= ROOT ?>/single_test/<?= $row->test_id ?>">Ajouter une question à choix multiples</a></li>
        <li><a class="dropdown-item" href="<?= ROOT ?>/single_test/<?= $row->test_id ?>">Ajouter une question objective</a></li>
        <li>
            <hr class="dropdown-divider">
        </li>
        <li><a class="dropdown-item" href="<?= ROOT ?>/single_test/addsubjective/<?= $row->test_id ?>">Ajouter une question subjective</a></li>
    </ul>
</div>