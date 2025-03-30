import { select, getAttribute } from '../../src/js/lib/util'

const selectors = {
  FETCH_BUTTON: '.js-fetch-button',
  LOADING: '.js-loading',
  RESULT: '.js-result',
  INPUT_TRACKING: '.js-input-tracking',
  DATA_TABLE_BODY: '.js-data-tablet-body',
}

export default el => {
  const apiUrl = getAttribute('data-api-url', el)
  const fetchButtonEl = select(selectors.FETCH_BUTTON, el)
  const loadingEl = select(selectors.LOADING, el)
  const inputEl = select(selectors.INPUT_TRACKING, el)
  const resultEl = select(selectors.RESULT, el)
  const tableBodyEl = select(selectors.DATA_TABLE_BODY, el)

  async function fetchData() {
    loadingEl.style.display = 'flex'
    tableBodyEl.innerHTML = ''

    let trackingNumber = inputEl.value
    if (!trackingNumber || !apiUrl) {
      return
    }

    try {
      const response = await fetch(apiUrl + '?tracking=' + trackingNumber, {
        method: 'GET',
        redirect: 'follow'
      })
      const data = await response.json()

      if (data && data.length > 0) {
        resultEl.style.display = 'block'

        data.forEach(item => {
          let row = tableBodyEl.insertRow()

          row.insertCell(0).textContent = item[0].code
          row.insertCell(1).textContent = item[0].stt
          row.insertCell(2).textContent = new Date(item[0].date).toLocaleDateString("vi-VN")
        })
      }
    } catch (error) {
      console.error('Lỗi khi lấy dữ liệu:', error)
    } finally {
      loadingEl.style.display = 'none'
    }
  }

  if (fetchButtonEl) {
    fetchButtonEl.addEventListener('click', fetchData)
  }
}