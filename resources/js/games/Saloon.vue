<template>
    <div id="jars" class="game-canvas jars d-flex align-items-center justify-content-center">
        <i class="fad fa-spinner-third fa-3x fa-spin text-white" v-if="!this.loaded"></i>
        <i class="fas fa-sync-alt fa-3x text-white resetBtn" @click="() => {this.reset()}" v-if="this.playable"></i>
        <div id="jars-container" class="jars-container">

        </div>
        <div id="jars-level" class="jars-level">

        </div>
    </div>
</template>

<script>
export default {
    name: 'Saloon',
    props: ['show'],
    data() {
        return {
            loaded: false,
            playable: false,
            board: null,
            size: null,
            jars: null,
            success: false,
            states: [
                'images/game/jars/jar03.png',
                'images/game/jars/jar02.png',
                'images/game/jars/jar01.png',
            ],
            maxFill: [12, 8, 5],
            initFill: [12, 0, 0],
        }
    },
    mounted() {
        this.board = document.querySelector('#jars')

        this.states.forEach(url => {
            (new Image()).src = url
        })

        this.$parent.$el.querySelectorAll('.animate__animated')[0].addEventListener('animationend', event => {
            if (this.show) {
                this.size = this.board.getBoundingClientRect().width

                this.board.setAttribute('style', 'height:' + this.size + 'px;')

                let jarContainer = document.getElementById('jars-container')
                let levelContainer = document.getElementById('jars-level')
                if (jarContainer) jarContainer.innerHTML = ''
                if (levelContainer) jarContainer.innerHTML = ''
                this.init()
                console.log('init called')
                this.loaded = true
                this.playable = true
            }
        })
    },
    methods: {
        init() {
            this.jars = []

            for (let i = 0; i < 3; i++) {
                this.jars.push(this.createJar(i))
            }

            this.jars.forEach(jar => {
                jar.jar.addEventListener('click', event => {

                    if (this.playable) {

                        let selected = this.getSelectedJar()

                        if (selected === jar) {
                            this.unselectJar(jar)
                        } else if (selected === null) {
                            this.selectJar(jar)
                        } else {
                            this.fillJar(jar)
                            this.finished()
                        }
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
            return this.jars[0].fill === 6 && this.jars[1].fill === 6
        },
        reset() {
            for (let i = 0; i < 3; i++) {
                this.unselectJar(this.jars[i])
                this.jars[i].fill = this.initFill[i]
                this.jars[i].updateLevel()
            }
        },
        createJar(x) {
            let ratio = 635 / 752

            let jarContainer = document.getElementById('jars-container')
            let levelContainer = document.getElementById('jars-level')

            let jar = document.createElement('img')
            jar.src = x === 0 ? this.states[0] : this.states[2]
            jar.className = 'jar'
            jar.setAttribute('style', `height: ${this.size / 3}px;width: ${this.size * ratio / 3}px;`)

            jarContainer.appendChild(jar)

            let level = document.createElement('h2')

            level.innerHTML = `${this.initFill[x]} / ${this.maxFill[x]}`

            levelContainer.appendChild(level)

            return {
                jar,
                level,
                max: this.maxFill[x],
                fill: this.initFill[x],
                selected: false,
                states: this.states,
                updateLevel() {
                    this.level.innerHTML = `${this.fill} / ${this.max}`

                    if (this.max * 0.8 < this.fill) {
                        this.jar.src = this.states[0]
                    } else if (this.fill === 0) {
                        this.jar.src = this.states[2]
                    } else {
                        this.jar.src = this.states[1]
                    }
                }
            }
        },
        getSelectedJar() {
            let jar = null
            this.jars.forEach(j => {
                if (j.selected) jar = j
            })
            return jar
        },
        selectJar(jar) {
            jar.selected = true
            jar.jar.classList.add('selected')
        },
        unselectJar(jar) {
            jar.selected = false
            jar.jar.classList.remove('selected')
        },
        fillJar(jar) {
            let target = jar.max - jar.fill
            let selected = this.getSelectedJar()

            if (selected.fill - target >= 0) {
                selected.fill -= target
                jar.fill = jar.max
            } else {
                jar.fill += selected.fill
                selected.fill = 0
            }

            jar.updateLevel()
            selected.updateLevel()
            this.unselectJar(selected)
        }
    }
}
</script>

<style scoped>

</style>
