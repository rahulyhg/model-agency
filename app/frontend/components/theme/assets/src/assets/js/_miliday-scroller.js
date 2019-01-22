class MilidayScroller {
    constructor(config) {
        this.place = document.querySelector(config.place)
        this.stepDelay = config.stepDelay ? config.stepDelay : 5
        this.scrollStep = config.scrollStep ? config.scrollStep : 5

        this.trackWidth = config.trackWidth ? config.trackWidth : 15
        this.sliderWidth = config.sliderWidth ? config.trackWidth : 15

        this.trackClass = config.trackClass ? config.trackClass : 'miliday-scroll-track'
        this.sliderClass = config.sliderClass ? config.sliderClass : 'miliday-scroll-slider'

        this.track = null
        this.slider = null

        this.init()
    }

    init() {
        this.buildTrack()
        this.handler()
    }

    handler() {
        let controlDistributor = this.controlDistributor.bind(this)

        if (this.place.addEventListener) {
            if ('onwheel' in document) {
                this.place.addEventListener('wheel', controlDistributor)
            } else if ('onmousewheel' in document) {
                this.place.addEventListener('mousewheel', controlDistributor)
            } else {
                this.place.addEventListener('MozMousePixelScroll', controlDistributor)
            }
        } else {
            this.place.attachEvent('onmousewheel', controlDistributor)
        }

        this.slider.addEventListener('mousedown', e => {
            this.controlDistributor.startPos = e.screenY

            window.addEventListener('mousemove', controlDistributor)
            window.addEventListener('mouseup', e => {
                window.removeEventListener('mousemove', controlDistributor)
            })
        })
    }

    controlDistributor(e) {
        e = e || window.event

        if (e.type === 'mousemove') {
            this.positionY(this.slider, e.screenY - this.controlDistributor.startPos)
            console.log('');
            console.log(e.screenY);
            console.log(this.controlDistributor.startPos);
            console.log(e.screenY - this.controlDistributor.startPos);
            console.log('');


        }

        if (e.type === 'wheel') {
            this.smoothing(e.deltaY, () => {
                this.scrollY(this.place, this.scrollStep * (e.deltaY / 100))
                this.positionY(this.track, this.place.scrollTop)
                this.positionY(this.slider, this.place.scrollTop * (this.place.clientHeight / this.place.scrollHeight))
            }, this.scrollStep, this.stepDelay)
        }

        e.preventDefault ? e.preventDefault() : (e.returnValue = false)
    }

    buildTrack() {
        let placeStyle = window.getComputedStyle(this.place)

        if (placeStyle.position === 'static') {
            this.place.style.position = 'relative'
        }
        this.place.style.overflow = 'hidden'
        this.place.style.paddingRight = (parseInt(placeStyle.paddingRight) + this.trackWidth) + 'px'

        this.slider = document.createElement('div')
        this.slider.classList.add(this.sliderClass)
        this.slider.style.height = this.place.clientHeight * (this.place.clientHeight / this.place.scrollHeight) + 'px'
        this.slider.style.width = this.sliderWidth + 'px'
        this.slider.style.position = 'absolute'
        this.slider.style.top = 0 + 'px'
        this.slider.style.right = 0 + 'px'
        this.slider.style.transform = 'translate3d(0,' + this.place.scrollTop * (this.place.clientHeight / this.place.scrollHeight) + 'px, 0)'

        this.track = document.createElement('div')
        this.track.classList.add(this.trackClass)
        this.track.style.height = this.place.clientHeight + 'px'
        this.track.style.width = this.trackWidth + 'px'
        this.track.style.position = 'absolute'
        this.track.style.top = 0 + 'px'
        this.track.style.right = 0 + 'px'
        this.track.style.transform = 'translate3d(0,' + this.place.scrollTop + 'px, 0)'

        this.track.appendChild(this.slider)
        this.place.appendChild(this.track)
    }

    positionY(elem, value) {
        elem.style.transform = 'translate3d(0,' + value + 'px, 0)'
    }

    scrollY(place, value) {
        place.scrollTop += value
    }

    smoothing(value, callBack, step = 1, delay = 0) {
        let residue = Math.abs(value)
        let interval = setInterval(() => {
            if (residue <= 0) {
                clearInterval(interval)
            } else {
                residue -= step
                callBack()
            }
        }, delay)
    }
}