import gsap from "gsap"
import { ScrollTrigger } from 'gsap/ScrollTrigger'
gsap.registerPlugin(ScrollTrigger)

import { set, contains } from '../../src/js/lib/util'

const FADE_IN_SELECTOR = '[data-animation="fade-in"]'
const FADE_UP_SELECTOR = '[data-animation="fade-up"]'
const BREAKPOINT_TABLET = 768
const LOADER_SELECTOR = '.js-loader--full-width-media' // disable this temporarily

export default el => {
  const loaderEl = document.querySelector(LOADER_SELECTOR)
  const lines = el.querySelector('.js-lines')
  const fixedLines = document.querySelector('.js-lines-fixed')
  const mediaEl = el.querySelector('.js-fwm-media')
  const contentEl = el.querySelector('.js-fwm-content')
  const textEls = el.querySelectorAll('.js-fade-text')
  const contentTextEls = el.querySelectorAll('.js-content-fade-text')
  const bgEl = el.querySelectorAll('.js-fwm-content-bg')
  const contentBlockEl = el.querySelectorAll('.js-fwm-content-block')
  const videoEl = el.querySelector('.js-fwm-media video')
  const fallbackVideoEl = videoEl ? videoEl.querySelector('img') : ''
  const imageDesktop = el.querySelector('.js-image-desktop-trigger')
  const imageMobile = el.querySelector('.js-image-mobile-trigger')
  const siblingEl = el.nextElementSibling
  let tl = gsap.timeline()

  contentEl && tl.set(contentEl, {opacity: 0})
  bgEl && tl.set(bgEl, {opacity: 0})
  contentBlockEl && tl.set(contentBlockEl, {opacity: 0})

  const hideLoader = () => {
    loaderEl && tl.to(loaderEl, { opacity: 0, duration: 1})
    loaderEl && tl.set(loaderEl, {display: 'none'})
    loaderEl && set(loaderEl, 'is-hidden')
    document.body && tl.set(document.body, {overflow: ''})
  }
  const handleAnimation = () => {
    // Show media
    mediaEl && tl.fromTo(mediaEl, {
        opacity: 0
      },
      {
        opacity: 1,
        duration: 0.3,
        onComplete: function() {
          addAnimationShowContent()
          setTimeout(() => {
            lines && lines.classList.add('lines--active')
          }, 500)
        }
      })
    hideLoader()
  }

  const addAnimationShowContent = () => {
    contentEl && tl.set(contentEl, {opacity: 1}, '-=0.3')
    tl.fromTo(textEls, { y: 50, opacity: 0 }, { y: 0, opacity: 1, duration: 0.8, stagger: 0.2 }, '-=0.3')
  }

  const addAnimationSibling = () => {
    if (siblingEl && !siblingEl.classList.contains('js-contact-form')) {
      const fadeInEls = siblingEl.querySelectorAll(FADE_IN_SELECTOR)
      const fadeUpEls = siblingEl.querySelectorAll(FADE_UP_SELECTOR)
      gsap.set(siblingEl, {opacity: 0})
      let siblingTl = gsap.timeline({
        scrollTrigger: {
          trigger: siblingEl,
          start: 'top 80%'
        }
      })
      const showFixedLines = () => {
        fixedLines && fixedLines.classList.add('lines--active')
      }
      const showContentSibling = () => {
        gsap.set(siblingEl, {opacity: 1})
        fadeUpEls.length && tl.fromTo(fadeUpEls, { y: 50, autoAlpha: 0, stagger: 0.15 }, { y: 0, autoAlpha: 1, duration: 0.5, stagger: 0.15 })
        fadeInEls.length && tl.fromTo(fadeInEls, { autoAlpha: 0, stagger: 0.15 }, { autoAlpha: 1, duration: 0.5, stagger: 0.15 })
      }
      siblingTl.add(showFixedLines)
      siblingTl.add(showContentSibling, '+=1')
    }
  }

  const showContentBlock = () => {
    let contentBlockTl = gsap.timeline({
      scrollTrigger: {
        trigger: contentBlockEl,
        start: 'top 80%'
      }
    })
    bgEl && contentBlockTl.to(bgEl, { opacity: 1, duration: 0.5 })
    contentBlockEl && contentBlockTl.set(contentBlockEl, { opacity: 1 })
    contentTextEls.length && contentBlockTl.fromTo(contentTextEls, { y: 50, opacity: 0 }, { y: 0, opacity: 1, duration: 0.7, stagger: 0.2 })
  }

  const initAnimation = () => {
    handleAnimation()
    showContentBlock()
    addAnimationSibling()
  }

  let count = 1
  if (fallbackVideoEl) {
    fallbackVideoEl.addEventListener('load', () => {
      if (count === 1) {
        initAnimation()
        count++
      }
    })
  } else if (window.innerWidth >= BREAKPOINT_TABLET && imageDesktop) {
    imageDesktop.addEventListener('load', () => {
      if (count === 1) {
        initAnimation()
        count++
      }
    })
  } else if (window.innerWidth < BREAKPOINT_TABLET && imageMobile) {
    imageMobile.addEventListener('load', () => {
      if (count === 1) {
        initAnimation()
        count++
      }
    })
  } else {
    initAnimation()
  }

  const backupInitAnimation = () => {
    if (loaderEl && !contains(loaderEl, 'is-hidden')) {
      initAnimation()
    }
  }
  setTimeout(() => {
    backupInitAnimation()
  }, 6000)
}
