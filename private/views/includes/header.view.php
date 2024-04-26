<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" type="text/css" href="<?= ROOT ?>/assets/bootstrap.min.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/all.min.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/card-hover.css">
</head>

<body data-bs-theme="dark">

    <style>
        .icon-fa {
            margin-right: 4px;
        }
    </style>

    <div style="min-width:350px;">

        <script>
            function myFunction() {
                var element = document.body;
                var theme = element.dataset.bsTheme == "light" ? "dark" : "light";
                element.dataset.bsTheme = theme;
                localStorage.setItem('theme', theme);

                // Changer la classe des boutons en fonction du thème
                var buttons = document.querySelectorAll('.btn-primary, .btn-success');
                buttons.forEach(function(button) {
                    if (theme == 'dark') {
                        button.classList.remove('btn-primary');
                        button.classList.add('btn-success');
                    } else {
                        button.classList.remove('btn-success');
                        button.classList.add('btn-primary');
                    }
                });
            }

            // Au chargement de la page, appliquer le thème stocké
            window.onload = function() {
                var theme = localStorage.getItem('theme');
                if (theme) {
                    document.body.dataset.bsTheme = theme;

                    // Changer la classe des boutons en fonction du thème
                    var buttons = document.querySelectorAll('.btn-primary, .btn-success');
                    buttons.forEach(function(button) {
                        if (theme == 'dark') {
                            button.classList.remove('btn-primary');
                            button.classList.add('btn-success');
                        } else {
                            button.classList.remove('btn-success');
                            button.classList.add('btn-primary');
                        }
                    });
                }
            }
        </script>