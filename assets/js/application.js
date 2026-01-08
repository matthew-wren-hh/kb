// Select the input and parent div elements
const searchBox = document.getElementById("searchBox");
const searchBoxParent = document.querySelector(".search-box");

// Add event listeners to monitor hover and focus/blur
searchBoxParent.addEventListener("mouseleave", () => {
    if (!searchBox.matches(":focus")) {
        searchBox.placeholder = "";
    }
});

searchBoxParent.addEventListener("mouseenter", () => {
    searchBox.placeholder = "Search...";
});

searchBox.addEventListener("blur", () => {
    if (!searchBoxParent.matches(":hover")) {
        searchBox.placeholder = "";
    }
});

searchBox.addEventListener("focus", () => {
    searchBox.placeholder = "Search...";
});

// Loading spinner for homepage and other
document.addEventListener("DOMContentLoaded", function() {
  function addPreloaderToEmbed(embedElement) {
    // Create the loading spinner container
    const loadingSpinner = document.createElement('div');
    loadingSpinner.className = 'load-container';

    // Create the spinner itself with its HTML structure
    loadingSpinner.innerHTML = `
      <div class="load-icon">
        <div></div>
        <div></div>
        <div></div>
      </div>
    `;

    // Append the loading spinner to the target div
    embedElement.appendChild(loadingSpinner);

    // Create a MutationObserver to detect changes in the mb-3 div
    const observer = new MutationObserver((mutationsList) => {
      mutationsList.forEach(mutation => {
        if (mutation.type === 'childList') {
          // Check if any new child nodes contain an image or any loaded content
          mutation.addedNodes.forEach(node => {
            if (node.nodeType === 1 && node.tagName !== 'SCRIPT') {
              // Remove the loading spinner if new content is loaded
              loadingSpinner.remove();
              observer.disconnect();  // Stop observing once the new content is loaded
            }
          });
        }
      });
    });

    // Configure the observer to watch for changes in the child elements of the target div
    observer.observe(embedElement, { childList: true, subtree: true });
  }
    
  document.querySelectorAll('.clive-cta-embeds').forEach(function(embedElement) {
    addPreloaderToEmbed(embedElement)
  });
});

!function ($) {
  $(function(){

    var $window = $(window);

    prettyPrint();

    // Recalculate navbar height on window load and resize
    function updateNavbarHeight() {
      const navbarHeight = $('.navbar').outerHeight(true) + 10; // Adds extra buffer to height of nav
      document.documentElement.style.setProperty('--scroll-margin-top', navbarHeight + 'px');
    }

    $(window).on('load resize', function() {
      updateNavbarHeight();
    });

    // Adjust scroll position on page load if there's a hash
    $(window).on('load', function() {
      if (window.location.hash) {
        const targetId = window.location.hash;
        const targetElement = $(targetId);
        if (targetElement.length) {
          const navbarHeight = $('.navbar').outerHeight(true) + 10;

          // Function to attempt scrolling when the element's position is available
          function attemptScroll() {
            const targetOffset = targetElement.offset();
            if (targetOffset && targetOffset.top) {
              $('html, body').scrollTop(targetOffset.top - navbarHeight);
            } else {
              // If the target position is not yet available, try again shortly
              setTimeout(attemptScroll, 100); // Adjust delay as needed
            }
          }

          // Start attempting to scroll
          attemptScroll();
        }
      }
    });

    // Handle anchor link clicks
    $('a[href^="#"]').on('click', function(event) {
      const targetId = $(this).attr('href');
      const targetElement = $(targetId);
      if (targetElement.length) {
        event.preventDefault();
        const navbarHeight = $('.navbar').outerHeight(true) + 10;
        $('html, body').animate({
          scrollTop: targetElement.offset().top - navbarHeight
        }, 500);
        // Update the URL hash without jumping
        history.pushState(null, null, targetId);
      }
    });

    // The rest of your script remains unchanged...

    // Check if there's a hash on load, if so try to activate a corresponding link in the sidenav.
    if (window.location.hash) {
      var releaseNavLink = $('a[href="'+window.location.hash+'"]', '.release-sidenav');
      if (releaseNavLink.length == 1) {
        releaseNavLink.parent('li').addClass("active");
      }
    }

    // Add a click event to the sidenav links to make them active.
    $('.release-sidenav').on('click', 'a', function(){
      $('li.active', '.release-sidenav').removeClass('active');
      $(this).parent('li').addClass('active');
    });
    
    $('#changelog-more').on('shown.bs.collapse', function () {
        $('#expand-changelog').parent().hide();
    });

    // Add event listener for copying the URL + href to clipboard
    document.querySelectorAll('.icon-anchor-link').forEach(icon => {
      icon.addEventListener('click', (e) => {
        e.preventDefault();
        const anchor = e.target.closest('a');
        const currentUrl = window.location.href.split('#')[0]; // Get the current page URL without the hash
        const fullUrl = `${currentUrl}${anchor.getAttribute('href')}`;
        navigator.clipboard.writeText(fullUrl).then(() => {
          icon.classList.remove('fa-regular', 'fa-copy');
          icon.classList.add('fa-solid', 'fa-copy');

          // Add wiggle animation
          icon.classList.add('wiggle');

          // Revert icon and remove wiggle after 3 seconds
          setTimeout(() => {
            icon.classList.remove('fa-solid', 'fa-copy');
            icon.classList.add('fa-regular', 'fa-copy');
            icon.classList.remove('wiggle');
          }, 3000);
        }).catch(err => {
          console.error('Failed to copy: ', err);
        });
      });
    });

    // Add tabindex and overflow:auto to all pre elements
    var preElements = document.querySelectorAll('pre');
    preElements.forEach(function(pre) {
        pre.setAttribute('tabindex', '0');
        pre.style.overflow = 'auto';
    });

  });
}(window.jQuery);

// Back to Top
if (!window.__backToTopInitialized) {
    window.__backToTopInitialized = true;
    document.addEventListener('DOMContentLoaded', function() {
        var btn = document.querySelector('.scroll-container');
        if (!btn) return;
        var threshold = 300;
        var update = function() {
            var isScrollable = document.documentElement.scrollHeight - window.innerHeight;
            var scrolled = window.scrollY - threshold;
            isScrollable ? (scrolled >= 0 ? btn.classList.add('is-visible') : btn.classList.remove('is-visible')) : btn.classList.remove('is-visible');
        };
        window.addEventListener('scroll', update, {passive: true});
        window.addEventListener('resize', update, {passive: true});
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            window.scrollTo({top: 0, behavior: 'smooth'});
        });
        update();
    });
}
// Temporary: Replace old "Back to Top ↑" text with just "↑" icon
// Remove this script once all pages have been published with the new macro
document.querySelectorAll('.top').forEach(function(btn) {
    btn.textContent = '↑';
});
