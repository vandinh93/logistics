import gsap from 'gsap'
import { ScrollTrigger } from 'gsap/ScrollTrigger'
import { select, selectAll, set, unset, contains } from '../../src/js/lib/util'
gsap.registerPlugin(ScrollTrigger)

const selectors = {
  SELECT_SELECTOR: '.js-select-field',
  SELECT_OPTION_DESKTOP_SELECTOR: '.js-field-option-desktop',
  SELECT_OPTION_SELECTOR: '.js-field-option',
  SELECT_VALUE_SELECTOR: '.js-field-value',
  SELECT_VALUE_TEXT_SELECTOR: '.js-field-value-text',
  NATIVE_SELECT_SELECTOR: '.js-field-mobile',
  GFIELD_SELECTOR: '.gfield:not(.gsection)',
  LINES_SELECTOR: '.js-contact-form-line',
  OPENED_CLASS: 'opened',
  SELECTED_CLASS: 'selected',
  LINE_ROW_SELECTOR: '.js-line-row',
  LINE_COL_SELECTOR: '.js-line-col'
}

const TABLET_BREAKPOINT = 768
const MAX_DESKTOP_BREAKPOINT = '(max-width: 1199px)'
const DESKTOP_BREAKPOINT = '(min-width: 1200px)'

export default el => {
  const linesEl = select(selectors.LINES_SELECTOR, el)
  const lineRowEls = selectAll(selectors.LINE_ROW_SELECTOR, el)
  const lineColEls = selectAll(selectors.LINE_COL_SELECTOR, el)
  let selectOptionDesktopEls = selectAll(selectors.SELECT_OPTION_DESKTOP_SELECTOR, el)
  let selectOptionEls = selectAll(selectors.SELECT_OPTION_SELECTOR, el)
  let selectValueEl = select(selectors.SELECT_VALUE_SELECTOR, el)
  let selectValueTextEl = select(selectors.SELECT_VALUE_TEXT_SELECTOR, el)
  let nativeSelectEl = select(selectors.NATIVE_SELECT_SELECTOR, el)
  let mm = gsap.matchMedia()

  if (lineRowEls.length > 0) {
    lineRowEls.forEach(line => {
      mm.add(MAX_DESKTOP_BREAKPOINT, () => {
        gsap.from(line, {
          scaleX: 0,
          duration: 1,
          transformOrigin: "center center",
          ease: "power2.inOut",
          scrollTrigger: {
            trigger: line,
            start: "top 95%",
          }
        })
      })
    })
  }

  if (lineColEls.length > 0) {
    lineColEls.forEach(line => {
      mm.add(MAX_DESKTOP_BREAKPOINT, () => {
        gsap.from(line, {
          scaleY: 0,
          duration: 1,
          transformOrigin: "top center",
          ease: "power2.inOut",
          scrollTrigger: {
            trigger: line,
            start: "top 95%",
          }
        })
      })
    })
  }

  mm.add(DESKTOP_BREAKPOINT, () => {
    ScrollTrigger.batch(el, {
      start: 'top 50%',
      trigger: el,
      once: true,
      onEnter: elements => {
        el.classList.add('line-active')
      },
    })
  })

  const toggleSelect = (selectValueEl) => {
    const selectEl = selectValueEl.closest(selectors.SELECT_SELECTOR)
    selectEl && selectEl.classList.toggle(selectors.OPENED_CLASS)
  }

  const updateQuerySelector = () => {
    selectOptionDesktopEls = selectAll(selectors.SELECT_OPTION_DESKTOP_SELECTOR, el)
    selectOptionEls = selectAll(selectors.SELECT_OPTION_SELECTOR, el)
    selectValueEl = select(selectors.SELECT_VALUE_SELECTOR, el)
    selectValueTextEl = select(selectors.SELECT_VALUE_TEXT_SELECTOR, el)
    nativeSelectEl = select(selectors.NATIVE_SELECT_SELECTOR, el)
  }

  const handleSelect = (e) => {
    const value = e.getAttribute('data-value')

    updateQuerySelector()
    handleSelectNative(value)
    highlightSelectedOption(value)
    closeSelect()
  }

  const highlightSelectedOption = (value) => {
    if (!selectValueEl || !selectOptionDesktopEls.length) return

    selectOptionDesktopEls.forEach((selectOption) => {
      if (selectOption.getAttribute('data-value') === value) {
        set(selectOption, selectors.SELECTED_CLASS)

        if (selectValueTextEl) {
          selectValueTextEl.innerText = selectOption.textContent
        }
      } else {
        unset(selectOption, selectors.SELECTED_CLASS)
      }
    })

    handleSelectNative(value)
  }

  const handleSelectNative = (value) => {
    nativeSelectEl && nativeSelectEl.setAttribute('value', value)

    if (selectOptionEls.length > 0 ) {
      selectOptionEls.forEach((selectOption) => {
        selectOption.removeAttribute('selected')
        if (selectOption.value === value) {
          selectOption.setAttribute('selected', 'selected')
        }
      })
    }
  }

  const closeSelect = () => {
    const selectEls = document.querySelectorAll(selectors.SELECT_SELECTOR)
    selectEls.length && selectEls.forEach(select => {
      unset(select, selectors.OPENED_CLASS)
    })
  }

  const focusGfield = (gfield) => {
    const focusableEl = select('input, textarea', gfield)

    if (focusableEl) {
      focusableEl.focus()
    }
  }

  const changeNativeSelect = (nativeSelectEl) => {
    if ( nativeSelectEl ) {
      nativeSelectEl.addEventListener('change', (e) => {
        updateQuerySelector()
        highlightSelectedOption(e.target.value)
        closeSelect()
      })
    }
  }

  const handleClick = (e) => {
    const selectValueEl = e.target.closest(selectors.SELECT_VALUE_SELECTOR)
    const selectOptionDesktopEl = e.target.closest(selectors.SELECT_OPTION_DESKTOP_SELECTOR)
    const gfieldEl = e.target.closest(selectors.GFIELD_SELECTOR)
    const nativeSelectEl = e.target.closest(selectors.NATIVE_SELECT_SELECTOR)

    if (nativeSelectEl) {
      changeNativeSelect(nativeSelectEl)
    }

    if (gfieldEl && !selectOptionDesktopEl && !selectValueEl) {
      if (contains(gfieldEl, 'gfield-select-custom')) {
        if (window.innerWidth >= TABLET_BREAKPOINT) {
          const selectValueEl = select(selectors.SELECT_VALUE_SELECTOR, gfieldEl)
          selectValueEl && toggleSelect(selectValueEl)
        } else {
          const nativeSelectEl = select(selectors.NATIVE_SELECT_SELECTOR, gfieldEl)
          nativeSelectEl && nativeSelectEl.focus()
        }
      } else {
        focusGfield(gfieldEl)
      }
    }

    if (selectOptionDesktopEl) {
      handleSelect(selectOptionDesktopEl)
    }

    if (selectValueEl) {
      toggleSelect(selectValueEl)
    } else if (gfieldEl && !contains(gfieldEl, 'gfield-select-custom')) {
      closeSelect()
    }
  }

  el.addEventListener('click', handleClick)

  if (linesEl) {
    const callback = (mutationList, observer) => {
      for (const mutation of mutationList) {
        if (mutation.type === 'childList') {
          const confirmEl = el.querySelector('.gform_confirmation_wrapper')
          if (!confirmEl) {
            return
          }
          set(linesEl, 'hidden')
        }
      }
    }
    const observer = new MutationObserver(callback)
    observer.observe(el, { attributes: true, childList: true, subtree: true })
  }
}
