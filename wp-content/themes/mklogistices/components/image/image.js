import on from 'dom-event'
import { select, doesSupportObjectFit, style, getData, contains } from '../../src/js/lib/util'
import Layzr from 'layzr.js'
import throttle from 'lodash.throttle'

const wrapper = select('.wrapper')
const body = document.body
const LOADED_CLASS = 'image--loaded'
const DELAY_TIMING = 200

const instance = window.layzr = Layzr({
  threshold: DELAY_TIMING
})

const objectFit = doesSupportObjectFit()
if (!objectFit) body.classList.add('no-object-fit')

instance
  .on('src:before', image => {
    on(image, 'load', (event) => {
      const imageWrapper = image.parentNode
      imageWrapper.classList.add(LOADED_CLASS)
      const dataTrigger = imageWrapper.getAttribute('data-trigger')
      if (dataTrigger) {
        const customE = new CustomEvent('image-load', {
          detail: {
            name: dataTrigger,
          },
        })
        document.dispatchEvent(customE)
      }
    })
  })

instance
  .on('src:after', el => {
    const imageWrapper = el.parentNode

    if (!contains(imageWrapper, 'js-wrap')) return

    if (!objectFit) {
      const src = getData('normal', el)
      style('backgroundImage', 'url("' + src + '")', imageWrapper)
      imageWrapper.classList.add(LOADED_CLASS)
    }
  })

const updateLazyLoad = () => instance.update().check()

updateLazyLoad().handlers(true)

if (wrapper) {
  on(wrapper, 'scroll', throttle(updateLazyLoad, DELAY_TIMING))
} else {
  on(window, 'scroll', throttle(updateLazyLoad, DELAY_TIMING))
}

export default (el) => {}

export {
  updateLazyLoad
}
