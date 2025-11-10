  <?php if (get_the_tags()): ?>
            <footer class="mt-8 pt-6 border-t border-gray-200">
              <div class="flex flex-wrap gap-2">
                <span class="text-sm text-gray-600 font-medium">Tags:</span>
                <?php the_tags('<span class="inline-block px-3 py-1 bg-gray-100 text-gray-700 text-xs rounded-full">', '</span><span class="inline-block px-3 py-1 bg-gray-100 text-gray-700 text-xs rounded-full">', '</span>'); ?>
              </div>
            </footer>
          <?php endif; ?>