export let consoleTyper = {
    methods: {
        consoleTyper(elt, text) {
            let i = 0

            let event = new Event('startTyper')
            elt.dispatchEvent(event)

            let typer = setInterval(function () {
                if (i !== text.length) {
                    i += 1
                    elt.innerHTML = text.substr(0, i)
                } else {
                    clearInterval(typer)
                    event = new Event('endTyper')
                    elt.dispatchEvent(event)
                    elt.classList.remove('consoleTyper')
                }
            }, 30);

            document.querySelector('body').addEventListener('click', event => {
                if (i !== text.length) {
                    clearInterval(typer)
                    elt.innerHTML = text
                    i = text.length
                    event = new Event('endTyper')
                    elt.dispatchEvent(event)
                    elt.classList.remove('consoleTyper')
                }
            })
        },
        toTyper() {
            let elt = this.$el.querySelectorAll('.consoleTyper')[0]

            if (elt) {
                this.consoleTyper(elt, elt.innerHTML)

                elt.addEventListener('startTyper', event => {
                    this.showArrow = false
                })

                elt.addEventListener('endTyper', event => {
                    this.showArrow = true
                    let arrow = this.$el.querySelectorAll('.arrow-container')[0]
                    if (arrow) arrow.dispatchEvent(new Event('showArrow'))
                })
            }
        }
    },
    data() {
        return {
            showArrow: false,
            typer: true
        }
    }
}

export let baseURL = {
    methods: {
        url(path) {
            return this.$store.state.base + path
        }
    }
}

export let contrast = {
    methods: {
        setColorMode() {
            return this.$store.getters.title.dark ? 'text-dark' : 'text-white'
        }
    }
}

export let sceneManagement = {
    data() {
        return {
            showing: this.showed,
            loaded: false
        }
    },
    mounted() {
        document.getElementById('app').addEventListener('saveLoaded', event => {
            if (this.index < this.$parent.currentAction && this.$parent.showed) {
                this.showing = this.showed
                this.$el.style.display = 'none'
                this.loaded = true
            }

            let elt = this.$el.querySelectorAll('.animate__animated')[0];

            elt = elt ? elt : this.$el

            if (!elt.hasAttribute('listenners')) {
                elt.addEventListener('animationstart', event => {
                    if (!this.showing && this.typer) {
                        this.toTyper()
                    }
                })

                elt.addEventListener('animationend', event => {
                    if (this.showing) {
                        this.$el.style.display = 'none'

                        if (!this.loaded) {
                            this.$store.dispatch('nextStep')
                        }

                    }
                })

                elt.setAttribute('listenners', 'true')
            }
        })
    },
    computed: {
        display() {
            return this.show || this.showed
        },
        showed() {
            return this.index < this.$parent.currentAction
        },
        show() {
            return this.index === this.$parent.currentAction
        }
    },
    methods: {
        toggleShowing () {
            this.showing = !this.showing
        }
    }
}

export let background = {
    methods: {
        setBg(url) {
            return this.bg ? 'background-image: url(\'' + this.url(url) + '\');': ''
        }
    }
}

export let animateCSS = {
    methods: {
        animateCSS(element, animation, prefix = 'animate__') {
            return new Promise((resolve, reject) => {
                const animationName = `${prefix}${animation}`;
                const node = document.querySelector(element);

                node.classList.add(`${prefix}animated`, animationName);

                function handleAnimationEnd(event) {
                    event.stopPropagation();
                    node.classList.remove(`${prefix}animated`, animationName);
                    resolve('Animation ended');
                }

                node.addEventListener('animationend', handleAnimationEnd, {once: true});
            })
        }
    }
}

let allMixins = [
    contrast,
    baseURL,
    consoleTyper,
    background
]

export default allMixins
