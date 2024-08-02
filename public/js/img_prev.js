function img_prev () {
    const input = document.querySelector('#img_message')
    const figure = document.querySelector('#figure')
    const figureImage = document.querySelector('#figureImage')

    input.addEventListener('change', (event) => {
        const [file] = event.target.files

        if (file) {
            figureImage.setAttribute('src', URL.createObjectURL(file))
            figure.style.display = 'block'
        } else {
            figure.style.display = 'none'
        }
    })
}

img_prev()
