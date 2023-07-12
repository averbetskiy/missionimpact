// делаем разбивку заголовка на главной
/*
	$(".hero__text-multi").each(function () {
		var p = $(this);
		var lines = p.html().trim().split("\n");
		var formated = [];
		$.each(lines, function (i, v) {
			formated.push("<span>{1}</span>".replace('{1}', v.trim()));
		});
		p.html(formated.join(''));
	});
*/

gsap.registerPlugin(ScrollTrigger);

gsap.config({
	trialWarn: false
});

function horizontalLoop(items, config) {
	items = gsap.utils.toArray(items);
	config = config || {};
	let onChange = config.onChange,
      lastIndex = 0,
      tl = gsap.timeline({repeat: config.repeat, onUpdate: onChange && function() {
        let i = tl.closestIndex()
        if (lastIndex !== i) {
          lastIndex = i;
          onChange(items[i], i);
        }
      }, paused: config.paused, defaults: {ease: "none"}, onReverseComplete: () => tl.totalTime(tl.rawTime() + tl.duration() * 100)}),
      length = items.length,
      startX = items[0].offsetLeft,
      times = [],
      widths = [],
      spaceBefore = [],
      xPercents = [],
      curIndex = 0,
      center = config.center,
      pixelsPerSecond = (config.speed || 1) * 100,
      snap = config.snap === false ? v => v : gsap.utils.snap(config.snap || 1), // some browsers shift by a pixel to accommodate flex layouts, so for example if width is 20% the first element's width might be 242px, and the next 243px, alternating back and forth. So we snap to 5 percentage points to make things look more natural
      timeOffset = 0, 
      container = center === true ? items[0].parentNode : gsap.utils.toArray(center)[0] || items[0].parentNode,
      totalWidth,
      getTotalWidth = () => items[length-1].offsetLeft + xPercents[length-1] / 100 * widths[length-1] - startX + spaceBefore[0] + items[length-1].offsetWidth * gsap.getProperty(items[length-1], "scaleX") + (parseFloat(config.paddingRight) || 0),
      populateWidths = () => {
        let b1 = container.getBoundingClientRect(), b2;
        items.forEach((el, i) => {
          widths[i] = parseFloat(gsap.getProperty(el, "width", "px"));
          xPercents[i] = snap(parseFloat(gsap.getProperty(el, "x", "px")) / widths[i] * 100 + gsap.getProperty(el, "xPercent"));
          b2 = el.getBoundingClientRect();
          spaceBefore[i] = b2.left - (i ? b1.right : b1.left);
          b1 = b2;
        });
        gsap.set(items, { // convert "x" to "xPercent" to make things responsive, and populate the widths/xPercents Arrays to make lookups faster.
          xPercent: i => xPercents[i]
        });
        totalWidth = getTotalWidth();
      },
      timeWrap,
      populateOffsets = () => {
        timeOffset = center ? tl.duration() * (container.offsetWidth / 2) / totalWidth : 0;
        center && times.forEach((t, i) => {
          times[i] = timeWrap(tl.labels["label" + i] + tl.duration() * widths[i] / 2 / totalWidth - timeOffset);
        });
      },
      getClosest = (values, value, wrap) => {
        let i = values.length,
          closest = 1e10,
          index = 0, d;
        while (i--) {
          d = Math.abs(values[i] - value);
          if (d > wrap / 2) {
            d = wrap - d;
          }
          if (d < closest) {
            closest = d;
            index = i;
          }
        }
        return index;
      },
      populateTimeline = () => {
        let i, item, curX, distanceToStart, distanceToLoop;
        tl.clear();
        for (i = 0; i < length; i++) {
          item = items[i];
          curX = xPercents[i] / 100 * widths[i];
          distanceToStart = item.offsetLeft + curX - startX + spaceBefore[0];
          distanceToLoop = distanceToStart + widths[i] * gsap.getProperty(item, "scaleX");
          tl.to(item, {xPercent: snap((curX - distanceToLoop) / widths[i] * 100), duration: distanceToLoop / pixelsPerSecond}, 0)
            .fromTo(item, {xPercent: snap((curX - distanceToLoop + totalWidth) / widths[i] * 100)}, {xPercent: xPercents[i], duration: (curX - distanceToLoop + totalWidth - curX) / pixelsPerSecond, immediateRender: false}, distanceToLoop / pixelsPerSecond)
            .add("label" + i, distanceToStart / pixelsPerSecond);    
          times[i] = distanceToStart / pixelsPerSecond;
        }
        timeWrap = gsap.utils.wrap(0, tl.duration());
      }, 
      refresh = (deep) => {
         let progress = tl.progress();
         tl.progress(0, true);
         populateWidths();
         deep && populateTimeline();
         populateOffsets();
         deep && tl.draggable ? tl.time(times[curIndex], true) : tl.progress(progress, true);
      },
      proxy;
	gsap.set(items, {x: 0});
  populateWidths();
	populateTimeline();
  populateOffsets();
  window.addEventListener("resize", () => refresh(true));
	function toIndex(index, vars) {
		vars = vars || {};
		(Math.abs(index - curIndex) > length / 2) && (index += index > curIndex ? -length : length); // always go in the shortest direction
		let newIndex = gsap.utils.wrap(0, length, index),
			time = times[newIndex];
    if (time > tl.time() !== index > curIndex) { // if we're wrapping the timeline's playhead, make the proper adjustments
			time += tl.duration() * (index > curIndex ? 1 : -1);
		}
    if (time < 0 || time > tl.duration()) {
      vars.modifiers = {time: timeWrap};
    }
		curIndex = newIndex;
		vars.overwrite = true;
    gsap.killTweensOf(proxy);
		return tl.tweenTo(time, vars);
	}
	tl.next = vars => toIndex(curIndex+1, vars);
	tl.previous = vars => toIndex(curIndex-1, vars);
	tl.current = () => curIndex;
	tl.toIndex = (index, vars) => toIndex(index, vars);
  tl.closestIndex = setCurrent => {
    let index = getClosest(times, tl.time(), tl.duration());
    setCurrent && (curIndex = index);
    return index;
  };
	tl.times = times;
  tl.progress(1, true).progress(0, true); // pre-render for performance
  if (config.reversed) {
    tl.vars.onReverseComplete();
    tl.reverse();
  }
  if (config.draggable && typeof(Draggable) === "function") {
    proxy = document.createElement("div")
    let wrap = gsap.utils.wrap(0, 1),
        ratio, startProgress, draggable, dragSnap,
        align = () => tl.progress(wrap(startProgress + (draggable.startX - draggable.x) * ratio)),
        syncIndex = () => tl.closestIndex(true);
    typeof(InertiaPlugin) === "undefined" && console.warn("InertiaPlugin required for momentum-based scrolling and snapping. https://greensock.com/club");
    draggable = Draggable.create(proxy, {
      trigger: items[0].parentNode,
      type: "x",
      onPressInit() {
        gsap.killTweensOf(tl);
        startProgress = tl.progress();
        refresh();
        ratio = 1 / totalWidth;
        gsap.set(proxy, {x: startProgress / -ratio});
        tl.timeScale(0);
      },
      onDrag: align,
      onThrowUpdate: align,
      inertia: false,
      snap: value => {
        let time = -(value * ratio) * tl.duration(),
            wrappedTime = timeWrap(time),
            snapTime = times[getClosest(times, wrappedTime, tl.duration())],
            dif = snapTime - wrappedTime;
        Math.abs(dif) > tl.duration() / 2 && (dif += dif < 0 ? tl.duration() : -tl.duration());
        return (time + dif) / tl.duration() / -ratio;
      },
      onRelease: syncIndex,
      onThrowComplete: syncIndex
    })[0];
    tl.draggable = draggable;
  }
  tl.closestIndex(true);
  onChange && onChange(items[curIndex], curIndex);
	return tl;
}

// шапка
let header = $(".header");
if ($(window).scrollTop() > 1) {
	header.addClass('fixed');
} else {
	header.removeClass('fixed');
}
$(window).scroll(function () {
	if ($(this).scrollTop() > 1) {
		header.addClass('fixed');
	} else {
		header.removeClass('fixed');
	}
});

// курсор
const container = document.createElement('div');
container.className = 'cursor';
document.querySelector('body').appendChild(container);

let cursorPlay = "play", cursorMore = "more";
if ($("body").attr("data-lang") == "en") {
	cursorPlay = "play";
	cursorMore = "more";
} else {
	cursorPlay = "play";
	cursorMore = "больше";
}

container.innerHTML = `
				<div class="cursor__wrapper">
				 	<div class="cursor__circle"></div>
				 	<div class="cursor__text">`+cursorPlay+`</div>
					<div class="cursor__text-more">`+cursorMore+`</div>
				</div>`;

const circle = container.querySelector('.cursor__wrapper');

gsap.set(circle, {
	alpha: 0,
	force3D: true
});

let mouseX;
let mouseY;
let x;
let y;
let dotX;
let dotY;
let inited = false;
let isFixed = false;
//let fixTargetXY;
let currentModificator;
const mouseMoveHandler = e => {
	mouseX = e.clientX;
	mouseY = e.clientY;
	if (!inited) {
		x = dotX = mouseX;
		y = dotY = mouseY;

		if (!inited) {
			gsap.set(circle, {
				x: x,
				y: y
			});
		}
		gsap.ticker.add(() => {
			x += (mouseX - x) / 5;
			y += (mouseY - y) / 5;

			gsap.set(circle, {
				x: x,
				y: y /*, duration: 0.15*/
			});
		});

		inited = true;
	}

	gsap.to(circle, {
		duration: 0.15,
		alpha: 1
	});
	circle.classList.add('_visible');
};

window.addEventListener('mousemove', mouseMoveHandler, true);
window.addEventListener('drag', mouseMoveHandler, true);

document.body.addEventListener('mouseleave', e => {
	gsap.to(circle, {
		duration: 0.5,
		alpha: 0
	});
	circle.classList.remove('_visible');
});

this.setOuterEvent = e => {
	mouseMoveHandler(e);
};

let checkedTarget;
const checkTarget = e => {
	let target = e.target;

	if (checkedTarget === target) {
		return;
	}

	//управление через data-cursor
	let type = target.getAttribute('data-cursor');
	if (!type) {
		while (target && target !== document.body) {
			target = target.parentNode;
			type = target.getAttribute('data-cursor');
			if (type) {
				break;
			}
		}
	}
	if (type) {
		if (currentModificator) {
			container.classList.remove(currentModificator);
		}
		if (target.tagName.toLowerCase() === 'a') {} else {
			currentModificator = '_' + type;
			container.classList.add(currentModificator);
		}
		if (type == "noType") {
			container.classList.remove(currentModificator);
		}
	} else {
		isFixed = false;
		if (currentModificator) {
			container.classList.remove(currentModificator);
		}
	}
};

document.body.addEventListener('mouseenter', checkTarget, true);
document.body.addEventListener('dragmove', checkTarget, true);
document.body.addEventListener('mousemove', checkTarget, true);

$("a,.projectsGoal__item,.itvideo__media-poster,.pv__main-media").mouseover(function () {
	$("body").find(".cursor").addClass("hover");
});

$("a,.projectsGoal__item,.itvideo__media-poster,.pv__main-media").mouseout(function () {
	$("body").find(".cursor").removeClass("hover");
});

// плавный скролл
$(document).bind('mousewheel', function (e) {
	var nt = $(document.body).scrollTop() - (e.deltaY * e.deltaFactor * 100);
	//	e.preventDefault();
	e.stopPropagation();
	$(document.body).stop().animate({
		scrollTop: nt
	}, 500, 'easeInOutCubic');
});

// табы в новостях на главной
$(".tabs__head-item").each(function () {
	$(this).click(function (e) {
		e.preventDefault();
		let index = $(this).index(),
			parent = $(this).closest(".tabs");
		parent.find(".tabs__head-item").removeClass("active");
		$(this).addClass("active");
		parent.find(".tabs__body-item").removeClass("active");
		parent.find(".tabs__body-item").eq(index).addClass("active");
	});
});

// фильтрация данных
$(".filtering").each(function () {
	var filterActive,
		filteringParent = $(this);

	function filterCategory(category) {
		if (filterActive != category) {

			// reset results list
			filteringParent.find('.filter-cat-results .f-cat').removeClass('active');

			// elements to be filtered
			filteringParent.find('.filter-cat-results .f-cat')
				.filter('[data-cat="' + category + '"]')
				.addClass('active');

			// reset active filter
			filterActive = category;
			filteringParent.find('.filtering__button').removeClass('active');
		}
	}

	filteringParent.find('.f-cat:not(.item-empty)').addClass('active');

	filteringParent.find('.filtering__button').click(function (e) {
		e.preventDefault();
		$(".divein__events-section").each(function () {
			if ($(this).is(":hidden")) $(this).show();
		});
		if ($(this).hasClass('cat-all')) {
			$('.filter-cat-results .f-cat').addClass('active');
			filterActive = 'cat-all';
			$('.filtering .filtering__button').removeClass('active');
		} else {
			filterCategory($(this).attr('data-cat'));

			// если это страница событий
			if ($(".divein__events-wrap").length > 0) {
				$(".divein__events-section").each(function () {
					if ($(this).find(".f-cat.active").length == 0) $(this).hide();
				});
			}
		}
		$(this).addClass('active');
	});
});

// секция PIN на главной
if ($(".indexSection3__sections").length > 0) {
	$(".indexSection3__sections").each(function(){
		let indexSection3__height = parseInt($(this).find(".indexSection3__section").first().css("height")),
			indexSection3__slides = $(this).find(".indexSection3__section").length,
			indexSection3__all = indexSection3__height * indexSection3__slides + 100;

		let screenWidth = $(window).width(),
			offsetStart = "top 13%";

		if (screenWidth < 980)
			offsetStart = "top 10%";

		if (screenWidth < 600)
			offsetStart = "top 13%";

		if (indexSection3__slides > 1) {
			gsap.to($(this).find(".indexSection3__section:not(:last-child)"), {
				yPercent: -100,
				ease: "none",
				stagger: 0.5,
				scrollTrigger: {
					trigger: ".indexSection3__sections",
					start: offsetStart,
					end: "+=" + indexSection3__all,
					scrub: true,
					pin: true
				}
			});
		
			gsap.set($(this).find(".indexSection3__section"), {
				zIndex: (i, target, targets) => targets.length - i
			});
		}
	});
}

$(".indexSection3__numbers-wrap").each(function () {
	var self = $(this),
		tabs = self.find(".indexSection3__numbers-side ul li"),
		panels = self.find(".indexSection3__numbers_content-item"),
		tlIndexSection3 = new TimelineMax();

	function tabClick() {
		if (!tlIndexSection3.isActive()) {
			var tabFrom = self.find(".indexSection3__numbers-side ul li.active"),
				contentFrom = self.find(".indexSection3__numbers_content-item.active"),
				sectionToIndex = $(this).index(),
				tabTo = tabs.eq(sectionToIndex),
				contentTo = panels.eq(sectionToIndex);
			if (tabFrom.index() !== tabTo.index()) {
				animation(tabFrom, tabTo, contentFrom, contentTo);
			}
		}
	}

	function animation(tabFrom, tabTo, contentFrom, contentTo) {
		tlIndexSection3 = new TimelineMax()
			.to(contentFrom, 0.3, {
				autoAlpha: 0,
				clearProps: "all",
				className: "indexSection3__numbers_content-item"
			})
			.set(contentFrom, {
				className: "indexSection3__numbers_content-item",
				display: "none"
			})
			.set(tabFrom, {
				className: "indexSection3__numbers-side ul li"
			})
			.set(tabTo, {
				className: "indexSection3__numbers-side ul li active"
			})
			.set(contentTo, {
				display: "flex",
				className: "indexSection3__numbers_content-item active"
			}, 0.3)
			.fromTo(contentTo, 0.3, {
				autoAlpha: 0
			}, {
				autoAlpha: 1
			}, 0.3)
	}

	function init() {
		tabs.on('click', tabClick);
		var activeTab = self.find(".indexSection3__numbers-side ul li:first"),
			activePanel = self.find(".indexSection3__numbers_content-item:first");
		TweenMax.set(activeTab, {
			className: "indexSection3__numbers-side ul li active"
		});
		TweenMax.set(activePanel, {
			display: "flex",
			autoAlpha: 1,
			className: "indexSection3__numbers_content-item active"
		});
	}

	init();
});


// открываем lets impact
if ($(".diveininner").length > 0)
	$(".partners__button").hide();

$(".partners__button").click(function (e) {
	e.preventDefault();
	letsOpen();
});

// закрываем lets impact
$(".lets__close,.lets__overlay").click(function (e) {
	e.preventDefault();
	letsClose();
});

function letsOpen() {
	$("body").addClass("fixed");
	gsap.to(".lets", {
		autoAlpha: 1
	});
	gsap.to(".lets__overlay", {
		autoAlpha: 0.4
	});
	gsap.to(".lets__wrap", {
		xPercent: -100,
		duration: 0.4,
		autoAlpha: 1
	});
}

function letsClose() {
	$("body").removeClass("fixed");
	gsap.to(".lets__wrap", {
		xPercent: 100,
		duration: 0.4,
		autoAlpha: 0
	});
	gsap.to(".lets__overlay", {
		autoAlpha: 0
	});
	gsap.to(".lets", {
		autoAlpha: 0
	});
}

// тема письма lets impact
$(".lets__select_emulate-title").click(function () {
	var parent = $(this).closest(".lets__select-emulate");
	parent.find(".lets__select_emulate-list").slideToggle();
	parent.toggleClass("opened");
});

$(".lets__select_emulate-item").click(function () {
	var parent = $(this).closest(".lets__form-select"),
		current = $(this).text();
	parent.find("select").val(current);
	parent.find(".lets__select_emulate-title").text(current);
	parent.find(".lets__select_emulate-list").slideUp();
	parent.find(".lets__select-emulate").removeClass("opened");
});

// политика lets impact
$(".lets__form-policy").click(function (e) {
	$(this).toggleClass("checked");
	$(".lets__form-button").toggleClass("disabled");
});

// megamenu
$(".dropdown > a").click(function (e) {
	e.preventDefault();
	$(".dropdown").not($(this).closest(".dropdown")).removeClass("opened");
	$("body").removeClass("fixed");
	$(".megamenu__overlay").removeClass("show");
	if ($(this).closest(".dropdown").hasClass("opened")) {
		if ($("body").hasClass("header__transparent"))
			$(".header").removeClass("fixed");
		$("body").removeClass("fixed");
		$(".megamenu__overlay").removeClass("show");
	} else {
		if ($("body").hasClass("header__transparent"))
			$(".header").addClass("fixed");
		$("body").addClass("fixed");
		$(".megamenu__overlay").addClass("show");
	}
	$(this).closest(".dropdown").toggleClass("opened");
});
$(".megamenu__overlay").on("mouseover",function (e) {
	e.preventDefault();
	$(".dropdown").removeClass("opened");
	$("body").removeClass("fixed");
	$(".megamenu__overlay").removeClass("show");
})

// project program expand content
$(".projectProgram__item.__existText .projectProgram__item-title__wrap").click(function () {
	$(this).toggleClass("opened");
	$(this).closest(".projectProgram__item").find(".projectProgram__item-text").slideToggle();
});

// секция PIN на странице проекта
//if ($(".projectHero").length > 0) {
//	
//	let projectHero_intro_height = parseInt($(".projectHero__image").css("height"));
//	
//	let tl = gsap.timeline({
//		scrollTrigger: {
//			trigger: ".projectHero",
//			start: "top top",
//			end: "+="+projectHero_intro_height,
//			scrub: true,
//			pin: true
//		}
//	});
//	
//	tl.to(".projectHero__media-wrap", {marginTop:"-"+projectHero_intro_height}, 0);
//	tl.to(".projectHero__media-wrap .container", {maxWidth:"none",padding:0}, 0);
//
//}

// открываем contributors
$(".contributors__item-card").click(function (e) {
	e.preventDefault();
	let parent = $(this).closest(".contributors__item");
	parent.find(".contributors__item-full").clone().appendTo($("body"));
	//	gsap.to($("body > .contributors__item-full"), {
	//		autoAlpha: 1
	//	});
	//	gsap.to($("body > .contributors__item-full .contributors__info-overlay"), {
	//		autoAlpha: 0.4
	//	});
	//	gsap.to($("body > .contributors__item-full .contributors__info-wrap"), {
	//		xPercent: -100,
	//		duration: 0.4,
	//		autoAlpha: 1
	//	});

	$("body").addClass("fixed");
	$("body > .contributors__item-full").show().addClass("opened");

	let timelineContributors = gsap.timeline({
		paused: false,
		reversed: false
	});

	timelineContributors.to("body > .contributors__item-full", {
			autoAlpha: 1
		})
		.to($("body > .contributors__item-full .contributors__info-overlay"), {
			autoAlpha: 0.4
		})
		.to($("body > .contributors__item-full .contributors__info-wrap"), {
			xPercent: -100,
			duration: 0.4,
			autoAlpha: 1
		});

	timelineContributors.timeScale(1.2);
	
	timelineContributors.play();
});

// закрываем contributors
$("body").on("click", ".contributors__info-overlay, .contributors__info-close", function (e) {
	e.preventDefault();

	let timelineContributors = gsap.timeline({
		paused: false,
		reversed: false,
		onComplete: function () {
			$(".contributors__item-full.opened").remove();
		}
	});

	timelineContributors.to(".contributors__item-full.opened .contributors__info-wrap", {
			xPercent: 100,
			duration: 0.4,
			autoAlpha: 0
		})
		.to(".contributors__item-full.opened .contributors__info-overlay", {
			autoAlpha: 0
		})
		.to(".contributors__item-full.opened", {
			autoAlpha: 0
		});

	timelineContributors.timeScale(1.2);

	timelineContributors.play();
	
	$("body").removeClass("fixed");

});

// слайдер картинок в проекте
$(".projectGoal__list").each(function () {
 	gsap.utils.toArray('.projectGoal__list').forEach(container => {
      var tl = horizontalLoop(container.querySelectorAll(".projectsGoal__item"), {draggable: true, speed: 0.5, repeat: -1}),
          clamp = gsap.utils.clamp(-60, 60),
          isOver, reversedOnPause;
      container.addEventListener("mouseenter", () => {
        reversedOnPause = tl.timeScale() < 0;
        isOver = true;
        gsap.to(tl, {timeScale: 0, duration: 1, overwrite: true});
        container.classList.add("paused");
      });
      container.addEventListener("mouseleave", () => {
        isOver = false;
        gsap.to(tl, {timeScale: reversedOnPause ? -1 : 1, duration: 1, overwrite: true});
        container.classList.remove("paused");
      });

		$(document).on('afterShow.fb', function( e, instance, slide ) {
			reversedOnPause = tl.timeScale() < 0;
			isOver = true;
			gsap.to(tl, {timeScale: 0, duration: 1, overwrite: true});
			container.classList.add("paused");
		});
		
		$(document).on('afterClose.fb', function( e, instance, slide ) {
			isOver = false;
			gsap.to(tl, {timeScale: reversedOnPause ? -1 : 1, duration: 1, overwrite: true});
			container.classList.remove("paused");
		});
    });
});

// анимация лого
$(".projectLogos__wrap").each(function () {
	let thisParent = $(this),
		countLogos = thisParent.attr("data-count"),
		animateLogos = false;
	if ($(window).width() > 980 && countLogos > 6)
		animateLogos = true;
	if ($(window).width() < 760 && countLogos > 3)
		animateLogos = true;
	if ($(window).width() < 650 && countLogos > 2)
		animateLogos = true;
	if (animateLogos) {
		if (countLogos < 5) {
			$(".projectLogos__item").each(function(){
				$(this).clone().appendTo(thisParent);
			});
		}
		$(this).addClass("animateLogos");
		gsap.utils.toArray('.projectLogos__wrap').forEach(container => {
		  var tl = horizontalLoop(container.querySelectorAll(".projectLogos__item"), {draggable: true, speed: 0.5, repeat: -1}),
			  isOver, reversedOnPause;
		  container.addEventListener("mouseenter", () => {
			reversedOnPause = tl.timeScale() < 0;
			isOver = true;
			gsap.to(tl, {timeScale: 0, duration: 1, overwrite: true});
			container.classList.add("paused");
		  });
		  container.addEventListener("mouseleave", () => {
			isOver = false;
			gsap.to(tl, {timeScale: reversedOnPause ? -1 : 1, duration: 1, overwrite: true});
			container.classList.remove("paused");
		  });
		});
	} else {
		$(this).removeClass("animateLogos");
	}
});

// мобильное меню
$(document).ready(function () {
	$(".header__menu_mob").on("click", function (event) {
		$(".header__menu_mob, .header__nav_mob, .header__lang").toggleClass("_active");
		$("body").toggleClass("fixed").toggleClass("mobileMenuOpened");
	});
});

// найти в статье параграф цитату
$(".divein__article-content blockquote").each(function () {
	$(this).next("p").addClass("afterQuote");
});

// обработка видео блока в статье
function fancyTimeFormat(duration) {
	// Hours, minutes and seconds
	var hrs = ~~(duration / 3600);
	var mins = ~~((duration % 3600) / 60);
	var secs = ~~duration % 60;

	// Output like "1:01" or "4:03:59" or "123:03:59"
	var ret = "";

	if (hrs > 0) {
		ret += "" + hrs + ":" + (mins < 10 ? "0" : "");
	}

	ret += "" + mins + ":" + (secs < 10 ? "0" : "");
	ret += "" + secs;
	return ret;
}

$(".divein__article-content video").each(function () {

	let thisEl = $(this),
		video = $(this).get(0);
	var i = setInterval(function () {
		if (video.readyState > 0) {
			let videoDuration = video.duration,
				articleVideoHtml = thisEl.html(),
				articleVideoPoster = thisEl.attr("poster"),
				articleHtmlPreview = "",
				articleVideoContent = "",
				articleHtmlMedia = "",
				videoTime = "",
				videoMeta = $(".divein__meta").html();

			articleHtmlMedia = "<div class='divein__article-content__video_media-poster'><img src='" + articleVideoPoster + "' alt=''></div>";

			articleHtmlMedia += "<div class='divein__article-content__video_media-wrap'>";
			articleHtmlMedia += "<div class='divein__article-content__video_media-type'>" + videoMeta + "</div>";
			videoTime = fancyTimeFormat(videoDuration);
			articleHtmlMedia += "<div class='divein__article-content__video_media-time'>" + videoTime + "</div>";
			articleHtmlMedia += "</div>";

			articleVideoContent = '<video controls poster="' + articleVideoPoster + '" muted>';
			articleVideoContent += articleVideoHtml;
			articleVideoContent += '</video>';

			articleHtmlPreview = "<div class='divein__article-content__video'>";
			articleHtmlPreview += "<div class='divein__article-content__video-media'>";
			articleHtmlPreview += articleHtmlMedia;
			articleHtmlPreview += "</div>";
			articleHtmlPreview += "<div class='divein__article-content__video-iframe'>";
			articleHtmlPreview += articleVideoContent;
			articleHtmlPreview += "</div>";
			articleHtmlPreview += "</div>";

			$(articleHtmlPreview).insertAfter(thisEl);
			clearInterval(i);
		}
	}, 200);
});

$(".divein__article-content").on("click", ".divein__article-content__video", function () {
	$(this).find(".divein__article-content__video-media").addClass("hidden");
	$(this).find(".divein__article-content__video-iframe").addClass("show");
	$(this).find(".divein__article-content__video-iframe").find("video").get(0).play();
});

// открываем partners
//$(".aboutPartners__wrap-item").click(function (e) {
//	e.preventDefault();
//	let parent = $(this);
//	parent.find(".aboutPartners__item-full").clone().appendTo($("body"));
//	$("body").addClass("fixed");
//	$("body > .aboutPartners__item-full").show().addClass("opened");
//	gsap.to($("body > .aboutPartners__item-full"), {
//		autoAlpha: 1
//	});
//	gsap.to($("body > .aboutPartners__item-full .aboutPartners__info-overlay"), {
//		autoAlpha: 0.4
//	});
//	gsap.to($("body > .aboutPartners__item-full .aboutPartners__info-wrap"), {
//		xPercent: -100,
//		duration: 0.4,
//		autoAlpha: 1
//	});
//});

// закрываем partners
$("body").on("click", ".aboutPartners__info-overlay, .aboutPartners__info-close", function (e) {
	e.preventDefault();

	var timelineContributors = gsap.timeline({
		paused: true,
		reversed: true,
		onComplete: function () {
			$(".aboutPartners__item-full.opened").remove();
		}
	});

	timelineContributors.to(".aboutPartners__item-full.opened .aboutPartners__info-wrap", {
			xPercent: 100,
			duration: 0.4,
			autoAlpha: 0
		})
		.to(".aboutPartners__item-full.opened .aboutPartners__info-overlay", {
			autoAlpha: 0
		})
		.to(".aboutPartners__item-full.opened", {
			autoAlpha: 0
		});

	timelineContributors.timeScale(1.2);
	
	timelineContributors.play();
	
	$("body").removeClass("fixed");

});

// проигрывание видео в модальном окне
$(".indexSection3__contents-video").click(function (e) {
	e.preventDefault();
	$(this).next(".modal__video").clone().appendTo($("body"));
	$("body > .modal__video").addClass("opened");
});
$("body").on("click", ".modal__video-close,.modal__video-overlay", function (e) {
	e.preventDefault();
	$(this).closest(".modal__video").removeClass("opened");
	$("body > .modal__video").remove();
});
$("body").on("click", ".modal__video-preview", function (e) {
	e.preventDefault();
	$(this).closest(".modal__video-inner").find(".modal__video-preview").hide();
	$(this).closest(".modal__video-inner").find(".modal__video-iframe").show();
	if ($(this).closest(".modal__video-inner").find(".modal__video-iframe").find("video")) {
		$(this).closest(".modal__video-inner").find(".modal__video-iframe").find("video").get(0).play();
	}
});

// анимация круга на странице about
if ($(".aboutGuide__timeline").length > 0) {
	let tl = gsap.timeline({
		scrollTrigger: {
			trigger: ".aboutGuide__timeline",
			start: "top top+=60%",
/*			onUpdate: self => {
				if (self.direction === 1) {
					tl.play();
				} else {
					tl.reverse();
				}
			}*/
		}
	});
	tl.timeScale(3);
	tl.fromTo(".aboutGuide__timeline-circle01", {
		scaleX: 0,
		scaleY: 0
	}, {
		scaleY: 1,
		scaleX: 1,
		transformOrigin: "center center"
	});
	tl.fromTo(".aboutGuide__timeline-text01", {
		autoAlpha: 0
	}, {
		autoAlpha: 1
	});
	tl.fromTo(".aboutGuide__timeline-circle02", {
		scaleX: 0,
		scaleY: 0
	}, {
		scaleY: 1,
		scaleX: 1,
		transformOrigin: "center center"
	});
	tl.fromTo(".aboutGuide__timeline-circle03", {
		scaleX: 0,
		scaleY: 0
	}, {
		scaleY: 1,
		scaleX: 1,
		transformOrigin: "center center"
	});
	tl.fromTo(".aboutGuide__timeline-circle04", {
		scaleX: 0,
		scaleY: 0
	}, {
		scaleY: 1,
		scaleX: 1,
		transformOrigin: "center center"
	});
	tl.fromTo(".aboutGuide__timeline-circle05", {
		scaleX: 0,
		scaleY: 0
	}, {
		scaleY: 1,
		scaleX: 1,
		transformOrigin: "center center"
	});
	tl.fromTo(".aboutGuide__timeline-circle06", {
		scaleX: 0,
		scaleY: 0
	}, {
		scaleY: 1,
		scaleX: 1,
		transformOrigin: "center center"
	});
	tl.fromTo(".aboutGuide__timeline-hr", {
		autoAlpha: 0
	}, {
		autoAlpha: 1
	});
	tl.fromTo(".aboutGuide__timeline-text02", {
		autoAlpha: 0
	}, {
		autoAlpha: 1
	});
	tl.fromTo(".aboutGuide__timeline-text03", {
		autoAlpha: 0
	}, {
		autoAlpha: 1
	});
	tl.fromTo(".aboutGuide__timeline-text04", {
		autoAlpha: 0
	}, {
		autoAlpha: 1
	});
	tl.fromTo(".aboutGuide__timeline-text05", {
		autoAlpha: 0
	}, {
		autoAlpha: 1
	});
	tl.fromTo(".aboutGuide__timeline-text06", {
		autoAlpha: 0
	}, {
		autoAlpha: 1
	});
}

// аанимация людей на странице about
if ($(".aboutGroup").length > 0) {
	if ($("body").width() > 900) {
		gsap.set('.aboutGroup__animation-list[data-type="one"]', {
			yPercent: -50
		})
		gsap.set('.aboutGroup__animation-list[data-type="two"]', {
			yPercent: -10
		})
		gsap.to('.aboutGroup__animation-list[data-type="one"]', {
			yPercent: -30,
			scrollTrigger: {
				scrub: true,
				trigger: ".aboutGroup",
				start: "-=200"
			}
		});
		gsap.to('.aboutGroup__animation-list[data-type="two"]', {
			yPercent: -30,
			scrollTrigger: {
				trigger: ".aboutGroup",
				scrub: true,
				start: "-=200"
			}
		});
	}
}

// меню второй вариант
$(".megamenu__divein-menu__link").click(function (e) {
	e.preventDefault();
	let curIndex = $(this).index();
	$(".megamenu__divein-menu__link").removeClass("active");
	$(".megamenu__divein-content__item").removeClass("active");
	$(".megamenu__divein-links__item").removeClass("active");
	$(this).addClass("active");
	$(".megamenu__divein-content__item").eq(curIndex).addClass("active");
	$(".megamenu__divein-links__item").eq(curIndex).addClass("active");
});

// календарь
if ($(".diveinevents__views").length > 0) {

	// let calItems = [{
	// 	"date": "30.10.2022",
	// 	"events": [{
	// 		"title": "Collaboration for a global progress 12",
	// 		"photo": "https://test.vadev.ru/mi/img/divein/blog__item01.png",
	// 		"link": "https://google.com",
	// 		"desc": "Short description in a few lines. Can you hide it. Short description in a few lines. Can you hide it",
	// 		"tags": [{
	// 				"title": "Offline — Moscow"
	// 			},
	// 			{
	// 				"title": "Offline — Moscow"
	// 			},
	// 			{
	// 				"title": "Offline — Moscow"
	// 			}
	// 		]
	// 	}]
	// }, {
	// 	"date": "01.11.2022",
	// 	"events": [{
	// 			"title": "Collaboration for a global progress",
	// 			"photo": "https://test.vadev.ru/mi/img/divein/blog__item01.png",
	// 			"link": "https://google.com",
	// 			"type": "Webinar",
	// 			"desc": "Short description in a few lines. Can you hide it. Short description in a few lines. Can you hide it",
	// 			"tags": [{
	// 					"title": "Offline — Moscow"
	// 				},
	// 				{
	// 					"title": "Offline — Moscow"
	// 				},
	// 				{
	// 					"title": "Offline — Moscow"
	// 				}
	// 			]
	// 		},
	// 		{
	// 			"title": "Collaboration for a global progress",
	// 			"photo": "https://test.vadev.ru/mi/img/divein/blog__item01.png",
	// 			"link": "https://google.com",
	// 			"type": "Education",
	// 			"desc": "Short description in a few lines. Can you hide it. Short description in a few lines. Can you hide it",
	// 			"tags": [{
	// 					"title": "Offline — Moscow"
	// 				},
	// 				{
	// 					"title": "Offline — Moscow"
	// 				},
	// 				{
	// 					"title": "Offline — Moscow"
	// 				}
	// 			]
	// 		}
	// 	]
	// }, {
	// 	"date": "02.11.2022",
	// 	"events": [{
	// 		"title": "Collaboration for a global progress 2",
	// 		"photo": "https://test.vadev.ru/mi/img/divein/blog__item01.png",
	// 		"link": "https://google.com",
	// 		"type": "Сhallenges",
	// 		"tags": [{
	// 			"title": "Offline — Moscow"
	// 		}]
	// 	}, {
	// 		"title": "Collaboration for a global progress 3",
	// 		"photo": "https://test.vadev.ru/mi/img/divein/blog__item01.png",
	// 		"link": "https://google.com",
	// 		"type": "Competition",
	// 		"tags": [{
	// 			"title": "Offline — Moscow"
	// 		}]
	// 	}, {
	// 		"title": "Collaboration for a global progress 4",
	// 		"photo": "https://test.vadev.ru/mi/img/divein/blog__item01.png",
	// 		"link": "https://google.com",
	// 		"type": "Сhallenges",
	// 		"tags": [{
	// 			"title": "Offline — Moscow"
	// 		}]
	// 	}, {
	// 		"title": "Collaboration for a global progress 5",
	// 		"photo": "https://test.vadev.ru/mi/img/divein/blog__item01.png",
	// 		"link": "https://google.com",
	// 		"type": "Competition",
	// 		"tags": [{
	// 			"title": "Offline — Moscow"
	// 		}]
	// 	}, {
	// 		"title": "Collaboration for a global progress 6",
	// 		"photo": "https://test.vadev.ru/mi/img/divein/blog__item01.png",
	// 		"link": "https://google.com",
	// 		"type": "Education",
	// 		"tags": [{
	// 			"title": "Offline — Moscow"
	// 		}]
	// 	}]
	// }];
	// генерация событий в календаре
	// function generateEvents(events, count, popup = false) {
	// 	let eventsHtml = '',
	// 		eventsTypeObject = $(".divein__events-tabs__item.active");
	// 	if (popup)
	// 		eventsHtml = '<div class="popupEvents"><div class="popupEvents__overlay"></div><div class="popupEvents__wrap"><button class="popupEvents__close">x</button><div class="popupEvents__list">';
	// 	else
	// 		eventsHtml = '<div class="calDayEvents">';
	// 	for (const element of events) {
	// 		let eventLink = element.link,
	// 			eventTitle = element.title,
	// 			eventDesc = element.desc,
	// 			eventTags = element.tags,
	// 			eventImage = element.photo;
	// 		if (count > 1 && !popup) eventsHtml += '<div class="calDayEvents__item">';
	// 		else eventsHtml += '<a href="' + eventLink + '" class="calDayEvents__item">';
	// 		eventsHtml += generateCalItem(eventTitle, eventLink, eventDesc, eventImage, eventTags, popup);
	// 		if (count > 1 && !popup) eventsHtml += '</div>';
	// 		else eventsHtml += '</a>';
	// 	}
	// 	if (popup) eventsHtml += '</div></div></div>';
	// 	else eventsHtml += '</div>';
	// 	return eventsHtml;
	// }
	//
	// // карточка события
	// function generateCalItem(title, link, desc, photo, tags, popup) {
	// 	let eventsHtml = '<div class="calDayEvents__item-photo">';
	// 	eventsHtml += '<img src="' + photo + '" alt="' + title + '">';
	// 	eventsHtml += '</div>';
	// 	eventsHtml += '<div class="calDayEvents__item-content">';
	// 	eventsHtml += '<div class="calDayEvents__item-title">' + title + '</div>';
	// 	let tagsFindCount = tags.length;
	// 	if (tagsFindCount > 0) {
	// 		eventsHtml += '<div class="calDayEvents__item-tags">';
	// 		for (const tag of tags) {
	// 			let tagTitle = tag.title;
	// 			eventsHtml += '<span class="calDayEvents__item-tags__item">' + tagTitle + '</span>';
	// 		}
	// 		eventsHtml += '</div>';
	// 	}
	// 	if (desc != "undefined" && popup) eventsHtml += '<div class="calDayEvents__item-desc">' + desc + '</div>';
	// 	eventsHtml += '</div>';
	// 	return eventsHtml;
	// }
	//
	// let nowDate = new Date(),
	// 	nowDateNumber = nowDate.getDate(),
	// 	nowMonth = nowDate.getMonth(),
	// 	nowYear = nowDate.getFullYear(),
	// 	container = document.getElementById('month-calendar'),
	// 	monthContainer = container.getElementsByClassName('month-name')[0],
	// 	yearContainer = container.getElementsByClassName('year-name')[0],
	// 	daysContainer = container.getElementsByClassName('days')[0],
	// 	prev = container.getElementsByClassName('prev')[0],
	// 	next = container.getElementsByClassName('next')[0],
	// 	monthName = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
	// 	monthNameShort = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
	//
	// let curDate = nowDate.setMonth(nowDate.getMonth() - 1);
	//
	// function setMonthCalendar(year, month,calItems) {
	// 	let monthDays = new Date(year, month + 1, 0).getDate(),
	// 		monthPrefix = new Date(year, month, 0).getDay(),
	// 		monthDaysText = '',
	// 		eventsHtml = '';
	//
	// 	monthContainer.textContent = monthName[month];
	// 	yearContainer.textContent = year;
	// 	daysContainer.innerHTML = '';
	//
	// 	if (monthPrefix > 0) {
	// 		for (let i = 1; i <= monthPrefix; i++) {
	// 			monthDaysText += '<li></li>';
	// 		}
	// 	}
	//
	// 	for (let i = 1; i <= monthDays; i++) {
	// 		let dayFind = "";
	// 		if (i < 10) dayFind = "0" + i;
	// 		else dayFind = i;
	//
	// 		// составляем дату для поиска
	// 		dayFind = dayFind.toString() + "." + (month + 1).toString() + "." + year.toString();
	//
	// 		// определяем тип события
	// 		let eventsFindIndex = calItems.findIndex(item => item.date === dayFind);
	//
	// 		let dayClass = '';
	// 		if (eventsFindIndex > -1) dayClass = ' class="existEvents"';
	// 		monthDaysText += '<li' + dayClass + '><div class="calDayTop"><span class="calDayText">' + i;
	//
	// 		if (i == 1 || i == monthDays) monthDaysText += " " + monthNameShort[month] + '</span>';
	// 		else monthDaysText += '</span>';
	//
	// 		// ищем хотя бы одно событие
	// 		if (eventsFindIndex > -1) {
	//
	// 			let events = calItems[eventsFindIndex].events;
	// 			if (!$(".divein__events-tabs__item.active").hasClass("cat-all")) {
	// 				let eventsType = $(".divein__events-tabs__item.active").text();
	// 				events = calItems[eventsFindIndex].events.filter(item => item.type === eventsType);
	// 			}
	//
	// 			let eventsFindCount = events.length;
	// 			if (eventsFindCount > 1)
	// 				monthDaysText += '<span class="calDayEventsCount">' + eventsFindCount + " Events</span>";
	// 			monthDaysText += "</div>" + generateEvents(events, eventsFindCount, false);
	// 			if (eventsFindCount > 1)
	// 				monthDaysText += generateEvents(events, eventsFindCount, true);
	// 		}
	// 	}
	//
	// 	daysContainer.innerHTML = monthDaysText;
	//
	// }

	// setMonthCalendar(nowYear, nowMonth);

	// prev.onclick = function () {
	// 	let curDate = new Date(yearContainer.textContent, monthName.indexOf(monthContainer.textContent));
	//
	// 	curDate.setMonth(curDate.getMonth() - 1);
	//
	// 	let curYear = curDate.getFullYear(),
	// 		curMonth = curDate.getMonth();
	//
	// 	setMonthCalendar(curYear, curMonth);
	// }
	//
	// next.onclick = function () {
	// 	let curDate = new Date(yearContainer.textContent, monthName.indexOf(monthContainer.textContent));
	// 	curDate.setMonth(curDate.getMonth() + 1);
	// 	let curYear = curDate.getFullYear(),
	// 		curMonth = curDate.getMonth();
	//
	// 	setMonthCalendar(curYear, curMonth);
	// }

	// меняем тип в календаре
	$(".divein__events-tabs__item").click(function () {
		if ($(".diveinevents__views.active").attr("data-attr") == "Calendar")
			setMonthCalendar(nowYear, nowMonth);
	});
}

if ($(".projectHero__media-photo").length > 0) {
	$(".projectHero__media-photo").click(function () {
		$(this).hide();
		$(this).closest(".hero__media").addClass("hideImage");
		let videoDiv = $(this).closest(".projectHero__media-section").find(".projectHero__media-video");
		videoDiv.show();
		if (videoDiv.find("video").length > 0)
			videoDiv.find("video").get(0).play();
	});
}

$(".main_video_block").click(function(e){
	e.preventDefault();
});

$(".hero__media").click(function(){
	if ($(this).find("div.hero__media-video").length > 0) {
		$(this).find("img").hide();
		$(this).find(".projectHero__media-video").show();
		$(this).addClass("hideImage");
		$(".cursor").hide();
	}
});

$(".hero__media").mouseover(function(){
	$(".cursor").addClass("hover");
});

$(".hero__media").mouseleave(function(){
	$(".cursor").removeClass("hover");
});

$("[data-fancybox]").fancybox({
	loop: true,
	thumbs : {
		autoStart : true,
		axis: 'y'
	},
	buttons : [
    'download',
    'thumbs',
    'close'
  ]
});

// TERMS AND CONDITION открываем
$('*[data-attr="Terms & Conditions"]').on("click", function (e) {
	e.preventDefault();
	let parent = $(".terms__open[id='terms80']");
	parent.toggleClass("_active");
	parent.find(".terms__overlay").toggleClass("_active");
	parent.find(".terms__wrap").toggleClass("_active");
	$("body").addClass("fixed");
});
// TERMS AND CONDITION закрываем
$(".terms__close,.terms__overlay").on("click", function (e) {
	let parent = $(this).closest(".terms__open");
	parent.removeClass("_active");
	parent.find(".terms__overlay").removeClass("_active");
	parent.find(".terms__wrap").removeClass("_active");
	$("body").removeClass("fixed");
});

// Privacy Policy открываем
$('*[data-attr="Privacy Policy"],.lets__form-policy a').on("click", function (e) {
	e.preventDefault();
	if ($("body").attr("data-lang") == "ru") {
		let termsElement = $(".terms__open[id='termsprivacy-policy']");
		termsElement.toggleClass("_active");
		termsElement.find(".terms__overlay").toggleClass("_active");
		termsElement.find(".terms__wrap").toggleClass("_active");
		$("body").addClass("fixed");
	} else {
		let termsElement = $(".terms__open[id='terms10255']");
		termsElement.toggleClass("_active");
		termsElement.find(".terms__overlay").toggleClass("_active");
		termsElement.find(".terms__wrap").toggleClass("_active");
		$("body").addClass("fixed");
	}
});

// открываем popup в календаре
$("body").on("click", ".calDayEvents.openPopup", function (e) {
	e.preventDefault();
	let parent = $(this).closest(".existEvents");
	parent.find(".popupEvents").clone().appendTo($("body"));

	$("body").addClass("fixed");
	$("body > .popupEvents").show().addClass("opened");

	let timelinePopupEvents = gsap.timeline({
		paused: false,
		reversed: false
	});

	timelinePopupEvents.to("body > .popupEvents", {
			autoAlpha: 1
		})
		.to($("body > .popupEvents .popupEvents__overlay"), {
			autoAlpha: 0.4
		})
		.to($("body > .popupEvents .popupEvents__wrap"), {
			xPercent: -100,
			duration: 0.4,
			autoAlpha: 1
		});

	timelinePopupEvents.timeScale(1.2);
	timelinePopupEvents.play();
});

// закрываем popup в календаре
$("body").on("click", ".popupEvents__overlay, .popupEvents__close", function (e) {
	e.preventDefault();

	let timelinePopupEvents = gsap.timeline({
		paused: false,
		reversed: false,
		onComplete: function () {
			$(".popupEvents.opened").remove();
		}
	});

	timelinePopupEvents.to(".popupEvents.opened .popupEvents__wrap", {
			xPercent: 100,
			duration: 0.4,
			autoAlpha: 0
		})
		.to(".popupEvents.opened .popupEvents__overlay", {
			autoAlpha: 0
		})
		.to(".popupEvents.opened", {
			autoAlpha: 0
		});

	timelinePopupEvents.timeScale(1.2);

	timelinePopupEvents.play();
	
	$("body").removeClass("fixed");

});

//var brandSwiper = new Swiper('.brand-sliders .swiper-container', {
//	slidesPerView: 'auto',
////	effect: 'slide',
////	roundLengths: true,
//	grabCursor: true,
//	disableOnInteraction: true,
////	speed: 3000,
//	loop: true,
//	autoplay: true
//})

var swiper = new Swiper(".brand-sliders .swiper-container", {
	slidesPerView: 'auto',
	loop: true,
	centeredSlides: true,
	spaceBetween: 30,
	speed: 3000,
	grabCursor: true,
	autoplay: {
		delay: 0,
		disableOnInteraction: false,
	},
});

// открываем спикеров в Impact Team 2050
$(".itteam__item-card").click(function (e) {
	e.preventDefault();
	let parent = $(this).closest(".itteam__item");
	parent.find(".itteam__item-full").clone().appendTo($("body"));

	$("body").addClass("fixed");
	$("body > .itteam__item-full").show().addClass("opened");

	let timelineItteam = gsap.timeline({
		paused: false,
		reversed: false
	});

	timelineItteam.to("body > .itteam__item-full", {
			autoAlpha: 1
		})
		.to($("body > .itteam__item-full .itteam__info-overlay"), {
			autoAlpha: 0.4
		})
		.to($("body > .itteam__item-full .itteam__info-wrap"), {
			xPercent: -100,
			duration: 0.4,
			autoAlpha: 1
		});
	
	timelineContributors.timeScale(1.2);

	timelineItteam.play();
});

// закрываем спикеров в Impact Team 2050
$("body").on("click", ".itteam__info-overlay, .itteam__info-close", function (e) {
	e.preventDefault();

	let timelineItteam = gsap.timeline({
		paused: false,
		reversed: false,
		onComplete: function () {
			$(".itteam__item-full.opened").remove();
		}
	});

	timelineItteam.to(".itteam__item-full.opened .itteam__info-wrap", {
			xPercent: 100,
			duration: 0.4,
			autoAlpha: 0
		})
		.to(".itteam__item-full.opened .itteam__info-overlay", {
			autoAlpha: 0
		})
		.to(".itteam__item-full.opened", {
			autoAlpha: 0
		});

	timelineItteam.timeScale(1.2);

	timelineItteam.play();
	
	$("body").removeClass("fixed");

});

$(".itvideo__media").click(function(){
	$(this).toggleClass("showed");
});

if (document.querySelector('.itteam') !== null) {
	const setTextParallax = () => {
	  if (window.innerWidth < 560) return;

	  window.addEventListener('load', () => {
		const dom = {
		  trigger: document.querySelector('.itteam__mask'),
		};

		ScrollTrigger.create({
		  trigger: dom.trigger,
		  start: 'top bottom',
		  end: 'bottom top',
		  animation: gsap.fromTo(
			dom.trigger,
			 {
				 backgroundPosition: '50% 0px',
			   },
			   {
				ease: 'none',
				 backgroundPosition: '50% -250px',
			   }
		  ),
		  scrub: true,
		});
	  });
	};

	const setPin = () => {
	  if (window.innerWidth < 560) return;

	  window.addEventListener('load', () => {
		const dom = {
		  trigger: document.querySelector('.itteam__list'),
		  scroll: document.querySelector('.itteam__list-scroll'),
		  pin: document.querySelector('.itwrap'),
		  scrollbar: {
			self: document.querySelector('.itteam__list-scrollbar'),
			thumb: document.querySelector('.itteam__list-scrollbar-thumb'),
		  },
		};
		const length = dom.trigger.scrollWidth - dom.trigger.offsetWidth;
		const scrollTween = gsap.timeline({ defaults: { ease: 'none' } }).to(dom.scroll, { x: -length }, 0);

		const presetScrollbar = () => {
		  const r = dom.scroll.offsetWidth / dom.scroll.scrollWidth;
		  const width = r * dom.scrollbar.self.offsetWidth;
		  gsap.set(dom.scrollbar.thumb, {
			width,
		  });
		  scrollTween.to(dom.scrollbar.thumb, { x: dom.scrollbar.self.offsetWidth - width }, 0);
		};
		presetScrollbar();

		ScrollTrigger.create({
		  trigger: dom.trigger,
		  start: 'center center',
		  end: `+=${length}`,
		  animation: scrollTween,
		  anticipatePin: true,
		  scrub: true,
		  pin: dom.pin,
		});
	  });
	};

	setTextParallax();
	setPin();
}

// обрезка текста в Impact Team 2050
	$(".enjoy__item").each(function(){
		let parentItem = $(this);
	   // resize the slide-read-more Div
	   var box = parentItem.find(".enjoy__item-text");
	   var minimumHeight = 42; // max height in pixels
	   var initialHeight = box.innerHeight();
	   // reduce the text if it's longer than 200px
	   if (initialHeight > minimumHeight) {
		  box.css('height', minimumHeight);
		  parentItem.find(".read-more-button").show()
			box.addClass("crop");
	   }

		parentItem.find(".read-more-button").on("click",function(){
			box.removeClass("crop");
		});
		
      parentItem.find(".slide-read-more-button").on('click', function () {
         // get current height
         let currentHeight = box.innerHeight();

         // get height with auto applied
         let autoHeight = box.css('height', 'auto').innerHeight();

         // reset height and revert to original if current and auto are equal
         let newHeight = (currentHeight | 0) === (autoHeight | 0) ? minimumHeight : autoHeight;

         box.css('height', currentHeight).animate({
            height: (newHeight)
         })
        parentItem.find(".slide-read-more-button").toggle();

		if (!$(this).hasClass("read-more-button")) box.addClass("crop");
      });
	});

// открываем модалки с авторизацией и регистрацией
$(".openLoginPopup").click(function (e) {
	e.preventDefault();

	let loginPopupName = $(this).attr("href");
	
	if ($(".login__popup.opened").not($(loginPopupName)).length > 0) {
		let loginPopupOther = "#"+$(".login__popup.opened").not($(loginPopupName)).attr("id"),
			timelineLoginClose = gsap.timeline({
				paused: false,
				reversed: false,
				onComplete: function () {
					$(loginPopupOther).removeClass("opened");
				}
			});

		timelineLoginClose.to(loginPopupOther+" .login__popup-wrap", {
				xPercent: 100,
				duration: 0.4,
				autoAlpha: 0
			})
			.to(loginPopupOther+" .login__popup-overlay", {
				autoAlpha: 0
			})
			.to(loginPopupOther, {
				autoAlpha: 0
			});

		timelineLoginClose.timeScale(1.2);

		timelineLoginClose.play();
	}
	
	$("body").addClass("fixed");
	$(loginPopupName).show().addClass("opened");

	let timelineLogin = gsap.timeline({
		paused: false,
		reversed: false
	});

	timelineLogin.to(loginPopupName, {
			autoAlpha: 1
		})
		.to($(loginPopupName).find(".login__popup-overlay"), {
			autoAlpha: 0.4
		})
		.to($(loginPopupName).find(".login__popup-wrap"), {
			xPercent: -100,
			duration: 0.4,
			autoAlpha: 1
		});

	timelineLogin.play();
});

// закрываем модалки с авторизацией и регистрацией
$("body").on("click", ".login__popup-overlay, .login__popup-close", function (e) {
	e.preventDefault();

	let timelineLogin = gsap.timeline({
		paused: false,
		reversed: false,
		onComplete: function () {
			$(".login__popup.opened").removeClass("opened");
		}
	});

	timelineLogin.to(".login__popup.opened .login__popup-wrap", {
			xPercent: 100,
			duration: 0.4,
			autoAlpha: 0
		})
		.to(".login__popup.opened .login__popup-overlay", {
			autoAlpha: 0
		})
		.to(".login__popup.opened", {
			autoAlpha: 0
		});

	timelineLogin.timeScale(1.2);

	timelineLogin.play();
	
	$("body").removeClass("fixed");
	
	$(this).closest(".login__popup").find("form").each(function(){
		$(this).trigger("reset");
	});
	$(this).closest(".login__popup").find(".login__popup-section.active").removeClass("active");
	$(this).closest(".login__popup").find(".login__popup-section[data-section='1']").addClass("active");
});

// генерация пароля в авторизации
$("#generate__password").click(function(){
	let parentElement = $(this).closest(".login__popup-form__group");
	function genPassword() {
		var chars = "0123456789abcdefghijklmnopqrstuvwxyz!@#$%^&*()ABCDEFGHIJKLMNOPQRSTUVWXYZ";
		var passwordLength = 12;
		var password = "";
		for (var i = 0; i <= passwordLength; i++) {
			var randomNumber = Math.floor(Math.random() * chars.length);
	   		password += chars.substring(randomNumber, randomNumber +1);
		}
		return password;
	 }
	 var password = genPassword();
	parentElement.find('[name="REGISTER[PASSWORD]"]').val(password);
	parentElement.find('[name="REGISTER[CONFIRM_PASSWORD]"]').val(password);
});

// смена секций восстановление пароля
$(".changeSection").click(function(e){
	if ($(this).hasClass("hoverMe")) e.preventDefault();
	let numberSection = $(this).attr("data-section");
	if ($(this).closest(".login__popup-inner").find(".login__popup-section[data-section='"+numberSection+"']").length > 0) {
		$(this).closest(".login__popup-section").removeClass("active");
		$(this).closest(".login__popup-inner").find(".login__popup-section[data-section='"+numberSection+"']").addClass("active");
	}
});

// открываем модалки в профиле
$(".openProfilePopup").click(function (e) {
	
	if (location.href.indexOf("personal") > 0) {
		e.preventDefault();
		let needPopup = $(this).attr("href");

		$("body").addClass("fixed");
		
		if (needPopup.indexOf("personal") > 0) {
//			console.log("123");
			needPopup = needPopup.replace("/personal/projects/","");
		}
		
		$("body .profile__popup"+needPopup).show().addClass("opened");

		let timelineContributors = gsap.timeline({
			paused: false,
			reversed: false
		});

		timelineContributors.to("body .profile__popup"+needPopup, {
				autoAlpha: 1
			})
			.to($("body .profile__popup"+needPopup+" .profile__popup-overlay"), {
				autoAlpha: 0.4
			})
			.to($("body .profile__popup"+needPopup+" .profile__popup-inner"), {
				xPercent: -100,
				duration: 0.4,
				autoAlpha: 1
			});

		timelineContributors.timeScale(1.2);

		timelineContributors.play();
	}
});

// закрываем модалки в профиле
$("body").on("click", ".profile__popup-overlay, .profile__popup-close", function (e) {
	e.preventDefault();
	
	let currentPopupProfile = $(this).closest(".profile__popup");

	let timelineContributors = gsap.timeline({
		paused: false,
		reversed: false,
		onComplete: function () {
			
		}
	});

	timelineContributors.to(".profile__popup.opened .profile__popup-inner", {
			xPercent: 100,
			duration: 0.4,
			autoAlpha: 0
		})
		.to(".profile__popup.opened .profile__popup-overlay", {
			autoAlpha: 0
		})
		.to(".profile__popup.opened", {
			autoAlpha: 0
		});

	timelineContributors.timeScale(1.2);

	timelineContributors.play();
	
	$("body").removeClass("fixed");
	
	var uri = window.location.toString();
	if (uri.indexOf("#") > 0) {
		var clean_uri = uri.substring(0, uri.indexOf("#"));
		window.history.replaceState({}, document.title, clean_uri);
	}

});

// показать кнопку в удалении аккаунта
$('[name="removedaccount"]').change(function(){
	$(".popup__settings-delete__action").toggle();
});

// скрыть пароль под звездочки
$(".passwordHidden").each(function(){
	$(this).text('*'.repeat($(this).text().length));
});

// показать следующую секцию в settings profile login
$(".popup__settings-login__edit a").click(function(){
	let currentSection = $(this).closest(".popup__settings-login__section");
	currentSection.removeClass("active");
	currentSection.next(".popup__settings-login__section").show();
});

// показать предыдущую секцию в settings profile login
$(".popup__settings-login__form").submit(function(){
	let currentSection = $(this).closest(".popup__settings-login__section");
	currentSection.hide();
	currentSection.prev(".popup__settings-login__section").show();
});

// выбрать обложку
$(".popup__settings-cover__buttons span[data-type='edit']").click(function(){
	$(".popup__settings-cover__form-input").click();
});
// удалить обложку
$(".popup__settings-cover__buttons span[data-type='delete']").click(function(){
//	$('.popup__settings-cover__image img').attr("src","/images/profile/cover.png");
	$(".popup__settings-cover__form-input").val(null);
	var form = $(this).closest('form');
	var formData = new FormData($(this).closest('form')[0]);
	if($(form).valid()) {
		$.ajax({
			type: "POST",
			url: '/ajax.php',
			data: formData,
			contentType: false,
			processData: false,
			success: function (data) {
				if(data == 'true') {
					location.reload();
				}
			}
		});
	}
});
$(".popup__settings-cover__form-input").change(function(){
	$(".popup__settings-section__cover > .popup__settings-cover__media").hide();
	$(".popup__settings-cover__form").show();
	if (this.files && this.files[0]) {
		var reader = new FileReader();
		reader.onload = function (e) {
			$('.popup__settings-cover__form .popup__settings-cover__image img').attr('src', e.target.result);
		}
		reader.readAsDataURL(this.files[0]);
	}
});

// вернуться обратно
$(".popup__settings-cover__tools-cancel").click(function(){
	$(".popup__settings-cover__form").hide();
	$(".popup__settings-section__cover > .popup__settings-cover__media").show();
	$(".popup__settings-cover__form-input").find("input[type='file']").val();
});

document.addEventListener('DOMContentLoaded', createSelect, false);
function createSelect() {
    var select = $(".popup__settings-login__select").find('select'),
      liElement,
      ulElement,
      optionValue,
      iElement,
      optionText,
      selectDropdown,
      elementParentSpan;

      for (var select_i = 0, len = select.length; select_i < len; select_i++) {
        //console.log('selects init');

      select[select_i].style.display = 'none';
      wrapElement(document.getElementById(select[select_i].id), document.createElement('div'), select_i, select[select_i].getAttribute('placeholder-text'));

      for (var i = 0; i < select[select_i].options.length; i++) {
        liElement = document.createElement("li");
        optionValue = select[select_i].options[i].value;
        optionText = document.createTextNode(select[select_i].options[i].text);
        liElement.className = 'select-dropdown__list-item';
        liElement.setAttribute('data-value', optionValue);
        liElement.appendChild(optionText);
        ulElement.appendChild(liElement);

        liElement.addEventListener('click', function () {
          displyUl(this);
        }, false);
      }
    }
    function wrapElement(el, wrapper, i, placeholder) {
      el.parentNode.insertBefore(wrapper, el);
      wrapper.appendChild(el);

      document.addEventListener('click', function (e) {
        let clickInside = wrapper.contains(e.target);
        if (!clickInside) {
          let menu = wrapper.getElementsByClassName('select-dropdown__list');
          menu[0].classList.remove('active');
        }
      });

      var buttonElement = document.createElement("button"),
        spanElement = document.createElement("span"),
        spanText = document.createTextNode(placeholder);
        iElement = document.createElement("i");
        ulElement = document.createElement("ul");

      wrapper.className = 'select-dropdown select-dropdown--' + i;
      buttonElement.className = 'select-dropdown__button select-dropdown__button--' + i;
      buttonElement.setAttribute('data-value', '');
      buttonElement.setAttribute('type', 'button');
      spanElement.className = 'select-dropdown select-dropdown--' + i;
      iElement.className = 'zmdi zmdi-chevron-down';
      ulElement.className = 'select-dropdown__list select-dropdown__list--' + i;
      ulElement.id = 'select-dropdown__list-' + i;

      wrapper.appendChild(buttonElement);
      spanElement.appendChild(spanText);
      buttonElement.appendChild(spanElement);
      buttonElement.appendChild(iElement);
      wrapper.appendChild(ulElement);
    }

    function displyUl(element) {

      if (element.tagName == 'BUTTON') {
        selectDropdown = element.parentNode.getElementsByTagName('ul');
        //var labelWrapper = document.getElementsByClassName('js-label-wrapper');
        for (var i = 0, len = selectDropdown.length; i < len; i++) {
          selectDropdown[i].classList.toggle("active");
          //var parentNode = $(selectDropdown[i]).closest('.js-label-wrapper');
          //parentNode[0].classList.toggle("active");
        }
      } else if (element.tagName == 'LI') {
        var selectId = element.parentNode.parentNode.getElementsByTagName('select')[0];
        selectElement(selectId.id, element.getAttribute('data-value'));
        elementParentSpan = element.parentNode.parentNode.getElementsByTagName('span');
        element.parentNode.classList.toggle("active");
        elementParentSpan[0].textContent = element.textContent;
        elementParentSpan[0].parentNode.setAttribute('data-value', element.getAttribute('data-value'));
      }

    }
    function selectElement(id, valueToSelect) {
      var element = document.getElementById(id);
      element.value = valueToSelect;
      element.setAttribute('selected', 'selected');
    }
    var buttonSelect = document.getElementsByClassName('select-dropdown__button');
    for (var i = 0, len = buttonSelect.length; i < len; i++) {
      buttonSelect[i].addEventListener('click', function (e) {
				e.preventDefault();
				displyUl(this);
			}, false);
		}
}

// переключение секций в профиле
$(".profile__acc-box__edit a").click(function(e){
	e.preventDefault();
	let currentSection = $(this).closest(".profile__acc-box__section.active");
	currentSection.removeClass("active");
	currentSection.next(".profile__acc-box__section").show();
});

// табы в профиле слева
$(".profile__tabs-select__item").click(function(e){
	e.preventDefault();
	let indexItem = $(this).index();
	
	if ($(".profile__event").length > 0) {
		if (indexItem == 1)
			$(".profile__events-times").hide();
		else
			$(".profile__events-times").show();
	}
	
	$(".profile__tabs-select__item.active").removeClass("active");
	$(".profile__tabs-body__item.active").removeClass("active");
	$(".profile__tabs-body__item").eq(indexItem).addClass("active");
	$(this).addClass("active");
});

// переключение в опросах
$(".vote__item").click(function(){
	let parentForm = $(this).closest(".vote__form");
	parentForm.find(".vote__item.checked").removeClass("checked");
	parentForm.find("input").prop('checked', false);
	$(this).addClass("checked");
	$(this).find("input").prop('checked', true);
});

// прикрепление файла в callback form
$('.callback__form-file input[type=file]').on('change', function(){
	let file = this.files[0];
	$(this).next().attr("data-attr",file.name);
	$(this).next().addClass("active");
});

// скрытие/показ секций в курсах в профиле
$(".profile__courses-item__more").click(function(e){
	e.preventDefault();
	let currentSection = $(this).closest(".profile__courses-item__section"),
		currentSectionIndex = $(this).closest(".profile__courses-item__section").index(),
		parentCourse = currentSection.closest(".profile__course");
	currentSection.removeClass("active");
	if (currentSectionIndex == 0)
		parentCourse.find(".profile__courses-item__section").eq(1).addClass("active");
	else
		parentCourse.find(".profile__courses-item__section").eq(0).addClass("active");
});

$("a.profile__courses-item__section").click(function(e){
	e.preventDefault();
	let currentSection = $(this),
		currentSectionIndex = $(this).index(),
		parentCourse = currentSection.closest(".profile__course");
	currentSection.removeClass("active");
	if (currentSectionIndex == 0)
		parentCourse.find(".profile__courses-item__section").eq(1).addClass("active");
	else
		parentCourse.find(".profile__courses-item__section").eq(0).addClass("active");
});


$(".downloadCert").click(function(){
	let cert_color = $(this).attr("data-type"),
		pdfContent = document.querySelector("#"+cert_color),
		optionArray = {
			margin:       0,
		  	filename:     'cert.pdf',
		  	image:        { type: 'jpg', quality: 1 },
		  	html2canvas:  { scale: 4.01 },
		  	jsPDF:        { orientation: 'landscape', compress: true }
		};

	// html to pdf generation with the reference of PDF worker object
	html2pdf().set(optionArray).from(pdfContent).save();
});

// менюшка в header profile
$(".header__profile-photo").click(function(){
	$("body").toggleClass("fixed");
	$(".header__profile-menu").toggleClass("show");
});

$(".header__profile-overlay").click(function(){
	$("body").removeClass("fixed");
	$(".header__profile-menu").removeClass("show");
});

// поиск
$(".header__search-open").click(function(){
	$(".header__menu .dropdown").each(function(){
		if ($(this).hasClass("opened")) {
			$(this).removeClass("opened");
		}
	});
	if (!$("body").hasClass("searchFull")) {
		$(".search__overlay").addClass("show");
		$("body").addClass("fixed");
	}
	$(".header__search-form__wrap").addClass("opened");
});

$(".header__search-form__close").click(function(e){
	e.preventDefault();
	$(".header__search-form__input").val("");
	$("body").removeClass("fixed");
	$(".search__overlay").removeClass("show");
	$(".header__search-form__wrap").removeClass("opened");
	$("header .search__results-inner").addClass("hidden");
});

$(".search__results-tabs__head a").click(function(){
	$(".search__results-tabs__head a.current").removeClass("current");
	$(this).addClass("current");
	// let currentCat = $(this).attr("data-cat");
	// $(".search__results-tabs__body-item.current").removeClass("current");
	// $(".search__results-tabs__body-item[data-cat='"+currentCat+"']").addClass("current");
});

var $voiceTrigger = $("#voice-trigger");
var $searchInput = $(".header__search-form__input input");

/*  set Web Speech API for Chrome or Firefox */
window.SpeechRecognition = window.SpeechRecognition || window.webkitSpeechRecognition;
/* Check if browser support Web Speech API, remove the voice trigger if not supported */
if (window.SpeechRecognition) {

    /* setup Speech Recognition */
    var recognition = new SpeechRecognition();
    recognition.interimResults = true;
	
	if ($("body").attr("data-lang") == "en")
		recognition.lang = 'en-US';
	else
		recognition.lang = 'ru-RU';
    recognition.addEventListener('result', _transcriptHandler);

    recognition.onerror = function(event) {
//        console.log(event.error);

        /* Revert input and icon CSS if no speech is detected */
        if(event.error == 'no-speech'){
            $voiceTrigger.removeClass('active');
        }
    }
} else {
    $voiceTrigger.remove();
}

$voiceTrigger.on('click touch', listenStart);

function listenStart(e){
    e.preventDefault();
	if ($voiceTrigger.hasClass("active")) {
		$voiceTrigger.removeClass('active');
		/* Start voice recognition */
		recognition.stop();
	} else {
		$voiceTrigger.addClass('active');
		/* Start voice recognition */
		recognition.start();
	}
}

/* Parse voice input */
function _parseTranscript(e) {
    return Array.from(e.results).map(function (result) { return result[0] }).map(function (result) { return result.transcript }).join('')
}

/* Convert our voice input into text and submit the form */
function _transcriptHandler(e) {
    var speechOutput = _parseTranscript(e)
    $searchInput.val(speechOutput);
//	console.log(e.results[0]);
	if (e.results[0].isFinal) {
		searchDo();
		$voiceTrigger.removeClass('active');
	}
}

// функция для запроса и обработки результата
function searchDo(){
	let findText = $searchInput.val();

	$(".search__results-body__item-desc,.search__results-tabs__body-item__media-item__title,.search__results-body__item-docs__title").each(function(){
		$(this).html($(this).text().replace(new RegExp('(' + $searchInput.val() + ')', 'gi'),' <span class="searchHighlight">$1</span> '));
	});
	if(findText != '') {
		$.ajax({
			url: '/search/?q=' + findText,
			method: 'post',
			data: {ajaxHeader: 'Y'},
			success: function (data) {
				$('header .search__results-wrap').html(data);
				$("header .search__results-inner").removeClass("hidden");
			}
		});
	}
}

$(".header__search-form__clear").click(function(){
	$searchInput.val("");
	$voiceTrigger.removeClass('active');
	$("header .search__results-inner").addClass("hidden");
});

$(".header__search-form__do").click(function(e){
	e.preventDefault();
	let findText = $searchInput.val();
	window.location.href = '/search/?q=' + findText;
});

$searchInput.keyup(function(event) {
    if (event.keyCode === 13) {
        searchDo();
    }
});

$(".search__results-overlay").on("mouseover",function (e) {
	e.preventDefault();
	$(".search__results-inner").addClass("hidden");
})


$(".pv__main-media").click(function(){
	if ($(this).find(".pv__main-poster").length > 0) {
		$(this).addClass("opened");
	}
});

$(".login__popup-form__password").each(function(){
	$(this).find("input").attr("type","password");
});

$(".login__popup-form__password-hide").click(function(){
	if (!$(this).hasClass("active"))
		$(this).closest(".login__popup-form__password").find("input[type='password']").attr('type', 'text');
	else
		$(this).closest(".login__popup-form__password").find("input[type='text']").attr('type', 'password');
	$(this).toggleClass("active");
});

// обработка даты рождения
if ($("#datebirth").length > 0) {
	$('#datebirth').datepicker({
		language: 'ru',
		minDate: new Date(1900, 0, 1),
		maxDate: new Date()
	})
	$.fn.datepicker.language['ru'] = {
		days: ['Воскресенье', 'Понедельник', 'Вторник', 'Среда', 'Четверг', 'Пятница', 'Суббота'],
		daysShort: ['Вос','Пон','Вто','Сре','Чет','Пят','Суб'],
		daysMin: ['Вс','Пн','Вт','Ср','Чт','Пт','Сб'],
		months: ['Январь', 'Февраль', 'Март', 'Апрель', 'Май', 'Июнь', 'Июль', 'Август', 'Сентябрь', 'Октябрь', 'Ноябрь', 'Декабрь'],
		monthsShort: ['Янв', 'Фев', 'Мар', 'Апр', 'Май', 'Июн', 'Июл', 'Авг', 'Сен', 'Окт', 'Ноя', 'Дек'],
		today: 'Сегодня',
		clear: 'Очистить',
		dateFormat: 'dd.MM.yyyy',
		timeFormat: 'HH:mm',
		firstDay: 1
	};
}

// открыть настройки, если такой хэш на странице
if (location.href.indexOf("personal") > 0) {
	if (location.hash) {
		let hashPage = location.hash;
		if (hashPage == "#settings" || hashPage == "#notify") {
			$(".openProfilePopup[href='"+hashPage+"']").trigger("click");
		}
	}
}

// перенаправляем изучить
$(".profile__courses-empty").click(function(e){
	e.preventDefault();
	$(".profile__tabs-select").find(".profile__tabs-select__item").eq(2).trigger("click");
});

// подключаем маску телефона
function validate() {
	var number = $(el).intlTelInput('getNumber');
	iso = $(el).intlTelInput('getSelectedCountryData').iso2;

	var exampleNumber = intlTelInputUtils.getExampleNumber(iso, 0, 0);
	if (number == '')
		number = exampleNumber;

	var formattedNumber = intlTelInputUtils.formatNumber(number, iso, intlTelInputUtils.numberFormat.NATIONAL);
	var isValidNumber = intlTelInputUtils.isValidNumber(number, iso);
	var validationError = intlTelInputUtils.getValidationError(number, iso);

//	console.log(number);
//	console.log(formattedNumber);
//	console.log(intlTelInputUtils.formatNumber(number, iso, intlTelInputUtils.numberFormat.INTERNATIONAL));
//	console.log(intlTelInputUtils.formatNumber(number, iso, intlTelInputUtils.numberFormat.E164));
//	console.log(intlTelInputUtils.formatNumber(number, iso, intlTelInputUtils.numberFormat.RFC3966));
//	console.log(isValidNumber);
//	console.log(validationError);
}

//var input = document.querySelector('[name="PERSONAL_PHONE"],#CALLBACK_PHONE');

$('[name="PERSONAL_PHONE"],#CALLBACK_PHONE').intlTelInput({
	geoIpLookup: function (callback) {
		$.get("http://ipinfo.io", function () { }, "jsonp").always(function (resp) {
			var countryCode = (resp && resp.country) ? resp.country : "";
			callback(countryCode);
		});
	},
	//hiddenInput: "full_number",
	initialCountry: "ru",
	separateDialCode: false,
	autoPlaceholder: "on",
});
$('[name="PERSONAL_PHONE"],#CALLBACK_PHONE').on('countrychange', function (e) {
	$(this).val('');
	var selectedCountry = $(this).intlTelInput('getSelectedCountryData');
	var dialCode = selectedCountry.dialCode;
	var maskNumber = intlTelInputUtils.getExampleNumber(selectedCountry.iso2, 0, 0);
//	console.log("placeholder > " + maskNumber);
	maskNumber = intlTelInputUtils.formatNumber(maskNumber, selectedCountry.iso2, 2);
//	console.log("placeholder > " + maskNumber);
	maskNumber = maskNumber.replace('+' + dialCode + ' ', '');
//	console.log("placeholder > " + maskNumber);
	mask = maskNumber.replace(/[0-9+]/ig, '0');
	maskPlaceHolder = mask.replace(/[0-9+]/ig, '_');
	$("#"+$(this).attr("id")).mask("+"+dialCode+" "+mask, { placeholder: maskPlaceHolder });
});
$('[name="PERSONAL_PHONE"],#CALLBACK_PHONE').each(function (e) {
	var selectedCountry = $(this).intlTelInput('getSelectedCountryData');
	var dialCode = selectedCountry.dialCode;
	var maskNumber = intlTelInputUtils.getExampleNumber(selectedCountry.iso2, 0, 0);
//	console.log("placeholder > " + maskNumber);
	maskNumber = intlTelInputUtils.formatNumber(maskNumber, selectedCountry.iso2, 2);
//	console.log("placeholder > " + maskNumber);
	maskNumber = maskNumber.replace('+' + dialCode + ' ', '');
//	console.log("placeholder > " + maskNumber);
	mask = maskNumber.replace(/[0-9+]/ig, '0');
	//maskPlaceHolder = mask.replace(/[0-9+]/ig, '_');
	$("#"+$(this).attr("id")).mask(mask, { placeholder: mask });
});

// политика баннер
function getCookie(name) {
	let matches = document.cookie.match(new RegExp(
		"(?:^|; )" + name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, '\\$1') + "=([^;]*)"
	));
	return matches ? decodeURIComponent(matches[1]) : undefined;
}
function setCookie(name, value, options = {}) {
	options = {
		path: '/',
	};

  if (options.expires instanceof Date) {
    options.expires = options.expires.toUTCString();
  }

  let updatedCookie = encodeURIComponent(name) + "=" + encodeURIComponent(value);

  for (let optionKey in options) {
    updatedCookie += "; " + optionKey;
    let optionValue = options[optionKey];
    if (optionValue !== true) {
      updatedCookie += "=" + optionValue;
    }
  }

  document.cookie = updatedCookie;
}

if (getCookie("policyBanner") == "yes") $(".policy").addClass("hide");
$(".policy__button").click(function(e){
	e.preventDefault();
	setCookie('policyBanner', 'yes', {secure: true, 'max-age': 360000});
	$(".policy").addClass("hide");
});

// открытие выпадающего меню на мобилке
$(".dropdown__mob .openDropdown").click(function(e){
	e.preventDefault();
	$(".dropdown__mob-list").not($(this).next(".dropdown__mob-list")).slideUp();
	$(this).next(".dropdown__mob-list").slideToggle();
});