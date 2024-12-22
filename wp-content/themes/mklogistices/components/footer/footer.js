import { gsap, ScrollTrigger } from 'gsap/all'
gsap.registerPlugin(ScrollTrigger)
export default el => {
  let footerTl
  const footerContent = el.querySelector('.js-footer-content')

  footerTl = gsap.matchMedia()
  footerTl.add("(min-width: 768px)", () => {
    footerTl = gsap.timeline({
      paused: true,
      scrollTrigger: {
        trigger: '.js-main',
        start: 'bottom bottom',
        end: '+=90%',
        scrub: true,
      }
    })
    const yOffset = -1 * window.innerHeight / 3
    footerContent && footerTl.fromTo(footerContent, { y: yOffset }, { y: 0, ease: 'power3.out' })
  })
}
