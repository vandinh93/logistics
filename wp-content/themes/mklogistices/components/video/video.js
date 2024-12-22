import { select, set, unset, on } from '../../src/js/lib/util'

const selectors = {
  CLASS_PLAY: 'is-playing',
  VIDEO_SELECTR: '.js-video',
  PLAY_BUTTON_SELECTOR: '.js-play-button'
}

export default (el) => {
  const videoEl = select(selectors.VIDEO_SELECTR, el)
  const playTriggerEl = select(selectors.PLAY_BUTTON_SELECTOR, el)

  if (videoEl) {
    videoEl.onplay = () => {
      set(el, selectors.CLASS_PLAY)
    }

    videoEl.onpause = () => {
      unset(el, selectors.CLASS_PLAY)
    }

    const playVideo = () => {
      videoEl.play()
    }

    const pauseVideo = () => {
      videoEl.pause()
    }


    if (playTriggerEl) {
      on('click', () => {
        if (videoEl.paused) {
          playVideo()
        } else {
          pauseVideo()
        }
      }, playTriggerEl)
    } else {
      set(el, selectors.CLASS_PLAY)
      playVideo()
    }
  }
}
