<center>
    <h5>Ajouter une question subjective</h5>
</center>

<form method="post" enctype="multipart/form-data">
    
    <?php if (count($errors) > 0) : ?>
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong><i class="fa-solid fa-triangle-exclamation"></i> Erreurs :</strong>

            <?php foreach ($errors as $error) : ?>
                <br> <?= $error ?>
            <?php endforeach; ?>

            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <label>Question: </label>
    <textarea autofocus name="question" class="form-control" placeholder="Tapez votre question ici"></textarea>
    <div class="input-group mb-3 pt-4">
        <label class="input-group-text" for="inputGroupFile01"><i class="fa-regular fa-image me-2"></i>Image</label>
        <input type="file" class="form-control" id="inputGroupFile01">
    </div>

    <a href="<?= ROOT ?>/single_test/<?= $row->test_id ?>">
        <button type="button" class="btn btn-sm btn-primary me-2"><i class="fa-solid fa-arrow-rotate-left me-2"></i>Retour</button>
    </a>
    <button class="btn btn-sm btn-success float-end">Sauvegarder</button>

</form>