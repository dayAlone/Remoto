(function() {
  var activeHighlights, checkColors, checkHash, checkNewsScroll, checkScroll, checkSizes, delay, end, goToHighlights, initHighlights, initImages, markers, moveHighlights, setActiveMarker, spinOptions;

  spinOptions = {
    lines: 13,
    length: 21,
    width: 2,
    radius: 24,
    corners: 0,
    rotate: 0,
    direction: 1,
    color: '#fd9127',
    speed: 1,
    trail: 68,
    shadow: false,
    hwaccel: false,
    className: 'spinner',
    zIndex: 2e9,
    top: '50%',
    left: '50%'
  };

  markers = [];

  delay = function(ms, func) {
    return setTimeout(func, ms);
  };

  this.getCaptcha = function() {
    return $.get('/include/captcha.php', function(data) {
      return setCaptcha(data);
    });
  };

  this.setCaptcha = function(code) {
    $('input[name=captcha_sid], input[name=captcha_code]').val(code);
    return $('.captcha').css('background-image', "url(/include/captcha.php?captcha_sid=" + code + ")");
  };

  end = 'transitionend webkitTransitionEnd oTransitionEnd otransitionend MSTransitionEnd';

  this.initMap = function() {
    var center, coords, map, mapElement, mapSettings, strictBounds, zoom;
    zoom = 3;
    center = new window.google.maps.LatLng(34.6917358, 32.9934606);
    if ($.browser.mobile) {
      zoom = 1;
      center = new window.google.maps.LatLng(43.2168818, 76.6639822);
    }
    mapSettings = {
      zoom: zoom,
      scrollwheel: false,
      mapTypeControl: false,
      streetViewControl: false,
      center: center,
      styles: [
        {
          'featureType': 'all',
          'elementType': 'labels.text.fill',
          'stylers': [
            {
              'saturation': 36
            }, {
              'color': '#000000'
            }, {
              'lightness': 40
            }
          ]
        }, {
          'featureType': 'all',
          'elementType': 'labels.text.stroke',
          'stylers': [
            {
              'visibility': 'on'
            }, {
              'color': '#000000'
            }, {
              'lightness': 16
            }
          ]
        }, {
          'featureType': 'all',
          'elementType': 'labels.icon',
          'stylers': [
            {
              'visibility': 'off'
            }
          ]
        }, {
          'featureType': 'administrative',
          'elementType': 'geometry.fill',
          'stylers': [
            {
              'color': '#000000'
            }, {
              'lightness': 20
            }
          ]
        }, {
          'featureType': 'administrative',
          'elementType': 'geometry.stroke',
          'stylers': [
            {
              'color': '#000000'
            }, {
              'lightness': 17
            }, {
              'weight': 1.2
            }
          ]
        }, {
          'featureType': 'landscape',
          'elementType': 'geometry',
          'stylers': [
            {
              'color': '#000000'
            }, {
              'lightness': 24
            }
          ]
        }, {
          'featureType': 'poi',
          'elementType': 'geometry',
          'stylers': [
            {
              'color': '#000000'
            }, {
              'lightness': 21
            }
          ]
        }, {
          'featureType': 'road.highway',
          'elementType': 'geometry.fill',
          'stylers': [
            {
              'color': '#000000'
            }, {
              'lightness': 17
            }
          ]
        }, {
          'featureType': 'road.highway',
          'elementType': 'geometry.stroke',
          'stylers': [
            {
              'color': '#000000'
            }, {
              'lightness': 29
            }, {
              'weight': 0.2
            }
          ]
        }, {
          'featureType': 'road.arterial',
          'elementType': 'geometry',
          'stylers': [
            {
              'color': '#000000'
            }, {
              'lightness': 18
            }
          ]
        }, {
          'featureType': 'road.local',
          'elementType': 'geometry',
          'stylers': [
            {
              'color': '#000000'
            }, {
              'lightness': 16
            }
          ]
        }, {
          'featureType': 'transit',
          'elementType': 'geometry',
          'stylers': [
            {
              'color': '#000000'
            }, {
              'lightness': 19
            }
          ]
        }, {
          'featureType': 'water',
          'elementType': 'geometry',
          'stylers': [
            {
              'color': '#000000'
            }, {
              'lightness': 17
            }
          ]
        }
      ]
    };
    mapElement = document.getElementById('map');
    map = new window.google.maps.Map(mapElement, mapSettings);
    strictBounds = new google.maps.LatLngBounds(new google.maps.LatLng(85, -180), new google.maps.LatLng(-85, 180));
    coords = $('.map').data('coords');
    coords.map(function(el, key) {
      var c, img, marker;
      c = el.coords;
      img = '/layout/images/point-orange.png';
      if ($(".list__item:nth-child(" + (key + 1) + ")").length === 0) {
        img = '/layout/images/point-gray.png';
      }
      marker = new google.maps.Marker({
        position: new google.maps.LatLng(c[0], c[1]),
        map: map,
        icon: {
          url: img,
          scaledSize: new google.maps.Size(18, 24)
        },
        title: el.name,
        clickable: $(".list__item:nth-child(" + (key + 1) + ")").length > 0
      });
      marker.addListener('click', function() {
        return setActiveMarker(key + 1);
      });
      return markers.push(marker);
    });
    google.maps.event.addListener(map, 'dragend', function() {
      var c, mapMaxY, mapMinY, maxY, minY, y;
      c = map.getCenter();
      y = c.lat();
      maxY = strictBounds.getSouthWest().lat();
      mapMaxY = map.getBounds().getSouthWest().lat();
      minY = strictBounds.getNorthEast().lat();
      mapMinY = map.getBounds().getNorthEast().lat();
      if (-1 * mapMinY < minY || -1 * mapMaxY > maxY) {
        return map.setCenter(mapSettings.center);
      }
    });
    return markers[0].setIcon({
      url: '/layout/images/point-white.png',
      scaledSize: new google.maps.Size(18, 24)
    });
  };

  setActiveMarker = function(index) {
    if ($(".list__item:nth-child(" + index + ")").length > 0) {
      $('.list__item').mod('active', false);
      $(".list__item:nth-child(" + index + ")").addClass('list__item--active');
      return markers.map(function(el, key) {
        var img;
        if (key === index - 1) {
          return el.setIcon({
            url: '/layout/images/point-white.png',
            scaledSize: new google.maps.Size(18, 24)
          });
        } else {
          img = '/layout/images/point-orange.png';
          if ($(".list__item:nth-child(" + (key + 1) + ")").length === 0) {
            img = '/layout/images/point-gray.png';
          }
          return el.setIcon({
            url: img,
            scaledSize: new google.maps.Size(18, 24)
          });
        }
      });
    }
  };

  checkScroll = function() {
    return $('.block').each(function(key, el) {
      if ($(el).offset().top <= $('body').scrollTop() && $(el).offset().top + $(el).height() >= $('body').scrollTop()) {
        $('.nav__item').mod('active', false);
        return $(".nav__item[href*='" + ($(el).attr('id')) + "']").addClass('nav__item--active');
      }
    });
  };

  checkNewsScroll = function(e) {
    var el;
    el = $(e.currentTarget).parents('.news');
    el.mod('start', el.find('.news__scroll').scrollTop() > 0);
    return el.mod('end', el.find('.news__wrap').outerHeight() <= $(e.currentTarget).scrollTop() + $(e.currentTarget).outerHeight());
  };

  moveHighlights = function(set, type) {
    var el, index, moveX;
    if (set == null) {
      set = true;
    }
    if (type == null) {
      type = 'highlights';
    }
    index = $("." + type + "__items").data('index');
    if (!index) {
      index = 0;
    }
    el = $("." + type + "__items > div:nth-child(" + (index + 1) + ")");
    moveX = $(window).width() * index;
    $("." + type + "__items").css({
      transform: "translateX(" + (-moveX) + "px)"
    });
    if (set) {
      window.location.hash = el.attr('id');
      $("." + type + " .nav__item").mod('active', false);
      $("." + type + " .nav__item:nth-child(" + (index + 1) + ")").addClass('nav__item--active');
      $('.toolbar__logo').mod('color', el.data('logo') === 'color');
      $('.toolbar__nav').toggleClass('nav--black', el.data('nav') === 'black');
      $('.toolbar__socials').toggleClass('toolbar__socials--black', el.data('nav') === 'black');
      if ($(window).width() >= 768) {
        $('.toolbar__trigger').mod('black', el.data('nav') === 'black');
      }
      return $("." + type + "__nav").mod('dark', el.data('nav') === 'black');
    }
  };

  initHighlights = function(type) {
    if (type == null) {
      type = 'highlights';
    }
    return function() {
      var width;
      width = $("." + type + "__items > div").length * $(window).width();
      $("." + type + "__items").width(width);
      return moveHighlights(false, type);
    };
  };

  goToHighlights = function(index, type) {
    if (type == null) {
      type = 'highlights';
    }
    $("." + type + "__items").data('index', index);
    return moveHighlights(true, type);
  };

  activeHighlights = function(type) {
    $('.' + type).mod('active', true);
    return initImages($('.' + type));
  };

  initImages = function(block) {
    return $.each(['pre-srcset', 'pre-src', 'pre-style'], function(key, attr) {
      return block.find("[" + attr + "]").each(function(key, el) {
        return $(el).attr(attr.replace('pre-', ''), $(el).attr(attr));
      });
    });
  };

  checkColors = function(next) {
    $('.toolbar__nav').toggleClass('nav--black', next.data('nav') === 'black');
    $('.toolbar__socials').toggleClass('toolbar__socials--black', next.data('nav') === 'black');
    if ($(window).width() >= 768) {
      $('.toolbar__trigger').mod('black', next.data('nav') === 'black');
    }
    $('.toolbar__logo').mod('color', next.data('logo') === 'color');
    return $('#pp-nav').toggleClass('black', next.data('dots') === 'black');
  };

  checkSizes = function() {
    $('.block').elem('video').find('video').each(function(key, el) {
      var p;
      $(el).removeAttr('style');
      if ($(el).height() + 30 < $(window).height()) {
        p = $(el).width() / $(el).height();
        return $(el).height($(window).height()).width($(window).height() * p);
      }
    });
    if ($.browser.mobile) {
      $('.block, .highlight, .mno').css({
        minHeight: $(window).height()
      });
    }
    if ($.browser.mobile) {
      $('.fotorama').data('fotorama').resize({
        width: $('.block__content').width()
      });
      return $('.map__block').width($(window).width());
    }
  };

  checkHash = function() {
    var hash;
    if (window.location.hash) {
      hash = window.location.hash;
      if (hash.length > 0) {
        if ($(hash).hasClass('block')) {
          if (typeof $.fn.pagepiling.moveTo === 'function') {
            $.fn.pagepiling.moveTo(hash.split('#')[1]);
          }
          $('.highlights').mod('active', false);
          $('.mnos').mod('active', false);
        }
        if ($(hash).hasClass('highlight')) {
          activeHighlights('highlights');
          goToHighlights($(hash).index(), 'highlights');
          if (typeof $.fn.pagepiling.moveTo === 'function') {
            $.fn.pagepiling.moveTo(3);
          }
        }
        if ($(hash).hasClass('mno')) {
          activeHighlights('mnos');
          goToHighlights($(hash).index(), 'mnos');
          if (typeof $.fn.pagepiling.moveTo === 'function') {
            return $.fn.pagepiling.moveTo(4);
          }
        }
      }
    }
  };

  $(document).ready(function() {
    var anchors;
    $('.modal').on('shown.bs.modal', function(e) {
      var text, url;
      getCaptcha();
      $('.form__action').show().removeClass('hidden');
      $('.form__success').hide().addClass('hidden');
      if ($(this).find('form').length > 0) {
        $(this).find('form')[0].reset();
      }
      text = $(this).find('.text');
      if ($(this).attr('id') === 'Detail') {
        text.html('');
        new Spinner(spinOptions).spin(text[0]);
      }
      url = $(e.relatedTarget).data('link');
      if (url) {
        return $.get(url, function(data) {
          return text.html(data);
        });
      }
    });
    $('.modal').on('hidden.bs.modal', function(e) {
      return $(this).find('.text').html('');
    });
    $.BEM = new $.BEM.constructor({
      namePattern: '[a-zA-Z0-9-]+',
      elemPrefix: '__',
      modPrefix: '--',
      modDlmtr: '--'
    });
    $('.news').each(function(key, el) {
      if ($(el).find('.news__wrap').height() > $(el).find('.news__scroll').height()) {
        return $(el).mod('ready', true);
      }
    });
    $('.news__scroll').on('scroll', _.throttle(checkNewsScroll, 300));
    anchors = [];
    $('.block').each(function(key, el) {
      return anchors.push($(el).attr('id'));
    });
    $('.toolbar__trigger').on('click', function(e) {
      $('body').toggleClass('open');
      return e.preventDefault();
    });
    $('.fotorama').on('fotorama:ready', function(e, fotorama) {
      if ($.browser.android) {
        fotorama.resize({
          width: $('.block__content').width()
        });
        return $('.map__block').width($(window).width());
      }
    });
    initHighlights('highlights')();
    initHighlights('mnos')();
    $(window).on('resize', _.throttle(initHighlights('highlights'), 300));
    $(window).on('resize', _.throttle(initHighlights('mnos'), 300));
    $(window).on('resize', _.throttle(checkSizes, 300));
    checkSizes();
    $('html').addClass($.browser.name + '-' + $.browser.versionNumber);
    $.getScript('https://maps.googleapis.com/maps/api/js?sensor=false&callback=initMap&language=en');
    if ($(window).width() > 600) {
      $('.toolbar__logo').on('click', function(e) {
        if (typeof $.fn.pagepiling.moveTo === 'function') {
          $.fn.pagepiling.moveTo('home');
        }
        $('.highlights').mod('active', false);
        $('.mnos').mod('active', false);
        return e.preventDefault();
      });
      $('.blocks').pagepiling({
        anchors: anchors,
        sectionSelector: '.block',
        verticalCentered: false,
        animateAnchor: false,
        afterRender: function() {
          return $(window).off('hashchange');
        },
        afterLoad: function(anchorLink, index) {
          var next;
          $(window).off('hashchange');
          checkHash();
          next = $(".block:nth-child(" + index + ")");
          return $('body').data('slide', next.attr('id'));
        },
        onLeave: function(index, nextIndex, direction) {
          var current, next;
          $(window).off('hashchange');
          next = $(".block:nth-child(" + nextIndex + ")");
          current = $(".block:nth-child(" + index + ")");
          $('body').data('slide', next.attr('id'));
          return delay(300, function() {
            if (!$('.highlights').hasMod('active')) {
              checkColors(next);
            }
            $('.toolbar .nav__item, .nav--modal .nav__item').mod('active', false);
            return $(".nav__item[href*='" + (next.attr('id')) + "']").addClass('nav__item--active');
          });
        }
      });
      $('.news__scroll').perfectScrollbar({
        suppressScrollX: true,
        includePadding: true
      });
    } else {
      $('body').on('scroll', _.throttle(checkScroll, 300));
      checkHash();
    }
    $('.highlight__link, .mno__link').on('click', function(e) {
      var index, type;
      type = 'highlights';
      if ($(this).parents('.mnos').length > 0) {
        type = 'mnos';
      }
      index = $(this).parents('.' + type.slice(0, type.length - 1)).index();
      if ($(this).hasMod('next')) {
        goToHighlights(index + 1, type);
      } else if ($(this).hasMod('prev')) {
        goToHighlights(index - 1, type);
      } else if ($(this).hasMod('back')) {
        $('.' + type).mod('active', false);
        $('.toolbar__nav').toggleClass('nav--black', false);
        $('.toolbar__socials').toggleClass('toolbar__socials--black', false);
        $('.toolbar__logo').mod('color', false);
      }
      return e.preventDefault();
    });
    $(".highlights .nav__item").on('click', function(e) {
      goToHighlights($(this).index(), 'highlights');
      return e.preventDefault();
    });
    $(".mnos .nav__item").on('click', function(e) {
      goToHighlights($(this).index(), 'mnos');
      return e.preventDefault();
    });
    $('a.features__item').on('click', function(e) {
      activeHighlights('highlights');
      goToHighlights($($(this).attr('href')).index(), 'highlights');
      return e.preventDefault();
    });
    $('.articles a').on('click', function(e) {
      var el;
      el = $($(this).attr('href'));
      if (el.hasClass('mno')) {
        activeHighlights('mnos');
        goToHighlights($($(this).attr('href')).index(), 'mnos');
        return e.preventDefault();
      }
    });
    $('.toolbar .nav__item, .nav--modal .nav__item').on('click', function(e) {
      if (typeof $.fn.pagepiling.moveTo === 'function') {
        $.fn.pagepiling.moveTo($(this).attr('href').split('#')[1]);
        checkColors($($(this).attr('href')));
        e.preventDefault();
      }
      $('body').removeClass('open');
      if ($('.highlights').hasMod('active')) {
        $('.highlights').mod('active', false);
      }
      if ($('.mnos').hasMod('active')) {
        return $('.mnos').mod('active', false);
      }
    });
    $('.list__title').click(function(e) {
      var index;
      index = $(this).parents('.list__item').index();
      setActiveMarker(index + 1);
      return e.preventDefault();
    });
    $('.button').click(function(e) {
      if ($($(this).attr('href')).hasClass('block')) {
        if (typeof $.fn.pagepiling.moveTo === 'function') {
          $.fn.pagepiling.moveTo($(this).attr('href').split('#')[1]);
          e.preventDefault();
        }
        checkColors($($(this).attr('href')));
        $('body').removeClass('open');
        if ($('.highlights').hasMod('active')) {
          $('.highlights').mod('active', false);
        }
        if ($('.mnos').hasMod('active')) {
          return $('.mnos').mod('active', false);
        }
      }
    });
    $('.tabs__item').on('click', function(e) {
      e.preventDefault();
      $('.block__col').addClass('hidden-xs');
      $('.tabs__item').mod('active', false);
      $(this).mod('active', true);
      return $($(this).attr('href')).removeClass('hidden-xs');
    });
    $('.form__refresh').click(function(e) {
      getCaptcha();
      return e.preventDefault();
    });
    $('.form').submit(function(e) {
      var request;
      e.preventDefault();
      request = $(this).serialize();
      return $.post('/include/send.php', request, function(data) {
        data = $.parseJSON(data);
        if (data.status === "ok") {
          $('.form__action').hide().addClass('hidden');
          $('.form__success').show().removeClass('hidden');
          return $('input[name="captcha_word"]').val('');
        } else if (data.status === "error") {
          $('input[name=captcha_word]').addClass('parsley-error');
          return getCaptcha();
        }
      });
    });
    $('.testimonials__slider').slick({
      speed: 500,
      cssEase: 'cubic-bezier(0.645, 0.045, 0.355, 1)',
      loop: true,
      nextArrow: '<div class="slick-next"></div>',
      prevArrow: '<div class="slick-prev"></div>',
      responsive: [
        {
          breakpoint: 2800,
          settings: {
            slidesToShow: 3
          }
        }, {
          breakpoint: 1170,
          settings: {
            slidesToShow: 2
          }
        }, {
          breakpoint: 767,
          settings: {
            slidesToShow: 1
          }
        }
      ]
    });
    $('.subscribe').submit(function(e) {
      var request;
      e.preventDefault();
      request = $(this).serialize();
      return $.post('/include/subscribe.php', request, function(data) {
        return $('.subscribe').mod('success', true);
      });
    });
    return History.Adapter.bind(window, 'hashchange anchorchange', function() {
      var hash, slide;
      hash = window.location.hash;
      slide = '#' + $('body').data('slide');
      if (hash === '' && typeof $.fn.pagepiling.moveTo === 'function') {
        $.fn.pagepiling.moveTo('home');
      }
      if (slide !== hash && $("" + hash).hasClass('block')) {
        return checkHash();
      } else if ($(hash).hasClass('highlight') || $(hash).hasClass('mno')) {
        return checkHash();
      } else if (slide === hash && ($('.highlights').hasMod('active') || $('.mnos').hasMod('active'))) {
        return checkHash();
      }
    });
  });

}).call(this);
