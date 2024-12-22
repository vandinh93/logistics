import gsap from 'gsap'
import { ScrollTrigger } from 'gsap/ScrollTrigger'
gsap.registerPlugin(ScrollTrigger)

const FADE_IN_SELECTOR = '[data-animation="fade-in"]'
const FADE_UP_SELECTOR = '[data-animation="fade-up"]'

export const fadeIn = (elms) => {
  ScrollTrigger.batch(elms, {
    start: 'top 90%',
    trigger: this,
    once: true,
    onEnter: elements => {
      gsap.to(elements, { opacity: 1, stagger: 0.05, duration: 1})
    },
  })
}
export const fadeUp = (elms) => {
  ScrollTrigger.batch(elms, {
    start: 'top 90%',
    trigger: this,
    once: true,
    onEnter: elements => {
      gsap.to(elements, { opacity: 1, y: 0, stagger: 0.1, duration: 1 })
    },
  })
}
export default () => {
  const fadeInEls = document.querySelectorAll(FADE_IN_SELECTOR)
  const fadeUpEls = document.querySelectorAll(FADE_UP_SELECTOR)
  if (fadeInEls && fadeInEls.length) {
    gsap.set(fadeInEls, {opacity: 0})
    fadeIn(fadeInEls)
  }

  if (fadeUpEls && fadeUpEls.length) {
    gsap.set(fadeUpEls, {opacity: 0, y: 50})
    fadeUp(fadeUpEls)
  }
}
