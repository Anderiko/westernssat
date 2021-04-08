<template>
    <div id="leds" class="game-canvas leds d-flex justify-content-center align-items-center">
        <i class="fad fa-spinner-third fa-3x fa-spin text-white" v-if="!this.loaded"></i>
        <i class="fas fa-sync-alt fa-3x text-white resetBtn" @click="() => {this.reset()}" v-if="this.playable"></i>
        <i class="fad fa-lightbulb-on fa-3x text-white" v-if="this.success"></i>
    </div>
</template>

<script>
export default {
    name: 'Leds',
    data() {
        return {
            loaded: false,
            playable: false,
            board: null,
            size: null,
            leds: null,
            success: false,
            states: [
                'images/game/leds/light_bulb_01.png',
                'images/game/leds/light_bulb_02.png',
                'images/game/leds/light_bulb_03.png',
                'images/game/leds/light_bulb_04.png',
                'images/game/leds/light_bulb_05.png',
            ]
        }
    },
    mounted() {
        this.board = document.querySelector('#leds')

        this.states.forEach(url => {
            (new Image()).src = url
        })

        this.$parent.$el.querySelectorAll('.animate__animated')[0].addEventListener('animationend', event => {
            this.size = this.board.getBoundingClientRect().width

            this.board.setAttribute('style', 'height:' + this.size + 'px;')

            this.init()
            this.loaded = true
            this.playable = true
        })
    },
    methods: {
        init() {
            this.leds = []

            for (let i = 0; i < 2; i++) {
                for (let j = 0; j < 2; j++) {
                    this.leds.push(this.createLed(j, i))
                }
            }

            this.leds.forEach(led => {
                led.led.addEventListener('click', event => {

                    if (this.playable) {
                        this.switch(led)

                        this.finished()
                    }

                })
            })
        },
        finished() {
            if (this.isFinished()) {
                this.playable = false

                this.success = true

                setTimeout(() => {
                    this.$parent.gameFinished()
                }, 1000)
            }
        },
        isFinished() {
            let finished = true

            this.leds.forEach(led => {
                if (!led.on) finished = false
            })

            return finished
        },
        reset() {
            this.leds.forEach(elt => {
                if (elt.state !== 0) this.turnOnOff(elt)
            })
        },
        switch(led) {
            switch (led.id) {
                case 0:
                    this.leds.forEach(elt => {
                        if (elt.id !== 0) this.turnOnOff(elt)
                    })
                    break;
                case 1:
                    this.leds.forEach(elt => {
                        if (elt.id === 1 || elt.id === 3) this.turnOnOff(elt)
                    })
                    break;
                case 2:
                    this.leds.forEach(elt => {
                        if (elt.id === 2 || elt.id === 3) this.turnOnOff(elt)
                    })
                    break;
                case 3:
                    this.leds.forEach(elt => {
                        if (elt.id !== 3) this.turnOnOff(elt)
                    })
                    break;
            }
        },
        turnOnOff(led) {
            if (led.state === 0) {
                let stateChange = setInterval(() => {
                    if (led.state + 1 >= this.states.length) {
                        clearInterval(stateChange)
                        led.on = true
                        this.finished()
                    } else {
                        led.state++
                        led.led.src = this.states[led.state]
                    }
                }, 40)
            } else {
                let stateChange = setInterval(() => {
                    if (led.state - 1 <= 0) {
                        clearInterval(stateChange)
                        led.on = false
                    }
                    led.state--
                    led.led.src = this.states[led.state]
                }, 20)
            }
        },
        createLed(x, y) {
            let ratio = 1102 / 964

            let led = document.createElement('img')
            led.src = this.states[0]

            led.className = 'led'
            led.setAttribute('style', `height: ${this.size * ratio / 3}px;width: ${this.size / 3}px;`)

            if (x === 0) {
                if (y === 0) {
                    led.style.left = '0'
                    led.style.top = '0'
                } else {
                    led.style.left = '0'
                    led.style.bottom = '0'
                }
            } else {
                if (y === 0) {
                    led.style.right = '0'
                    led.style.top = '0'
                } else {
                    led.style.right = '0'
                    led.style.bottom = '0'
                }
            }

            this.board.appendChild(led)

            return {
                led,
                x,
                y,
                id: x + y * 2,
                state: 0,
                on: false
            }
        },
    }
}
</script>

<style scoped>

</style>
