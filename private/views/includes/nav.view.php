<style>
    .navbar ul li a {
        width: 140px;
        text-align: center;
        border-left: solid thin #ddd !important;
        border-right: solid thin #ddd !important;
    }

    .navbar ul li a:last-child {
        border-right: none !important;
    }

    .navbar ul li a:hover {
        background-color: grey;

    }
</style>

<nav class="navbar navbar-expand-lg bg-body-tertiary p-2">
    <div class="container-fluid">

        <a class="navbar-brand" href="<?= ROOT ?>">
            <img src="<?= ROOT ?>/assets/graduate.png" alt="logo des écoles" class="" style="width:35px">
            <?= Auth::getSchool_name() ?>
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="<?= ROOT ?>/home">Tableau de bord</a>
                </li>

                <?php if (Auth::access('Super Admin')) : ?>
                    <li class="nav-item">

                        <a class="nav-link" href="<?= ROOT ?>/schools"><i class="fa fa-graduation-cap me-2"></i>Écoles</a>
                    </li>
                <?php endif; ?>

                <?php if (Auth::access('Admin')) : ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= ROOT ?>/users"><i class="fa fa-chalkboard-teacher me-2"></i>Personnels</a>
                    </li>
                <?php endif; ?>

                <?php if (Auth::access('Réceptionniste')) : ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= ROOT ?>/students"><i class="fa fa-user-graduate me-2"></i>Étudiants</a>
                    </li>
                <?php endif; ?>

                <li class="nav-item">
                    <a class="nav-link" href="<?= ROOT ?>/classes"><i class="fa fa-university me-2"></i>Discipline</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= ROOT ?>/tests"><i class="fa fa-file-signature me-2"></i>Évaluations</a>
                </li>
            </ul>

            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <?= Auth::getFirstname() ?>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" href="<?= ROOT ?>/profile"><i class="fa fa-id-card me-2"></i>Profil</a></li>
                        <li><a class="dropdown-item" href="<?= ROOT ?>/home">Tableau de bord</a></li>
                        <div class="dropdown-divider"></div>
                        <li><a class="dropdown-item" href="<?= ROOT ?>/logout"><i class="fa fa-sign-out-alt me-2"></i>Se déconnecter</a></li>
                    </ul>
                </li>
            </ul>

        </div>
        <div class="d-flex align-items-center m-2">
            <i class="fa-solid fa-sun"></i>
            <div class="form-check form-switch mx-2">
                <input class="form-check-input p-2" type="checkbox" role="switch" id="flexSwitchCheckChecked" checked onclick="myFunction()" />
                <i class="fa-solid fa-moon"></i>
            </div>
        </div>
    </div>
</nav>