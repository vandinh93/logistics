import init from './lib/init'
import { ready, select } from './lib/util'
import Lenis from 'lenis'
import barba from '@barba/core'
import gsap from 'gsap'
import { CustomEase } from "gsap/CustomEase";
import { updateLazyLoad } from '../../components/image/image'

import initScrollAnimation from './scroll-animation'

const main = () => {
  init({
    module: 'modules'
  }).mount()

  // Handler when the DOM is fully loaded
  const lenis = new Lenis({
    lerp: 0.1,
    wheelMultiplier: 0.7,
    gestureOrientation: 'vertical',
    smoothWheel: true
  })

  function raf (time) {
    lenis.raf(time)
    requestAnimationFrame(raf)
  }

  requestAnimationFrame(raf)
  document.body.addEventListener('lenis-stop', () => {
    lenis.stop()
  })
  document.body.addEventListener('lenis-start', () => {
    lenis.start()
  })

  initScrollAnimation()
}

// Init page transitions
const LOADING_SELECTOR = '.js-loading'
const LOADER_SELECTOR = '.js-loading-panel'
const initPageTransition = () => {
  const loadingEl = select(LOADING_SELECTOR)
  const loader = select(LOADER_SELECTOR)
  gsap.registerPlugin(CustomEase);
  // parallax percentage
  const yParallax = 15;

  const tl = gsap.timeline({
    defaults: {
      duration: 0.6,
      ease: CustomEase.create("easeName", "0.56, 0.01, 0.17, 0.98")
    }
  });
  // show loader on window load
  window.addEventListener('load', () => {
    if (loader) {
      tl.fromTo(
        loader,
        {
          yPercent: 0,
          clipPath: "inset(0% 0% 0% 0%)"
        },
        {
          yPercent: -yParallax,
          clipPath: "inset(0% 0% " + (100 - yParallax) + "% 0)"
        }
      );
      tl.set(loadingEl, { display: 'none' });
    }
  })
  barba.init({
    transitions: [{
      name: 'slide-down-transition',
      leave (data) {
        if (loader && loadingEl) {
          tl.set(loadingEl, { display: 'block' });
          tl.fromTo(
            loader,
            {
              yPercent: yParallax,
              clipPath: "inset(" + (100 - yParallax) + "% 0% 0% 0%)"
            },
            {
              yPercent: 0,
              clipPath: "inset(0% 0% 0% 0%)"
            }
          );
        }
      },
      after (data) {
        // scroll to top
        window.scrollTo(0, 0)
        // init main JS
        main()
        // reinit images
        updateLazyLoad()
        // reveal page
        if (loader && loadingEl) {
          tl.fromTo(
            loader,
            {
              yPercent: 0,
              clipPath: "inset(0% 0% 0% 0%)"
            },
            {
              yPercent: -yParallax,
              clipPath: "inset(0% 0% " + (100 - yParallax) + "% 0)"
            }
          );
          tl.set(loadingEl, { display: 'none' });
        }
      },
      afterEnter(data) {
        // Initialize Gravity Forms if present
        if (data.next.container.querySelector('.gform_wrapper')) {
          window.gform.initializeOnLoaded();
        }
      }
    }]
  })
}

ready(() => {
  main()
  initPageTransition()
})
