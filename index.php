<?php get_header(); ?>
<div class="container mx-auto py-8 px-4 md:px-8 xl:px-25">
  <!-- Page Title -->
  <div class="mb-8">
    <h1 class="text-3xl md:text-4xl font-bold text-gray-900">
      <?php
      if (is_category()) {
        single_cat_title();
      } elseif (is_tag()) {
        single_tag_title();
      } elseif (is_author()) {
        echo 'Posts by ' . get_the_author();
      } elseif (is_date()) {
        echo 'Archive for ' . get_the_date('F Y');
      } else {
        echo 'Blog';
      }
      ?>
    </h1>
    <?php if (is_category() && category_description()) : ?>
      <div class="mt-2 text-gray-600">
        <?php echo category_description(); ?>
      </div>
    <?php endif; ?>
  </div>

  <div class="grid grid-cols-1 xl:grid-cols-4 gap-4 md:gap-8">
    <!-- Main Content Area (3 columns) -->
    <main id="main" class="xl:col-span-3">
      <?php if (have_posts()) : ?>
        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-4 md:gap-6">
          <?php while (have_posts()) : the_post(); ?>
            <article <?php post_class('bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden flex flex-col h-full'); ?>>
              <?php if (has_post_thumbnail()) : ?>
                <div class="aspect-video w-full overflow-hidden">
                  <?php the_post_thumbnail('grid-thumbnail', ['class' => 'w-full h-full object-cover']); ?>
                </div>
              <?php endif; ?>
              
              <div class="p-4 md:p-6 flex flex-col flex-1">
                <div class="text-sm text-gray-500 mb-2">
                  <?php echo get_the_date(); ?> • By <?php the_author(); ?>
                </div>
                
                <h2 class="text-xl font-semibold mb-3 leading-tight">
                  <a href="<?php the_permalink(); ?>" class="text-gray-900 hover:text-blue-600 no-underline">
                    <?php the_title(); ?>
                  </a>
                </h2>
                
                <div class="text-gray-700 mb-4 leading-relaxed flex-1">
                  <?php 
                  $excerpt = get_the_excerpt();
                  $title = get_the_title();
                  
                  // Calculate excerpt length based on title length
                  $title_length = strlen($title);
                  $base_excerpt_length = 300;
                  
                  // Adjust excerpt length inversely to title length
                  if ($title_length < 30) {
                    $max_excerpt_length = $base_excerpt_length + 100; // Longer excerpt for short titles
                  } elseif ($title_length < 50) {
                    $max_excerpt_length = $base_excerpt_length + 50;  // Medium excerpt
                  } elseif ($title_length < 70) {
                    $max_excerpt_length = $base_excerpt_length;       // Base excerpt
                  } else {
                    $max_excerpt_length = $base_excerpt_length - 50;  // Shorter excerpt for long titles
                  }
                  
                  if (strlen($excerpt) > $max_excerpt_length) {
                    $excerpt = substr($excerpt, 0, $max_excerpt_length);
                    // Find the last complete word
                    $last_space = strrpos($excerpt, ' ');
                    if ($last_space !== false) {
                      $excerpt = substr($excerpt, 0, $last_space);
                    }
                    $excerpt .= '...';
                  }
                  echo $excerpt;
                  ?>
                </div>
                
                <a href="<?php the_permalink(); ?>" class="btn-blog mt-auto">
                  Read More
                  <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                  </svg>
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
