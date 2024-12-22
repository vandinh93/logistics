/**
 * Returns a curried function of the provided function, so that:
 *
 * f(a, b, c) = f(a, b)(c) = f(a)(b)(c) = f(a)(b, c)
 *
 * @param {Function} f
 * @param {..*} Initial parameters
 * @return {Function} The curried function
 */
const curry = (f, ...args) => args.length >= f.length ? f(...args) : curry.bind(this, f, ...args)
/**
 * Adds a class to a DOM Node.
 *
 * @param {*} item
 * @param {*} selector
 */
export const set = (item, selector) => {
  if (item instanceof Array) {
    for (let i of item) {
      i.classList.add(selector)
    }
  } else {
    item.classList.add(selector)
  }
}

/**
 * Removes a class from a DOM Node.
 *
 * @param {*} item
 * @param {*} selector
 */
export const unset = (item, selector) => {
  if (item instanceof Array) {
    for (let i of item) {
      i.classList.remove(selector)
    }
  } else {
    item.classList.remove(selector)
  }
}

/**
 * Checks to see whether a DOM Node
 * has a class.
 *
 * @param {*} item
 * @param {*} selector
 */
export const contains = (item, selector) => item.classList.contains(selector)

export const style = (item, property, value) => {
  if (item instanceof Array) {
    for (let i of item) {
      i.style[property] = value
    }
  } else {
    item.style[property] = value
  }
}

export const unstyle = (item, property) => {
  if (item instanceof Array) {
    for (let i of item) {
      i.style.removeProperty(property)
    }
  } else {
    item.style.removeProperty(property)
  }
}

/**
 * Decodes a string that has been encode through the 'url_encode' Shopify filter
 * @param {*} str
 */
export const decode = str => decodeURIComponent(str).replace(/\+/g, ' ')

/**
 * Check to see if document has loaded
 *
 * @return {boolean}
 * @private
 */
const _domLoaded = () => document.attachEvent ? document.readyState === 'complete' : document.readyState !== 'loading'

/**
 * Call function when document is ready
 *
 * @param {Function} f
 */
export const ready = (f) => _domLoaded() ? f() : document.addEventListener('DOMContentLoaded', f)

export const getHeight = (el) => {
  return `${el.offsetHeight}px`
}

export const doesSupportObjectFit = () => window.CSS.supports('object-fit', 'cover')

/**
 * Get attribute value for an element.
 *
 * @param {string} name
 * @param {HTMLElement} el
 * @return {string}
 * @private
 */
const _getAttribute = (name, el) => el.getAttribute(name)

/**
 * Get attribute value for an element.
 *
 * This is a curried function
 *
 * @param {string} name
 * @param {HTMLElement} el
 * @return {string}
 */
export const getAttribute = curry(_getAttribute)

export const setAttribute = curry((name, value, el) => {
  el.setAttribute(name, value)
  return el
})

/**
 * Get data attribute.
 *
 * @param {string} name
 * @param {HTMLElement} el
 * @return {string} Parsed JSON value or object
 * @private
 */
const _getData = (name, el) => _getAttribute('data-' + name, el)

/**
 * Get data attribute.
 *
 * This is a curried function
 *
 * @param {string} name
 * @param {HTMLElement} el
 * @return {string}
 */
export const getData = curry(_getData)

export const setData = curry((name, value, el) => setAttribute('data-' + name, value, el))

/**
 * Select one element matching a selector, which is also decendant of a parent element (defaults to document)
 * @param {string} selector
 * @param {HTMLElement|HTMLDocument=} parent
 * @return {HTMLElement}
 */
export const select = (selector, parent = document) => parent.querySelector(selector)

/**
 * Create an array out of an array-like object
 *
 * @param {Object} Array-like object
 * @return {Array} Array
 */
const makeArray = (arrayLike) => Array.prototype.slice.call(arrayLike)

/**
 * Select all elements matching a selector, which are also decendant of a parent element (defaults to document)
 * @param {string} selector
 * @param {HTMLElement|HTMLDocument=} parent
 * @return {Array<HTMLElement>}
 */
export const selectAll = (selector, parent = document) => makeArray(parent.querySelectorAll(selector))

/**
 * Functional wrapper for array map function.
 *
 * @param {Function} f
 * @param {*} arr
 */
export const map = curry((f, arr) => Array.isArray(arr) ? arr.map(f) : f(arr))

/**
 * Partial application
 * @param {Function} f
 * @param {..*} args Initial parameters
 */
export const partial = (f, ...args) => f.bind(this, ...args)

/**
 * Attach event handler for a single event
 *
 * @param {string} event
 * @param {Function} handler
 * @param {Object} capture
 * @param {HTMLElement} el
 * @returns {HTMLElement}
 * @private
 */
export const _on = (event, handler, capture, el) => {
  el.addEventListener(event, handler, capture, el)
  return el
}

/**
 * Attach event handler for a list of events.
 *
 * This is a curried function
 *
 * @param {Array|Object} els Array or array-like object
 * @param {string} event
 * @param {Function} handler
 * @return {Array<HTMLElement>}
 */
export const on = curry((event, handler, els) =>
  map(
    partial(_on, event, handler, {}),
    els
  )
)

/**
 * Wrap Lines
 * @param divEl
 * @param el
 * @returns {string}
 */
export const wrapLines = (divEl, el)=> {
  const words = divEl.innerHTML.trim().split(' ')
  const classes = divEl.getAttribute('class')
  const containerWidth = divEl.offsetWidth
  let tempSpan = document.createElement('span')
  tempSpan.className = classes
  tempSpan.style.display = 'inline'
  tempSpan.style.whiteSpace = 'nowrap'
  tempSpan.style.visibility = 'hidden'
  el.appendChild(tempSpan)

  let currentLine = ''
  let linesN = []

  words.forEach(function (word) {
    tempSpan.innerHTML = (currentLine + ' ' + word).trim()
    if (tempSpan.offsetWidth > containerWidth) {
      linesN.push(currentLine.trim())
      currentLine = word
    } else {
      currentLine += ' ' + word
    }
  })

  linesN.push(currentLine.trim())
  el.removeChild(tempSpan)

  return linesN
    .map(function (line) {
      let lineArr = ''
      line.split(' ').forEach(word => {
        lineArr += '<span class="js-text-reveal">'+ word +'</span> '
      })
      return '<div class="line-wrapper">' + lineArr + '</div>'
    })
    .join('')
}

export const trigger = (eventName, el) => {
  let event
  if (typeof window.CustomEvent === 'function') {
    event = new CustomEvent(eventName, { detail: { some: 'data' } })
  } else {
    event = document.createEvent('CustomEvent')
    event.initCustomEvent(eventName, true, true, { some: 'data' })
  }
  el.dispatchEvent(event)
  return el
}
