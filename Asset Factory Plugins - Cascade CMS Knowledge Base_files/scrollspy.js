document.addEventListener('DOMContentLoaded', function() {
  // Check if the page has an h1 with the text "Velocity Tools" or "Frequently Asked Questions"
  var h1Text = document.querySelector('h1') ? document.querySelector('h1').textContent.trim() : '';
  if (h1Text === 'Velocity Tools' || h1Text === 'Frequently Asked Questions' || 'REST API') {
    return; // Do not execute the script if either condition is met
  }

  var sections = document.querySelectorAll('h2');
  var navLinks = document.querySelectorAll('.list-group a');
  var offset = -48;

  function escapeId(id) {
    return CSS.escape(id.substring(1));
  }

  navLinks.forEach(function(navLink) {
    navLink.addEventListener('click', function(event) {
      var href = navLink.getAttribute('href');
      var url = new URL(href, window.location.href);
      var targetId = url.hash; // Extract the fragment

      // Check if the fragment is not empty
      if (targetId) {
        event.preventDefault();
        var targetElement = document.querySelector(targetId);

        if (targetElement) {
          var targetPosition = targetElement.offsetTop - offset;
          window.scrollTo({
            top: targetPosition,
            behavior: 'smooth'
          });
        } else {
          // If the target element is not found on the current page, navigate to the full URL
          window.location.href = href;
        }
      } else {
        // For links without a fragment, navigate to the full URL
        window.location.href = href;
      }
    });
  });

  window.addEventListener('scroll', function() {
    var scrollPosition = document.documentElement.scrollTop || document.body.scrollTop;

    sections.forEach(function(section, index) {
      if (scrollPosition >= section.offsetTop - offset && scrollPosition < section.offsetTop + section.offsetHeight - offset) {
        navLinks.forEach(function(navLink) {
          navLink.classList.remove('active');
        });

        if (navLinks[index]) {
          navLinks[index].classList.add('active');
        }
      }
    });
  });
});
