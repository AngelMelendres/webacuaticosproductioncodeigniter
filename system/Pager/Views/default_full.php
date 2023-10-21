<?php

use CodeIgniter\Pager\PagerRenderer;

/**
 * @var PagerRenderer $pager
 */
$pager->setSurroundCount(2);
?>

<nav>
    <ul class="pagination justify-content-end">
        <?php if ($pager->hasPrevious()) : ?>
            <li class="page-item">
                <a class="page-link" href="<?php echo $pager->getFirst(); ?>" aria-label="Primera">
                    <span aria-hidden="true">&laquo;</span>
                    <span class="sr-only">Primera</span>
                </a>
            </li>
            <li class="page-item">
                <a class="page-link" href="<?php echo $pager->getPrevious(); ?>" aria-label="Anterior">
                    <span aria-hidden="true">&lsaquo;</span>
                    <span class="sr-only">Anterior</span>
                </a>
            </li>
        <?php endif ?>

        <?php foreach ($pager->links() as $link) : ?>
            <li class="page-item <?php echo $link['active'] ? 'active' : '' ?>">
                <a class="page-link" href="<?php echo $link['uri']; ?>"><?php echo $link['title']; ?></a>
            </li>
        <?php endforeach ?>

        <?php if ($pager->hasNext()) : ?>
            <li class="page-item">
                <a class="page-link" href="<?php echo $pager->getNext(); ?>" aria-label="Siguiente">
                    <span aria-hidden="true">&rsaquo;</span>
                    <span class="sr-only">Siguiente</span>
                </a>
            </li>
            <li class="page-item">
                <a class="page-link" href="<?php echo $pager->getLast(); ?>" aria-label="Última">
                    <span aria-hidden="true">&raquo;</span>
                    <span class="sr-only">Última</span>
                </a>
            </li>
        <?php endif ?>
    </ul>
</nav>
