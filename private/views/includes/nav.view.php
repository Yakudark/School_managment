<style>
    nav ul li a {
        width: 140px;
        text-align: center;
        border-left: solid thin #ddd !important;
        border-right: solid thin #ddd !important;
    }

    nav ul li a:last-child {
        border-right: none !important;
    }

    nav ul li a:hover {
        background-color: grey;

    }
</style>
<nav class="navbar navbar-expand-lg bg-body-tertiary p-2">
    <div class="container-fluid">

        <a class="navbar-brand" href="#">
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
                <li class="nav-item">
                    <a class="nav-link" href="<?= ROOT ?>/schools">Écoles</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= ROOT ?>/users">Personnel</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= ROOT ?>/students">Étudiants</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= ROOT ?>/classes">Classes</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= ROOT ?>/tests">Évaluations</a>
                </li>
            </ul>

            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <?= Auth::getFirstname() ?>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" href="<?= ROOT ?>/profile">Profil</a></li>
                        <li><a class="dropdown-item" href="<?= ROOT ?>/home">Tableau de bord</a></li>
                        <div class="dropdown-divider"></div>
                        <li><a class="dropdown-item" href="<?= ROOT ?>/logout">Se déconnecter</a></li>
                    </ul>
                </li>
            </ul>

        </div>
    </div>
</nav>