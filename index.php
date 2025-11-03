<?php get_header(); ?>
<div class="container mx-auto px-4 py-8">
  <div class="grid grid-cols-1 xl:grid-cols-4 gap-8">
    <!-- Main Content Area (3 columns) -->
    <main id="main" class="xl:col-span-3">
      <?php if (have_posts()) : ?>
        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
          <?php while (have_posts()) : the_post(); ?>
            <article <?php post_class('bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden'); ?>>
              <?php if (has_post_thumbnail()) : ?>
                <div class="aspect-video w-full overflow-hidden">
                  <?php the_post_thumbnail('grid-thumbnail', ['class' => 'w-full h-full object-cover']); ?>
                </div>
              <?php endif; ?>
              
              <div class="p-6">
                <div class="text-sm text-gray-500 mb-2">
                  <?php echo get_the_date(); ?> • By <?php the_author(); ?>
                </div>
                
                <h2 class="text-xl font-semibold mb-3 leading-tight">
                  <a href="<?php the_permalink(); ?>" class="text-gray-900 hover:text-blue-600 no-underline">
                    <?php the_title(); ?>
                  </a>
                </h2>
                
                <div class="text-gray-700 mb-4 leading-relaxed">
                  <?php the_excerpt(); ?>
                </div>
                
                <a href="<?php the_permalink(); ?>" class="inline-block bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition-colors duration-200 text-sm font-medium no-underline">
                  Read More
                </a>
              </div>
            </article>
          <?php endwhile; ?>
        </div>
      <?php else: ?>
        <div class="text-center py-12">
          <p class="text-gray-500 text-lg">No posts found.</p>
        </div>
      <?php endif; ?>
    </main>
    
    <!-- Sidebar (1 column) -->
    <aside id="sidebar" class="xl:col-span-1">
      <?php get_sidebar(); ?>
    </aside>
  </div>
</div>
<?php get_footer(); ?>
