<?php get_header(); ?>
<div class="container mx-auto py-8 px-4 md:px-8 xl:px-25">
  <!-- Container with responsive margins -->
  <div class="mx-auto px-4 md:px-8 xl:px-24">
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
          
          <?php if (get_the_tags()): ?>
            <footer class="mt-8 pt-6 border-t border-gray-200">
              <div class="flex flex-wrap gap-2">
                <span class="text-sm text-gray-600 font-medium">Tags:</span>
                <?php the_tags('<span class="inline-block px-3 py-1 bg-gray-100 text-gray-700 text-xs rounded-full">', '</span><span class="inline-block px-3 py-1 bg-gray-100 text-gray-700 text-xs rounded-full">', '</span>'); ?>
              </div>
            </footer>
          <?php endif; ?>
        </article>
        
        <!-- Navigation between posts -->
        <nav class="mt-8 flex justify-between">
          <div class="flex-1">
            <?php 
            $prev_post = get_previous_post();
            if ($prev_post): ?>
              <a href="<?php echo get_permalink($prev_post->ID); ?>" class="btn-secondary text-sm">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
                Previous Post
              </a>
            <?php endif; ?>
          </div>
          
          <div class="flex-1 text-right">
            <?php 
            $next_post = get_next_post();
            if ($next_post): ?>
              <a href="<?php echo get_permalink($next_post->ID); ?>" class="btn-secondary text-sm">
                Next Post
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
              </a>
            <?php endif; ?>
          </div>
        </nav>
      <?php endwhile; endif; ?>
    </main>
    
    <!-- Sidebar (2 columns out of 6) -->
    <aside id="sidebar" class="xl:col-span-2">
      <?php get_sidebar(); ?>
    </aside>
  </div>
</div>
<?php get_footer(); ?>
