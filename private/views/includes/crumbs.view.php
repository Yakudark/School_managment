<nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
  <ol class="breadcrumb justify-content-center">
    <?php if (isset($crumbs)) : ?>
      <?php foreach ($crumbs as $index => $crumb) : ?>
        <li class="breadcrumb-item <?= $index === count($crumbs) - 1 ? 'active' : '' ?>">
          <?php if ($index === count($crumbs) - 1) : ?>
            <?= $crumb[0] ?>
          <?php else : ?>
            <a href="<?= $crumb[1] ?>"><?= $crumb[0] ?></a>
          <?php endif; ?>
        </li>
      <?php endforeach; ?>
    <?php endif; ?>
  </ol>
</nav>