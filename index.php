<?php get_header(); ?>
<main id="main" class="container mx-auto px-4 py-8 prose prose-slate max-w-3xl">
  <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
    <article <?php post_class('mb-12'); ?>>
      <h1 class="!mb-2"><?php the_title(); ?></h1>
      <div class="entry-content"><?php the_content(); ?></div>
    </article>
  <?php endwhile; else: ?>
    <p>No posts found.</p>
  <?php endif; ?>
</main>
<?php get_footer(); ?>
