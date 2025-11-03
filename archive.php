<?php get_header(); ?>
<main id="main" class="container mx-auto px-4 py-8 prose prose-slate max-w-3xl">
  <h1 class="!mb-6"><?php the_archive_title(); ?></h1>
  <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
    <article <?php post_class('mb-8'); ?>>
      <h2 class="!mb-1"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
      <div class="text-sm text-slate-500 mb-2"><?php the_time(get_option('date_format')); ?></div>
      <div class="entry-summary"><?php the_excerpt(); ?></div>
    </article>
  <?php endwhile; the_posts_pagination(); else: ?>
    <p>No posts found.</p>
  <?php endif; ?>
</main>
<?php get_footer(); ?>
