$(function () {
    var siteURL = $("#page").attr("data-url"),
      body = $("body"),
      container = $("#popCont"),
      //pCont = document.querySelector("#partnerships"),
      hash = window.location.hash.substring(1);
    vh();
  
    let isCompleted = false;
    let isCompletedRef = false;
    function vh() {
      let vh = window.innerHeight * 0.01;
      document.documentElement.style.setProperty("--vh", `${vh}px`);
    }
  
    setTimeout(function () {
      vh();
      body.addClass("loaded");
    }, 1000);
  
    setTimeout(function () {
      if (window.location.hash) {
        $("." + hash + "Title").click();
      } else {
        window.scrollTo(0, 0);
       $(".AboutTitle").click();
      }
    }, 1000);
  

  
    // $("#mainMenu").click(function () {
    //   body.toggleClass("menuActive");
    // });
  
    $(".heading").click(function () {
      if ($(this).hasClass("active")) {
        $(this).removeClass("active");
        $(this).siblings(".container").removeClass("open").slideUp();
      } else {
        $(".heading").removeClass("active");
        $(".container").removeClass("open").slideUp();
        $(this).addClass("active");
        $(this).siblings(".container").addClass("open").slideDown();
      }
    });

  
    body.on("click", ".post-link", function () {
      var self = $(this),
        postID = self.attr("rel"),
        url = self.data("url");
      if (!self.hasClass("button")) {
        container.empty();
      }
  
      $.ajax({
        method: "get",
        url: site["ajaxurl"],
        data: {
          action: "load-single-post",
          pID: postID,
        },
        success: function (response) {
          container.html(response);
          body.addClass("popActive");
          container.addClass("open");
          container.find(".team-part").fadeIn();
          history.pushState("", "", url);
          $(".closeBut").on("click", function () {
            closePop();
            history.pushState("", "", siteURL);
          });
        },
      });
    });
  
    $(".closeBut").on("click", function () {
      closePop();
    });
    function closePop() {
      if (body.hasClass("single")) {
        window.location.href = siteURL;
      } else {
        container.find(".team-part").fadeOut();
        container.removeClass("open");
        body.removeClass("popActive");
        setTimeout(function () {
          container.empty();
        }, 800);
      }
    }
  
    if ($(window).width() < 2000) {
       mobPartnerCirc();
     } else {
       partnerCirc();
     }
    
     $(window).on('resize', function() {
       if ($(window).width() < 2000) {
         mobPartnerCirc();
         } else {
           partnerCirc();
       }
     });
  
     function partnerCirc() {
      // Draw the layout
      const draw = (container) => {
        const wrapper =
          typeof container === "object"
            ? container
            : document.querySelector(container || "#chart");
        if (!wrapper) return;
  
        // Clear previous content
        wrapper.innerHTML = "";
  
        // Set width & height of svg & masonry
        // Modify this to change the dimensions
        const width = window.innerWidth;
         const height = Math.max(window.innerHeight, width);
  
         const dim = Math.min(width, height);
  
    //      Generate packing function
        const pack = (data) => {
          return d3
            .pack()
            .size([width - 1, height - 1])
            .padding(0)(d3.hierarchy({ children: data }).sum((d) => d.value));
        };
  
        // Create root element
       const root = pack(data);
  
         // Create svg node
        const svg = d3
          .create("svg")
          .attr("viewBox", [0, 0, width, height])
          .attr("width", width)
          .attr("height", height)
          .attr("font-family", "'NeueHaasGroteskDisp Pro Md', sans-serif")
          .attr("text-anchor", "middle");
       // Create individual nodes
        const leaf = svg
          .selectAll("g")
          .data(root.leaves())
          .join("g")
          .attr("transform", (d) => `translate(${d.x + 1},${d.y + 1})`);
  
         // Add links
        leaf
          .append("circle")
          .attr("data-url", (d) => d.data.url)
          .attr("rel", (d) => d.data.rel)
          .attr("class", "post-link")
          .attr("id", (d) => Math.random())
          .attr("r", (d) => d.r)
          .attr("fill-opacity", 1)
          .attr("fill", (d) => "black");
  
        // Adding label
       leaf
          .append("text")
          .attr("clip-path", (d) => 0)
          .selectAll("tspan")
          .data((d) => [d.data.name])
          .join("tspan")
          .attr("x", 0)
          .attr("y", (d, i, nodes) => `${i - nodes.length / 2 + 0.8}em`)
          .text((d) => d)
          .attr("fill", "white");
  
         // Appending svg
        wrapper.appendChild(svg.node());
      };
  

    }
  });
  

const myDarkMode = {
  init() {
    this.changeListener();
    this.tabindexListener();
  },

  /**
   * Change listener for dark mode toggle
   */
  changeListener() {
    const $darkToggles = document.querySelectorAll('.dark-toggle input[type="checkbox"]');
    if ($darkToggles.length <= 0) { return; }

    $darkToggles.forEach(($t) => {
      $t.addEventListener('change', (e) => {
        this.toggle(e.currentTarget.checked);
      });
    });
  },

  /**
   * Keyboard listener for dark mode toggle
   */
  tabindexListener() {
    const $darkSwitches = document.querySelectorAll('.dark-toggle__switch');

    $darkSwitches.forEach(($s) => {
      $s.addEventListener('keyup', (e) => {
        if (e.key === 'Enter' || e.keyCode === 13) {
          const $checkbox = e.currentTarget.closest('.dark-toggle').querySelector('input[type="checkbox"]');
          $checkbox.checked = !$checkbox.checked;
          this.toggle($checkbox.checked);
        }
      });
    });
  },

  /**
   * Toggle the html class and cache the variable
   */
  toggle(isChecked) {
    document.querySelector('body').classList.toggle('is-dark', isChecked);
    localStorage.setItem('darkMode', isChecked);
  },
};

document.addEventListener('DOMContentLoaded', () => {
  myDarkMode.init();
});

/**
 * Smooth Scroll to Top
 */
var scrollAnimation; // Declare the scrollAnimation variable globally

function scrollToTop() {
  var position =
      document.body.scrollTop || document.documentElement.scrollTop;
  if (position) {
      window.scrollBy(0, -Math.max(1, Math.floor(position / 10)));
      scrollAnimation = setTimeout("scrollToTop()", 30);
  } else clearTimeout(scrollAnimation);
}

/* Video edit */

const popupVideoContainers = document.querySelectorAll('.popup-video');

popupVideoContainers.forEach(container => {
  const videoThumbnail = container.previousElementSibling.querySelector('.video img');
  const videoElement = container.querySelectorAll('video');

  videoThumbnail.onclick = () => {
    videoElement.src = videoThumbnail.getAttribute('src');
    container.style.display = 'block';

    videoElement.addEventListener('error', () => {
      // Handle video loading errors here
      console.error('Failed to load the video:', videoElement.src);
      // You can display an error message or provide alternative content
    });

    videoElement.play()
      .catch(error => {
        // Handle the error if the video fails to play
        console.error('Failed to play the video:', error);
      });
  };
});

const popupVideoClose = document.querySelectorAll('.popup-video span');
popupVideoClose.forEach(closeButton => {
  closeButton.onclick = () => {
    const popupVideo = closeButton.parentNode;
    popupVideo.style.display = 'none';

    const videoElement = popupVideo.querySelector('video');
    videoElement.pause();
  };
});



/*
 * Menu and Hamburger  
 */

const hamburger = document.querySelector('.header-container .nav-bar .nav-list .hamburger');
const mobile_menu = document.querySelector('.header-container .nav-bar .nav-list ul');
const menu_item = document.querySelectorAll('.header-container .nav-bar .nav-list ul li a');
const header = document.querySelector('.header-container');

hamburger.addEventListener('click', () => {
    hamburger.classList.toggle('active');
    mobile_menu.classList.toggle('active');
});

menu_item.forEach((item) => {
    item.addEventListener('click', () => {
        hamburger.classList.toggle('active');
        mobile_menu.classList.toggle('active');
    });
});

/** 
 * Smooth Scroll
 */

document.querySelectorAll('a[href^="#"]').forEach(anchor => {
  anchor.addEventListener('click', function (e) {
      e.preventDefault();

      document.querySelector(this.getAttribute('href')).scrollIntoView({
          behavior: 'smooth'
      });
  });
});

var lastScrollTop; 

navbar = document.getElementById('navbar');

window.addEventListener('scroll', function(){
  var scrollTop = window.pageXOffset || document.documentElement.scrollTop;

  if(scrollTop > lastScrollTop){
    navbar.style.marginTop ='-15vh';
  }
  else{
    navbar.style.marginTop="0"
  }
  
  lastScrollTop = scrollTop
})


var scrollToTopBtn = document.querySelector('.scrollToTopBtn');
var rootElement = document.documentElement;

function handleScroll() {
  var scrollTotal = rootElement.scrollHeight - rootElement.clientHeight;
  if ((rootElement.scrollTop / scrollTotal) > 0.20) {
    scrollToTopBtn.classList.add("showButton");
  } else {
    scrollToTopBtn.classList.remove("showButton");
  }
}

document.addEventListener("scroll", handleScroll);

function scrollToTop() {
  rootElement.scrollTo({
    top: 0,
    behavior: "smooth"
  });
}

scrollToTopBtn.addEventListener("click", scrollToTop);
document.addEventListener("scroll", handleScroll);
/** fade-in */

const scrollElements = document.querySelectorAll(".js-scroll");

const elementInView = (el, dividend = 1) => {
  const elementTop = el.getBoundingClientRect().top;

  return (
    elementTop <=
    (window.innerHeight || document.documentElement.clientHeight) / dividend
  );
};

const elementOutofView = (el) => {
  const elementTop = el.getBoundingClientRect().top;

  return (
    elementTop > (window.innerHeight || document.documentElement.clientHeight)
  );
};

const displayScrollElement = (element) => {
  element.classList.add("scrolled");
};

const hideScrollElement = (element) => {
  element.classList.remove("scrolled");
};

const handleScrollAnimation = () => {
  scrollElements.forEach((el) => {
    if (elementInView(el, 1.25)) {
      displayScrollElement(el);
    } else if (elementOutofView(el)) {
      hideScrollElement(el)
    }
  });
};

window.addEventListener("scroll", () => { 
  handleScrollAnimation();
});

// Accessibility for deaf blind people

var tsw_demo_font_is_large = false;

function tsw_demo_change_font_size() {
  var demo_paragraph = document.getElementById('demo');
  if (!tsw_demo_font_is_large) {
    demo_paragraph.style.fontSize = "150%";
    tsw_demo_font_is_large = true;
  } else {
    demo_paragraph.style.fontSize = "100%";
    tsw_demo_font_is_large = false;
  }
}
