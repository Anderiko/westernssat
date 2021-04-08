<template>
    <div id="signals" class="game-canvas signals d-flex justify-content-center align-items-center">
        <i class="fad fa-spinner-third fa-3x fa-spin text-white" v-if="!this.loaded"></i>
        <i class="fas fa-sync-alt fa-3x text-white resetBtn" @click="() => {this.reset()}" v-if="this.playable"></i>
    </div>
</template>

<script>
export default {
    name: 'Signals',
    data() {
        return {
            loaded: false,
            playable: false,
            board: null,
            size: null,
            tiles: null,
            success: false,
            states: [
                'images/game/signals/fercheval.png',
                'images/game/signals/tipee.png',
                'images/game/signals/sheriff.png',
                'images/game/signals/lingot.png',
            ],
            initStates: [
                [2, 0, 3],
                [3, 1, 3],
                [2, 0, 3]
            ]
        }
    },
    mounted() {
        this.board = document.querySelector('#signals')

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
            this.tiles = []

            for (let i = 0; i < 3; i++) {
                for (let j = 0; j < 3; j++) {
                    this.tiles.push(this.createTile(j, i))
                }
            }

            this.tiles.forEach(tile => {
                tile.tile.addEventListener('click', event => {

                    if (this.playable) {

                        this.move(tile)

                        this.finished()
                    }

                })
            })
        },
        reset() {
            this.tiles.forEach(tile => {
                tile.state_id = this.initStates[tile.y][tile.x]
                tile.tile.style.backgroundImage = `url("${this.states[tile.state_id]}")`
            })
        },
        createTile(x, y) {
            let tile = document.createElement('div')

            tile.className = 'tile'
            tile.setAttribute('style', `height: ${this.size / 3}px;width: ${this.size / 3}px;`)

            tile.style.left = this.size / 3 * x + 'px'
            tile.style.top = this.size / 3 * y + 'px'

            tile.style.backgroundImage = `url("${this.states[this.initStates[y][x]]}")`

            this.board.appendChild(tile)

            return {
                tile,
                x,
                y,
                state_id: this.initStates[y][x],
            }
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

            this.tiles.forEach(tile => {
                if (tile.state_id !== 1) finished = false
            })

            return finished
        },
        move(tile) {
            let swap = [tile]

            this.tiles.forEach(t => {
                if (t.x === tile.x) {
                    if (t.y !== tile.y) {
                        swap.push(t)
                    }
                }

                if (t.y === tile.y) {
                    if (t.x !== tile.x) {
                        swap.push(t)
                    }
                }
            })

            swap.forEach(tile => {
                tile.state_id++
                tile.state_id %= 4
                tile.tile.style.backgroundImage = `url("${this.states[tile.state_id]}")`
            })
        },
        getTile(x, y) {
            let tile = null

            this.tiles.forEach(t => {
                if (t.x === x && t.y === y) tile = t
            })

            return tile
        },
    },
}
</script>

<style scoped>

</style>
