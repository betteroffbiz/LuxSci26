<div class="space-y-8">
  <!-- WordPress Widget Area -->
  <?php if (is_active_sidebar('sidebar-1')) : ?>
    <div class="widget-area">
      <?php dynamic_sidebar('sidebar-1'); ?>
    </div>
  <?php endif; ?>

  <!-- Search Widget -->
  <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
    <h3 class="text-lg font-semibold mb-4">Search</h3>
    <form role="search" method="get" action="<?php echo home_url('/'); ?>">
      <div class="flex">
        <input type="search" name="s" placeholder="Search..." value="<?php echo get_search_query(); ?>" class="flex-1 px-3 py-2 border border-gray-300 rounded-l focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-r hover:bg-blue-700 transition-colors duration-200">
          Search
        </button>
      </div>
    </form>
  </div>

  <!-- Recent Posts Widget -->
  <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
    <h3 class="text-lg font-semibold mb-4">Recent Posts</h3>
    <ul class="space-y-3">
      <?php
      $recent_posts = wp_get_recent_posts(array(
        'numberposts' => 5,
        'post_status' => 'publish'
      ));
      foreach($recent_posts as $post_item): ?>
        <li>
          <a href="<?php echo get_permalink($post_item['ID']); ?>" class="text-blue-600 hover:text-blue-800 text-sm leading-relaxed no-underline">
            <?php echo $post_item['post_title']; ?>
          </a>
          <div class="text-xs text-gray-500 mt-1">
            <?php echo get_the_date('M j, Y', $post_item['ID']); ?>
          </div>
        </li>
      <?php endforeach; ?>
    </ul>
  </div>

  <!-- Categories Widget -->
  <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
    <h3 class="text-lg font-semibold mb-4">Categories</h3>
    <ul class="space-y-2">
      <?php
      $categories = get_categories(array(
        'orderby' => 'name',
        'order' => 'ASC'
      ));
      foreach($categories as $category): ?>
        <li>
          <a href="<?php echo get_category_link($category->term_id); ?>" class="text-blue-600 hover:text-blue-800 text-sm no-underline flex justify-between">
            <span><?php echo $category->name; ?></span>
            <span class="text-gray-500">(<?php echo $category->count; ?>)</span>
          </a>
        </li>
      <?php endforeach; ?>
    </ul>
  </div>

  <!-- Archives Widget -->
  <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
    <h3 class="text-lg font-semibold mb-4">Archives</h3>
    <ul class="space-y-2">
      <?php wp_get_archives(array(
        'type' => 'monthly',
        'limit' => 12,
        'format' => 'custom',
        'before' => '<li>',
        'after' => '</li>',
        'echo' => true
      )); ?>
    </ul>
  </div>

  <!-- About Widget (Filler Content) -->
  <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
    <h3 class="text-lg font-semibold mb-4">About This Blog</h3>
    <p class="text-gray-700 text-sm leading-relaxed mb-3">
      Welcome to our blog! We share insights, tutorials, and thoughts on various topics. 
      Stay tuned for regular updates and engaging content.
    </p>
    <p class="text-gray-700 text-sm leading-relaxed">
      Feel free to explore our categories and archives to find content that interests you.
    </p>
  </div>

  <!-- Tags Widget -->
  <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
    <h3 class="text-lg font-semibold mb-4">Popular Tags</h3>
    <div class="flex flex-wrap gap-2">
      <?php
      $tags = get_tags(array(
        'orderby' => 'count',
        'order' => 'DESC',
        'number' => 15
      ));
      foreach($tags as $tag): ?>
        <a href="<?php echo get_tag_link($tag->term_id); ?>" class="inline-block px-3 py-1 bg-gray-100 text-gray-700 text-xs rounded-full hover:bg-gray-200 transition-colors duration-200 no-underline">
          <?php echo $tag->name; ?>
        </a>
      <?php endforeach; ?>
    </div>
  </div>
</div>