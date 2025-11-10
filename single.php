<?php get_header(); ?>
<div class="container mx-auto py-8 px-4 md:px-8 xl:px-25">
    <div class="grid grid-cols-1 xl:grid-cols-6 gap-4 md:gap-8">
      <!-- Main Content Area (4 columns out of 6) -->
      <main id="main" class="xl:col-span-4">
      <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        <article <?php post_class('w-full'); ?>>
          <header class="mb-8">
            <h1 class="!mb-4 text-3xl lg:text-4xl font-bold text-gray-900"><?php the_title(); ?></h1>
            <div class="text-sm text-gray-500 mb-4">
              <?php echo get_the_date(); ?> • By <?php the_author(); ?>
              <?php if (get_the_category()): ?>
                • In <?php the_category(', '); ?>
              <?php endif; ?>
            </div>
          </header>
          
          <div class="entry-content prose prose-slate max-w-none">
            <?php the_content(); ?>
          </div>
          
            <footer class="mt-8 pt-6 border-t border-gray-200">
              <!-- Author Bio Box -->
              <?php display_author_bio_box(); ?>
            </footer>
        </article>
      <?php endwhile; endif; ?>
    </main>
    
    <!-- Sidebar (2 columns out of 6) -->
    <aside id="sidebar" class="xl:col-span-2">
      <?php get_sidebar(); ?>
    </aside>
  </div>
</div>
<?php get_footer(); ?>
