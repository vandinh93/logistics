import init from './lib/init'
import { ready, select } from './lib/util'
import '@fortawesome/fontawesome-free/js/all.js'
import { CustomEase } from "gsap/CustomEase";
import { updateLazyLoad } from '../../components/image/image'

import initScrollAnimation from './scroll-animation'

const main = () => {
  init({
    module: 'modules'
  }).mount()
}

ready(() => {
  main()
})
