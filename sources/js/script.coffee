spinOptions =
	lines     : 13
	length    : 21
	width     : 2
	radius    : 24
	corners   : 0
	rotate    : 0
	direction : 1
	color     : '#fd9127'
	speed     : 1
	trail     : 68
	shadow    : false
	hwaccel   : false
	className : 'spinner'
	zIndex    : 2e9
	top       : '50%'
	left      : '50%'

markers = []

delay = (ms, func) -> setTimeout func, ms

@getCaptcha = ()->
	$.get '/include/captcha.php', (data)->
		setCaptcha data

@setCaptcha = (code)->
	$('input[name=captcha_sid], input[name=captcha_code]').val(code)
	$('.captcha').css 'background-image', "url(/include/captcha.php?captcha_sid=#{code})"

end = 'transitionend webkitTransitionEnd oTransitionEnd otransitionend MSTransitionEnd'

@initMap = ->
	console.log 'initMap'
	mapSettings =
		zoom: 3
		scrollwheel: false
		mapTypeControl: false
		streetViewControl: false
		center: new window.google.maps.LatLng(34.6917358, 32.9934606)
		styles: [
			{
				'featureType': 'all'
				'elementType': 'labels.text.fill'
				'stylers': [
					{ 'saturation': 36 }
					{ 'color': '#000000' }
					{ 'lightness': 40 }
				]
			}
			{
				'featureType': 'all'
				'elementType': 'labels.text.stroke'
				'stylers': [
					{ 'visibility': 'on' }
					{ 'color': '#000000' }
					{ 'lightness': 16 }
				]
			}
			{
				'featureType': 'all'
				'elementType': 'labels.icon'
				'stylers': [ { 'visibility': 'off' } ]
			}
			{
				'featureType': 'administrative'
				'elementType': 'geometry.fill'
				'stylers': [
					{ 'color': '#000000' }
					{ 'lightness': 20 }
				]
			}
			{
				'featureType': 'administrative'
				'elementType': 'geometry.stroke'
				'stylers': [
					{ 'color': '#000000' }
					{ 'lightness': 17 }
					{ 'weight': 1.2 }
				]
			}
			{
				'featureType': 'landscape'
				'elementType': 'geometry'
				'stylers': [
					{ 'color': '#000000' }
					{ 'lightness': 20 }
				]
			}
			{
				'featureType': 'poi'
				'elementType': 'geometry'
				'stylers': [
					{ 'color': '#000000' }
					{ 'lightness': 21 }
				]
			}
			{
				'featureType': 'road.highway'
				'elementType': 'geometry.fill'
				'stylers': [
					{ 'color': '#000000' }
					{ 'lightness': 17 }
				]
			}
			{
				'featureType': 'road.highway'
				'elementType': 'geometry.stroke'
				'stylers': [
					{ 'color': '#000000' }
					{ 'lightness': 29 }
					{ 'weight': 0.2 }
				]
			}
			{
				'featureType': 'road.arterial'
				'elementType': 'geometry'
				'stylers': [
					{ 'color': '#000000' }
					{ 'lightness': 18 }
				]
			}
			{
				'featureType': 'road.local'
				'elementType': 'geometry'
				'stylers': [
					{ 'color': '#000000' }
					{ 'lightness': 16 }
				]
			}
			{
				'featureType': 'transit'
				'elementType': 'geometry'
				'stylers': [
					{ 'color': '#000000' }
					{ 'lightness': 19 }
				]
			}
			{
				'featureType': 'water'
				'elementType': 'geometry'
				'stylers': [
					{ 'color': '#000000' }
					{ 'lightness': 17 }
				]
			}
		]
	mapElement = document.getElementById('map')
	map = new window.google.maps.Map(mapElement, mapSettings)
	coords = $('.map').data 'coords'
	coords.map (el, key) ->
		c = el.coords
		marker = new google.maps.Marker({
			position: new google.maps.LatLng(c[0], c[1]),
			map: map,
			icon: {
				url: '/layout/images/point-orange.png',
				scaledSize: new google.maps.Size(18, 24)
			}
			title: el.name
		})
		marker.addListener 'click', ->
			setActiveMarker key + 1
		markers.push marker

	markers[0].setIcon
		url: '/layout/images/point-white.png',
		scaledSize: new google.maps.Size(18, 24)

setActiveMarker = (index) ->
	if $(".list__item:nth-child(#{index})").length > 0
		$('.list__item').mod 'active', false
		$(".list__item:nth-child(#{index})").addClass 'list__item--active'
		markers.map (el, key) ->
			if key == index - 1
				el.setIcon
					url: '/layout/images/point-white.png',
					scaledSize: new google.maps.Size(18, 24)
			else
				el.setIcon
					url: '/layout/images/point-orange.png',
					scaledSize: new google.maps.Size(18, 24)

checkScroll = ->
	$('.block').each (key, el)->
		if $(el).offset().top <= $('body').scrollTop() && $(el).offset().top + $(el).height() >= $('body').scrollTop()
			$('.nav__item').mod 'active', false
			$(".nav__item[href*='#{$(el).attr('id')}']").addClass 'nav__item--active'

checkNewsScroll = (e) ->
	el = $(e.currentTarget).parents('.news')
	el.mod 'start', el.find('.news__scroll').scrollTop() > 0
	el.mod 'end', el.find('.news__wrap').outerHeight() <= $(e.currentTarget).scrollTop() + $(e.currentTarget).outerHeight()

moveHighlights = (set = true, type = 'highlights')->
	index = $(".#{type}__items").data('index')
	if !index
		index = 0

	el = $(".#{type}__items > div:nth-child(#{index + 1})")

	moveX = $(window).width() * index

	$(".#{type}__items").css
		transform: "translateX(#{-moveX}px)"

	if set
		window.location.hash = el.attr 'id'
		$(".#{type} .nav__item").mod 'active', false
		$(".#{type} .nav__item:nth-child(#{index + 1})").addClass 'nav__item--active'

		$('.toolbar__logo').mod 'color', el.data('logo') == 'color'
		$('.toolbar__nav').toggleClass 'nav--black', el.data('nav') == 'black'
		if $(window).width() >= 768
			$('.toolbar__trigger').mod 'black', el.data('nav') == 'black'
		$(".#{type}__nav").mod 'dark', el.data('nav') == 'black'

initHighlights = (type = 'highlights') ->
	return ->
		width = $(".#{type}__items > div").length * $(window).width()
		$(".#{type}__items").width width

		moveHighlights(false, type)

goToHighlights = (index, type = 'highlights') ->
	$(".#{type}__items").data 'index', index
	moveHighlights(true, type)

$(document).ready ->

	$('.modal').on 'shown.bs.modal', (e)->
		getCaptcha()
		$('.form__action').show().removeClass 'hidden'
		$('.form__success').hide().addClass 'hidden'
		if $(this).find('form').length > 0
			$(this).find('form')[0].reset()

		text = $(this).find('.text')

		if $(this).attr('id') == 'Detail'
			text.html ''
			new Spinner(spinOptions).spin text[0]

		url = $(e.relatedTarget).data 'link'
		if url
			$.get url, (data) ->
				text.html data


	$('.modal').on 'hidden.bs.modal', (e)->
		$(this).find('.text').html ''

	$.BEM = new $.BEM.constructor
		namePattern: '[a-zA-Z0-9-]+',
		elemPrefix: '__'
		modPrefix: '--'
		modDlmtr: '--'

	$('.news').each (key, el) ->
		if $(el).find('.news__wrap').height() >  $(el).find('.news__scroll').height()
			$(el).mod 'ready', true

	$('.news__scroll').on 'scroll', _.throttle checkNewsScroll, 300

	anchors = []
	$('.block').each (key, el)->
		anchors.push $(el).attr 'id'

	$('.toolbar__trigger').on 'click', (e)->
		$('body').toggleClass 'open'
		e.preventDefault()


	initHighlights('highlights')()
	initHighlights('mnos')()

	$(window).on 'resize', _.throttle initHighlights('highlights')
	$(window).on 'resize', _.throttle initHighlights('mnos')

	$.getScript 'https://maps.googleapis.com/maps/api/js?sensor=false&callback=initMap&language=en'

	if $(window).width() > 600

		$('.toolbar__logo').on 'click', (e)->
			if typeof $.fn.pagepiling.moveTo == 'function'
				$.fn.pagepiling.moveTo 'home'

			$('.highlights').mod 'active', false
			$('.mnos').mod 'active', false

			e.preventDefault()

		$('.blocks').pagepiling
			anchors: anchors
			sectionSelector: '.block'
			verticalCentered: false
			animateAnchor: false
			afterRender: ->
				$(window).off('hashchange')
			afterLoad: ->
				$(window).off('hashchange')
			onLeave: (index, nextIndex, direction) ->
				$(window).off('hashchange')
				delay 300, ->
					next = $(".block:nth-child(#{nextIndex})")
					if !$('.highlights').hasMod 'active'

						$('.toolbar__nav').toggleClass 'nav--black', next.data('nav') == 'black'

						if $(window).width() >= 768
							$('.toolbar__trigger').mod 'black', next.data('nav') == 'black'

						$('.toolbar__logo').mod 'color', next.data('logo') == 'color'

						$('#pp-nav').toggleClass 'black', next.data('dots') == 'black'

					$('.toolbar .nav__item, .nav--modal .nav__item').mod 'active', false
					$(".nav__item[href*='#{next.attr('id')}']").addClass 'nav__item--active'

		$('.news__scroll').perfectScrollbar
			suppressScrollX: true
			includePadding: true

	else
		$('body').on 'scroll', _.throttle checkScroll, 300


	$('.highlight__link, .mno__link').on 'click', (e)->

		type = 'highlights'
		if $(this).parents('.mnos').length > 0
			type = 'mnos'

		index = $(this).parents('.' + type.slice(0, type.length - 1)).index()
		console.log type, index

		if $(this).hasMod 'next'
			goToHighlights index + 1, type
		else if $(this).hasMod 'prev'
			goToHighlights index - 1, type
		else if $(this).hasMod 'back'
			$('.' + type).mod 'active', false
			$('.toolbar__nav').toggleClass 'nav--black', false
			$('.toolbar__logo').mod 'color', false
		e.preventDefault()

	$(".highlights .nav__item").on 'click', (e) ->
		goToHighlights $(this).index(), 'highlights'
		e.preventDefault()

	$(".mnos .nav__item").on 'click', (e) ->
		goToHighlights $(this).index(), 'mnos'
		e.preventDefault()

	$('a.features__item').on 'click', (e) ->
		$('.highlights').mod 'active', true
		goToHighlights $($(this).attr('href')).index(), 'highlights'
		e.preventDefault()

	$('.articles a').on 'click', (e) ->
		el = $($(this).attr('href'))
		if el.hasClass 'mno'
			$('.mnos').mod 'active', true
			goToHighlights $($(this).attr('href')).index(), 'mnos'
			e.preventDefault()

	$('.toolbar .nav__item, .nav--modal .nav__item').on 'click', (e)->
		if typeof $.fn.pagepiling.moveTo == 'function'
			$.fn.pagepiling.moveTo $(this).attr('href').split('#')[1]
			e.preventDefault()
		$('body').removeClass 'open'
		if $('.highlights').hasMod 'active'
			$('.highlights').mod 'active', false
		if $('.mnos').hasMod 'active'
			$('.mnos').mod 'active', false

			
	$('.list__title').click (e)->
		index = $(this).parents('.list__item').index()
		setActiveMarker index + 1
		e.preventDefault()

	$('.button').click (e)->
		if $($(this).attr('href')).hasClass('block') && typeof $.fn.pagepiling.moveTo == 'function'
			$.fn.pagepiling.moveTo $(this).attr('href').split('#')[1]
			e.preventDefault()

	if window.location.hash
		hash = window.location.hash
		if hash.length > 0
			if $(hash).hasClass('block') && typeof $.fn.pagepiling.moveTo == 'function'
				$.fn.pagepiling.moveTo hash.split('#')[1]

			if $(hash).hasClass('highlight')
				$('.highlights').mod 'active', true
				goToHighlights $(hash).index(), 'highlights'
				$.fn.pagepiling.moveTo 3

			if $(hash).hasClass('mno')
				$('.mnos').mod 'active', true
				goToHighlights $(hash).index(), 'mnos'
				$.fn.pagepiling.moveTo 4

	$('.tabs__item').on 'click', (e)->
		e.preventDefault()
		$('.block__col').addClass 'hidden-xs'
		$('.tabs__item').mod 'active', false
		$(this).mod 'active', true
		$($(this).attr('href')).removeClass 'hidden-xs'

	$('.form__refresh').click (e)->
		getCaptcha()
		e.preventDefault()

	$('.form').submit (e)->
		e.preventDefault()
		request = $(this).serialize()
		$.post '/include/send.php', request, (data) ->
			console.log data
			data = $.parseJSON(data)
			if data.status == "ok"
				$('.form__action').hide().addClass 'hidden'
				$('.form__success').show().removeClass 'hidden'
				$('input[name="captcha_word"]').val ''
			else if data.status == "error"
				$('input[name=captcha_word]').addClass('parsley-error')
				getCaptcha()
