(function() {
  var checkNewsScroll, checkScroll, delay, end, goToHighlights, initHighlights, markers, moveHighlights, setActiveMarker, spinOptions;

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
    var coords, map, mapElement, mapSettings;
    console.log('initMap');
    mapSettings = {
      zoom: 3,
      scrollwheel: false,
      mapTypeControl: false,
      streetViewControl: false,
      center: new window.google.maps.LatLng(34.6917358, 32.9934606),
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
              'lightness': 20
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
    coords = $('.map').data('coords');
    coords.map(function(el, key) {
      var c, marker;
      c = el.coords;
      marker = new google.maps.Marker({
        position: new google.maps.LatLng(c[0], c[1]),
        map: map,
        icon: {
          url: '/layout/images/point-orange.png',
          scaledSize: new google.maps.Size(18, 24)
        },
        title: el.name
      });
      marker.addListener('click', function() {
        return setActiveMarker(key + 1);
      });
      return markers.push(marker);
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
        if (key === index - 1) {
          return el.setIcon({
            url: '/layout/images/point-white.png',
            scaledSize: new google.maps.Size(18, 24)
          });
        } else {
          return el.setIcon({
            url: '/layout/images/point-orange.png',
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

  $(document).ready(function() {
    var anchors, hash;
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
    initHighlights('highlights')();
    initHighlights('mnos')();
    $(window).on('resize', _.throttle(initHighlights('highlights')));
    $(window).on('resize', _.throttle(initHighlights('mnos')));
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
        afterLoad: function() {
          return $(window).off('hashchange');
        },
        onLeave: function(index, nextIndex, direction) {
          $(window).off('hashchange');
          return delay(300, function() {
            var next;
            next = $(".block:nth-child(" + nextIndex + ")");
            if (!$('.highlights').hasMod('active')) {
              $('.toolbar__nav').toggleClass('nav--black', next.data('nav') === 'black');
              if ($(window).width() >= 768) {
                $('.toolbar__trigger').mod('black', next.data('nav') === 'black');
              }
              $('.toolbar__logo').mod('color', next.data('logo') === 'color');
              $('#pp-nav').toggleClass('black', next.data('dots') === 'black');
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
    }
    $('.highlight__link, .mno__link').on('click', function(e) {
      var index, type;
      type = 'highlights';
      if ($(this).parents('.mnos').length > 0) {
        type = 'mnos';
      }
      index = $(this).parents('.' + type.slice(0, type.length - 1)).index();
      console.log(type, index);
      if ($(this).hasMod('next')) {
        goToHighlights(index + 1, type);
      } else if ($(this).hasMod('prev')) {
        goToHighlights(index - 1, type);
      } else if ($(this).hasMod('back')) {
        $('.' + type).mod('active', false);
        $('.toolbar__nav').toggleClass('nav--black', false);
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
      $('.highlights').mod('active', true);
      goToHighlights($($(this).attr('href')).index(), 'highlights');
      return e.preventDefault();
    });
    $('.articles a').on('click', function(e) {
      var el;
      el = $($(this).attr('href'));
      if (el.hasClass('mno')) {
        $('.mnos').mod('active', true);
        goToHighlights($($(this).attr('href')).index(), 'mnos');
        return e.preventDefault();
      }
    });
    $('.toolbar .nav__item, .nav--modal .nav__item').on('click', function(e) {
      if (typeof $.fn.pagepiling.moveTo === 'function') {
        $.fn.pagepiling.moveTo($(this).attr('href').split('#')[1]);
        if ($('.highlights').hasMod('active')) {
          $('.highlights').mod('active', false);
        }
        if ($('.mnos').hasMod('active')) {
          $('.mnos').mod('active', false);
        }
        e.preventDefault();
      }
      return $('body').removeClass('open');
    });
    $('.list__title').click(function(e) {
      var index;
      index = $(this).parents('.list__item').index();
      setActiveMarker(index + 1);
      return e.preventDefault();
    });
    $('.button').click(function(e) {
      if ($($(this).attr('href')).hasClass('block') && typeof $.fn.pagepiling.moveTo === 'function') {
        $.fn.pagepiling.moveTo($(this).attr('href').split('#')[1]);
        return e.preventDefault();
      }
    });
    if (window.location.hash) {
      hash = window.location.hash;
      if (hash.length > 0) {
        if ($(hash).hasClass('block') && typeof $.fn.pagepiling.moveTo === 'function') {
          $.fn.pagepiling.moveTo(hash.split('#')[1]);
        }
        if ($(hash).hasClass('highlight')) {
          $('.highlights').mod('active', true);
          goToHighlights($(hash).index(), 'highlights');
          $.fn.pagepiling.moveTo(3);
        }
        if ($(hash).hasClass('mno')) {
          $('.mnos').mod('active', true);
          goToHighlights($(hash).index(), 'mnos');
          $.fn.pagepiling.moveTo(4);
        }
      }
    }
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
    return $('.form').submit(function(e) {
      var request;
      e.preventDefault();
      request = $(this).serialize();
      return $.post('/include/send.php', request, function(data) {
        console.log(data);
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
  });

}).call(this);
