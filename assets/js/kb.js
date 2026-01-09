(function() {
  "use strict";

  function fallbackCopyText(text) {
    return new Promise(function(resolve, reject) {
      try {
        var textarea = document.createElement("textarea");
        textarea.value = text;
        textarea.setAttribute("readonly", "");
        textarea.style.position = "absolute";
        textarea.style.left = "-9999px";
        document.body.appendChild(textarea);
        textarea.select();
        var successful = document.execCommand("copy");
        document.body.removeChild(textarea);
        if (successful) {
          resolve();
        } else {
          reject(new Error("Copy failed"));
        }
      } catch (error) {
        reject(error);
      }
    });
  }

  function copyText(text) {
    if (navigator.clipboard && window.isSecureContext) {
      return navigator.clipboard.writeText(text);
    }
    return fallbackCopyText(text);
  }

  function flashCopied(element) {
    element.classList.add("is-copied");
    window.setTimeout(function() {
      element.classList.remove("is-copied");
    }, 1500);
  }

  function handleAnchorCopy() {
    document.querySelectorAll(".icon-anchor-link").forEach(function(icon) {
      var anchor = icon.closest("a");
      if (!anchor) {
        return;
      }
      icon.addEventListener("click", function(event) {
        event.preventDefault();
        event.stopPropagation();
        var currentUrl = window.location.href.split("#")[0];
        var href = anchor.getAttribute("href") || "";
        var fullUrl = currentUrl + href;
        copyText(fullUrl)
          .then(function() {
            flashCopied(icon);
          })
          .catch(function() {
            flashCopied(icon);
          });
      });
    });
  }

  function handleCodeCopy() {
    document.querySelectorAll("pre > button.btn-copy").forEach(function(button) {
      button.addEventListener("click", function(event) {
        event.preventDefault();
        var code = button.parentElement ? button.parentElement.querySelector("code") : null;
        if (!code) {
          return;
        }
        copyText(code.textContent || "")
          .then(function() {
            flashCopied(button);
          })
          .catch(function() {
            flashCopied(button);
          });
      });
    });
  }

  window.copyLinkToClipboard = function(anchorId) {
    var currentUrl = window.location.href.split("#")[0];
    var fullUrl = currentUrl + "#" + anchorId;
    copyText(fullUrl);
  };

  document.addEventListener("DOMContentLoaded", function() {
    handleAnchorCopy();
    handleCodeCopy();
    document.querySelectorAll("pre").forEach(function(pre) {
      pre.setAttribute("tabindex", "0");
    });

    var sideNav = document.querySelector(".side-nav");
    if (sideNav && window.matchMedia) {
      var mq = window.matchMedia("(min-width: 1101px)");
      var syncSideNav = function(event) {
        if (event.matches) {
          sideNav.setAttribute("open", "");
        } else {
          sideNav.removeAttribute("open");
        }
      };

      syncSideNav(mq);
      if (typeof mq.addEventListener === "function") {
        mq.addEventListener("change", syncSideNav);
      } else if (typeof mq.addListener === "function") {
        mq.addListener(syncSideNav);
      }
    }

    if (sideNav) {
      var triggerPairs = [];
      sideNav.querySelectorAll('[data-toggle="collapse"]').forEach(function(trigger) {
        var href = trigger.getAttribute("href") || "";
        if (!href || href.charAt(0) !== "#") {
          return;
        }
        var target = sideNav.querySelector(href);
        if (!target) {
          return;
        }
        trigger.setAttribute("aria-controls", href.slice(1));
        trigger.setAttribute("aria-expanded", target.classList.contains("show") ? "true" : "false");
        triggerPairs.push({ trigger: trigger, target: target });
      });

      var setVisibility = function(pair, isOpen) {
        pair.target.classList.toggle("show", isOpen);
        pair.target.style.maxHeight = isOpen ? pair.target.scrollHeight + "px" : "0px";
        pair.trigger.setAttribute("aria-expanded", isOpen ? "true" : "false");
      };

      var closeAll = function(exceptTarget) {
        triggerPairs.forEach(function(pair) {
          var shouldOpen = pair.target === exceptTarget;
          setVisibility(pair, shouldOpen);
        });
      };

      closeAll(null);

      triggerPairs.forEach(function(pair) {
        pair.trigger.addEventListener("click", function(event) {
          event.preventDefault();
          var isOpen = pair.target.classList.contains("show");
          closeAll(isOpen ? null : pair.target);
        });
      });
    }
  });
})();
