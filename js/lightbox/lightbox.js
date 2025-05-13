/**
 * @property {HTMLElement} element
 * @property {string[]} images Lightbox image paths
 * @property {string} url URL of the currently displayed image
 */
class Lightbox {
    // Initialize the lightbox functionality
    static init () {
        // Select all links that point to an image file

        const links = Array.from(document.querySelectorAll('.fullscreen-icon'))
        const gallery = links.map(link => link.getAttribute('href'))
        console.log(gallery);

        links.forEach(link => link.addEventListener('click', e => {
            e.preventDefault()
            const url = e.currentTarget.getAttribute('href');
            const reference = e.currentTarget.dataset.reference;
            const categorie = e.currentTarget.dataset.categorie;
            new Lightbox(url, reference, categorie, gallery);
        }))
    }

/**
 * @param {string} url Image url
 * @param {string[]} images Lightbox image paths
 */
constructor(url, reference, categorie, images) {
    this.reference = reference
    this.categorie = categorie
    this.images = images
    // Build the DOM from the image url
    this.element = this.buildDOM(url)
    this.loadImage(url)
    this.onKeyUp = this.onKeyUp.bind(this)
    document.body.appendChild(this.element)
    //Method from the Body Scroll Lock library to disable body scroll when the lightbox is opened
    bodyScrollLock.disableBodyScroll(this.element)
    document.addEventListener('keyup', this.onKeyUp)
}

/**
 * Injects a loader element into the DOM, initiates loading of the image from the given URL, and replaces the loader with the image element once loading is complete.
 * 
 * @param {string} url image URL
 */
loadImage (url) {
    this.url = null
    const image = new Image()
    const container = this.element.querySelector('.lightbox-img')
    // Add the loader in the DOM
    const loader = document.createElement('div')
    loader.classList.add('lightbox-loader')
    // Clear the container to remove any previously loaded image or data
    container.innerHTML = ""
    container.appendChild(loader)
    // container.insertBefore(loader, container.firstChild)
    image.onload = () => {
        container.removeChild(loader)
        container.appendChild(image)
        this.url = url
        console.log('Image loaded, url:', this.url)
        const data = document.createElement('div')
        data.classList.add('lightbox-data')
        data.innerHTML = `
            <p>${this.reference}</p>
            <p>${this.categorie}</p>
        `
        container.appendChild(data)
    }
    image.src = url
}


/**
 * Handles keyboard interactions for accessibility.
 * 
 * Listens for the Escape key press to allow users to close the lightbox
 * using the keyboard, improving accessibility and usability.
 * 
 * @param {KeyboardEvent} e
 */
onKeyUp(e) {
    if (e.key === 'Escape') {
        this.close(e)
    } else if (e.key === 'ArrowLeft') {
        this.prev(e)
    } else if (e.key === 'ArrowRight') {
        this.next(e)
    }
}

/**
 * Close the lightbox with a fade-out animation
 * @param {MouseEvent/keyboardEvent} e
 */
close(e) {
    e.preventDefault()
    this.element.classList.add('fadeOut')
    // Restore body scroll using the Body Scroll Lock library
    bodyScrollLock.enableBodyScroll(this.element)
    window.setTimeout(() => {
        this.element.parentElement.removeChild(this.element)
    }, 300)
    //Removes the keyboard event listener to prevent memory leaks or unintended triggers
   document.removeEventListener('keyup', this.onKeyUp)
}


/**
 * Navigate to the next image
 * @param {MouseEvent/keyboardEvent} e
 */
next (e) {
    e.preventDefault()
    let i = this.images.findIndex(image => image === this.url)
    if (i === this.images.length - 1) {
        i = -1
    }
    this.loadImage(this.images[i + 1])
}

/**
 * Navigate to the previous image
 * @param {MouseEvent/keyboardEvent} e
 */
prev (e) {
    e.preventDefault()
    let i = this.images.findIndex(image => image === this.url)
    if (i === 0) {
        i = this.images.length - 1
    }
    this.loadImage(this.images[i - 1])
}

/**
 * 
 * Builds the DOM structure for the lightbox.
 * 
 * Includ dynamically injected data (image URL, reference, category).
 * Adds a click event listener to the close button to allow lightbox closure.
 * 
 * @param {string} url URL de l'image
 * @return {HTMLElement}
 */
buildDOM (url) {
    const dom = document.createElement('div')
    dom.classList.add('lightbox')
    dom.innerHTML = `<button class="lightbox-close">&times;</button>
    <div class="lightbox-img-navigation">
        <button class="lightbox-prev"><span class="prev-arrow">&larr;</span>Précédent</button>
        <div class="lightbox-img"></div>
        <button class="lightbox-next">Suivant<span class="next-arrow">&rarr;</span></button>
    </div>`
    // Attach close event handler to the close button
    dom.querySelector('.lightbox-close').addEventListener('click', this.close.bind(this))
    dom.querySelector('.lightbox-next').addEventListener('click', this.next.bind(this))
    dom.querySelector('.lightbox-prev').addEventListener('click', this.prev.bind(this))
    return dom
}

}

Lightbox.init()