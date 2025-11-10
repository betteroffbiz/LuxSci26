<div class="space-y-6 md:space-y-8 sidebar">
  <!-- Contact Form -->
  <div class="rounded-lg shadow-sm border border-gray-200 p-4 md:p-6 contact-form-widget" style="background-color: #f8f9fa;">
    <h3 class="text-lg font-semibold mb-2 text-gray-900">Get in touch</h3>
    <div class="mb-4">
      <blockquote class="text-gray-600 text-sm mb-2">Find The Best Solution For Your Organization</blockquote>
      <blockquote class="text-gray-600 text-sm">Talk To An Expert & Get A Quote</blockquote>
    </div>

    <META HTTP-EQUIV="Content-type" CONTENT="text/html; charset=UTF-8">
    <script src="https://www.google.com/recaptcha/api.js"></script>
    <script>
        function timestamp() { 
            var response = document.getElementById("g-recaptcha-response"); 
            if (response == null || response.value.trim() == "") {
                var elems = JSON.parse(document.getElementsByName("captcha_settings")[0].value);
                elems["ts"] = JSON.stringify(new Date().getTime());
                document.getElementsByName("captcha_settings")[0].value = JSON.stringify(elems); 
            } 
        } 
        setInterval(timestamp, 500);

        // Validation des champs obligatoires
        function validateForm() {
            var firstName = document.getElementById("first_name").value.trim();
            var lastName = document.getElementById("last_name").value.trim();
            var company = document.getElementById("company").value.trim();
            var email = document.getElementById("email").value.trim();

            if (!firstName || !lastName || !email || !company) {
                alert("Please complete all required fields.");
                return false; // Empêche l'envoi du formulaire
            }
            return true; // Permet l'envoi si tous les champs sont remplis
        }
    </script>

    <form action="https://webto.salesforce.com/servlet/servlet.WebToLead?encoding=UTF-8&orgId=00DHr000003Yktv" method="POST" onsubmit="return validateForm();">

<input type="hidden" name='captcha_settings' value='{"keyname":"web_to_lead","fallback":"true","orgId":"00DHr000003Yktv","ts":""}'>
<input type="hidden" name="oid" value="00DHr000003Yktv">
<input type="hidden" name="retURL" value="https://luxsci.com/thank-you/">

<div class="containerr pilar-container">
    <div class="column pilar-edit-input">
      <input id="first_name" maxlength="40" name="first_name" size="20" type="text" placeholder="First name*" required />
    </div>
    <div class="column pilar-edit-input">
      <input id="last_name" maxlength="80" name="last_name" size="20" type="text" placeholder="Last name*" required /><br>
    </div>
 </div>
  
<input  id="email" maxlength="80" name="email" size="20" type="text" placeholder="Work Email*" required />

<input  id="company" maxlength="80" name="company" size="20" type="text" placeholder="Company*" required />

<div class="email-opt-in" style="font-size: 14px; align-items: flex-start;">
  <div class="checkbox-column" style="padding-right:2%;">
    <input style="width:15px; height:15px;"  id="00NPY000002QU4X" name="00NPY000002QU4X" type="checkbox" value="1" required />
  </div>
  <div class="text-column">
    I consent to be contacted by LuxSci for this inquiry and other relevant content, products, and services. You may unsubscribe from these communications at any time. We're committed to your privacy. For more information, check out our Privacy Policy.
  </div>
</div>
</br>

<div class="g-recaptcha" data-sitekey="6LcSUvgpAAAAAEdFphKDLT6VvoD7XEVSgyq96Q2_"></div><br>

<input type="submit" name="submit" class="submitbutton" value="Submit" style="background-color: #109dce; color: white; font-weight: bold;">

</form>

    <p class="text-sm text-gray-600 mt-3">A member of our staff will reach out to you</p>
  </div>

  <!-- Search Widget -->
  <!-- <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-4 md:p-6">
    <h3 class="text-lg font-semibold mb-4">Search</h3>
    <form role="search" method="get" action="<?php echo home_url('/'); ?>">
      <div class="flex">
        <input type="search" name="s" placeholder="Search..." value="<?php echo get_search_query(); ?>" class="flex-1 px-3 py-2 border border-gray-300 rounded-l focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm">
        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-r hover:bg-blue-700 transition-colors duration-200">
          Search
        </button>
      </div>
    </form>
  </div> -->

  <!-- Categories Widget -->
  <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-4 md:p-6">
    <h3 class="text-lg font-semibold mb-4">Category</h3>
    <ul class="space-y-2">
      <?php
      $categories = get_categories(array(
        'orderby' => 'name',
        'order' => 'ASC'
      ));
      foreach($categories as $category): ?>
        <li>
          <a href="<?php echo get_category_link($category->term_id); ?>" class="hover:text-blue-800 text-sm no-underline flex justify-between" style="color: rgb(23, 44, 76);">
            <span><?php echo $category->name; ?></span>
            <span class="text-gray-500">(<?php echo $category->count; ?>)</span>
          </a>
        </li>
      <?php endforeach; ?>
    </ul>
  </div>

  <!-- Recent Posts Widget -->
  <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-4 md:p-6">
    <h3 class="text-lg font-semibold mb-4">Recent Posts</h3>
    <ul class="space-y-3">
      <?php
      $recent_posts = wp_get_recent_posts(array(
        'numberposts' => 6,
        'post_status' => 'publish'
      ));
      foreach($recent_posts as $post_item): ?>
        <li>
          <a href="<?php echo get_permalink($post_item['ID']); ?>" class="hover:text-blue-800 text-sm leading-relaxed no-underline block" style="color: rgb(23, 44, 76);">
            <?php echo $post_item['post_title']; ?>
          </a>
        </li>
      <?php endforeach; ?>
    </ul>
  </div>

  <!-- Lead Magnet Widget -->
  <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-4 md:p-6" style="background-color: #f8f9fa;">
    <h3 class="text-lg font-semibold mb-4">Get Your Free E-Book!</h3>
    <p class="text-sm text-gray-700 mb-4">LuxSci High Email Deliverability Best Practices Paper</p>
    <img src="/wp-content/uploads/2025/05/achieving-high-email-deliverability-in-healthcare-blog.png" alt="High Email Deliverability Best Practices" class="w-full rounded mb-4">
    <h4 class="font-medium text-sm mb-3">What you'll learn:</h4>
    <ul class="text-sm text-gray-600 space-y-2 mb-4 list-none">
      <li class="flex items-start">
      <svg class="w-4 h-4 mt-0.5 mr-2 flex-shrink-0" style="color: #6ec1e3;" fill="currentColor" viewBox="0 0 20 20">
      <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
      </svg>
      How to optimize email performance
      </li>
      <li class="flex items-start">
      <svg class="w-4 h-4 mt-0.5 mr-2 flex-shrink-0" style="color: #6ec1e3;" fill="currentColor" viewBox="0 0 20 20">
      <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
      </svg>
      Key strategies to increase email deliverability rates
      </li>
      <li class="flex items-start">
      <svg class="w-4 h-4 mt-0.5 mr-2 flex-shrink-0" style="color: #6ec1e3;" fill="currentColor" viewBox="0 0 20 20">
      <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
      </svg>
      How email deliverability impacts marketing ROI
      </li>
    </ul>
    <h4 class="font-medium text-sm mb-3">Enter your email to download now!</h4>
    <form class="space-y-3">
      <input type="text" placeholder="First name" class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm">
      <input type="text" placeholder="Last name" class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm">
      <input type="email" placeholder="Your email" class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm">
      <button type="submit" class="w-full text-white px-4 py-2 rounded transition-colors duration-200 text-sm font-bold" style="background-color: #109dce;">Download Now</button>
    </form>
    <p class="text-xs text-gray-500 mt-2">We respect your privacy. No spam, ever.</p>
  </div>
</div>