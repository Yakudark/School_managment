<nav aria-label="breadcrumb">
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