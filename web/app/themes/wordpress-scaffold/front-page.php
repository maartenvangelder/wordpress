<?php

use Verthe\Utils;
use Verthe\Templates;
use Verthe\PostTypes\Example;
use Verthe\Acf\FlexibleContent;

$examples = (new Example)->get_posts(10);

?>
<article>
    <div>
        <?php Utils\partial('partials/partial', [
            'foo' => 'Hello',
            'bar' => 'Worldpress',
        ]); ?>
    </div>
    <header>
        <h1><?php bloginfo() ?></h1>
        <?= Utils\svg('arrow'); ?>
    </header>
    <section>
        <?php foreach ($examples as $post): setup_postdata($post);
            get_template_part('templates/partials/example-preview');
        endforeach; wp_reset_postdata(); ?>
    </section>
    <section>
        <?php try {
            (new FlexibleContent\Blocks)->render();
        } catch(\Exception $e) { /**/ } ?>
    </section>
</article>
