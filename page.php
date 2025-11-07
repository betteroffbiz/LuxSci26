<?php get_header(); ?>
<main id="main" class="container mx-auto py-8 prose prose-slate max-w-3xl px-4 md:px-8 xl:px-25">
  <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
    <article <?php post_class('mb-12'); ?>>
      <h1 class="!mb-2"><?php the_title(); ?></h1>
      <div class="entry-content"><?php the_content(); ?></div>
    </article>
  <?php endwhile; endif; ?>
</main>
<?php get_footer(); ?>
