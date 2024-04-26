<h3 class="text-center mt-4">Mes cours</h3>

<nav class="navbar navbar-light">
    <form class="form-inline">
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1"><i class="fa fa-search"></i>&nbsp</span>
            </div>
            <input type="text" class="form-control" placeholder="Recherche" aria-label="Recherche" aria-describedby="basic-addon1">
        </div>
    </form>
</nav>


<?php $rows = $student_classes; ?>
<?php include(views_path('classes')) ?>

