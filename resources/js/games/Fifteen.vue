<template>
    <div id="fifteen" class="game-canvas fifteen" :class="!this.loaded ? 'd-flex justify-content-center align-items-center' : ''">
        <i class="fad fa-spinner-third fa-3x fa-spin text-white" v-if="!this.loaded"></i>
    </div>
</template>

<script>
export default {
    name: 'Fifteen',
    data() {
        return {
            loaded: false,
            playable: false,
            board: null,
            size: null,
            tileArray: null,
            shuffleMoves: 100,
        }
    },
    mounted() {
        this.board = document.querySelector('#fifteen')

        this.$parent.$el.querySelectorAll('.animate__animated')[0].addEventListener('animationend', event => {
            this.size = this.board.getBoundingClientRect().width

            this.board.setAttribute('style', 'height:' + this.size + 'px;')

            this.init()
            this.loaded = true
            this.shuffle()
        })
    },
    methods: {
        init() {
            this.tileArray = []

            for (let i = 0; i < 4; i++) {
                for (let j = 0; j < 4; j++) {
                    if (!(i === 0 && j === 0)) {
                        this.tileArray.push(this.createTile(j, i))
                    }
                }
            }

            this.tileArray.forEach(elt => {
                elt.tile.addEventListener('click', event => {

                    if (this.playable) {
                        let move = this.checkMove(elt)

                        if (move) {
                            this.move(elt, move)

                            this.finished()
                        }
                    }

                })
            })
        },
        createTile(x, y) {
            let tile = document.createElement('div')
            let val = x + y * 4

            tile.className = 'tile'
            tile.setAttribute('style', `height: ${this.size / 4}px;width: ${this.size / 4}px;`)

            tile.style.left = this.size / 4 * x + 'px'
            tile.style.top = this.size / 4 * y + 'px'
            tile.style.backgroundSize = this.size + 'px'
            tile.style.backgroundPosition = '-' + tile.style.left + ' ' + '-' + tile.style.top

            tile.innerHTML = `<span>${val}</span>`

            this.board.appendChild(tile)

            return {
                tile,
                x,
                y,
                val
            }
        },
        shuffle() {
            let movableTiles = []
            let justMoved = {val: 0}

            setTimeout(() => {
                for(let i = 0; i < this.shuffleMoves; i++) {
                    this.tileArray.forEach(tile => {
                        let move = this.checkMove(tile)

                        if (move && justMoved.val !== tile.val) {
                            movableTiles.push({
                                tile: tile,
                                direction: move
                            })
                        }
                    })

                    let tile = movableTiles[Math.floor(Math.random() * movableTiles.length)]

                    this.move(tile.tile, tile.direction)

                    justMoved = tile.tile
                    movableTiles = []
                }
                this.playable = true

            }, 2000)
        },
        finished() {
            if (this.isFinished()) {
                this.playable = false

                setTimeout(() => {
                    this.tileArray.forEach(tile => {
                        if (tile.val !== 7) {
                            tile.tile.style.display = 'none'
                        } else {
                            tile.tile.setAttribute('style', `height: ${this.size}px;width: ${this.size}px;`)
                            tile.tile.classList.add('endPic')

                            this.$parent.gameFinished()
                        }
                    })
                }, 1000)
            }
        },
        isFinished() {
            let finished = true

            this.tileArray.forEach(tile => {
                if (tile.val !== tile.x + tile.y * 4) finished = false
            })

            return finished
        },
        move(elt, direction) {
            elt.x += direction.x
            elt.y += direction.y

            elt.tile.style.left = this.size / 4 * elt.x + 'px'
            elt.tile.style.top = this.size / 4 * elt.y + 'px'
        },
        checkMove(elt) {
            return this.left(elt) || this.up(elt) || this.right(elt) || this.down(elt)
        },
        left(elt) {
            let can = elt.x - 1 >= 0

            if (can) {
                this.tileArray.forEach(tile => {
                    if (tile.x === elt.x - 1 && tile.y === elt.y) can = false
                })
            }

            return can ? {x: -1, y: 0} : false
        },
        right(elt) {
            let can = elt.x + 1 < 4

            if (can) {
                this.tileArray.forEach(tile => {
                    if (tile.x === elt.x + 1 && tile.y === elt.y) can = false
                })
            }

            return can ? {x: 1, y: 0} : false
        },
        up(elt) {
            let can = elt.y - 1 >= 0

            if (can) {
                this.tileArray.forEach(tile => {
                    if (tile.y === elt.y - 1 && tile.x === elt.x) can = false
                })
            }

            return can ? {x: 0, y: -1} : false
        },
        down(elt) {
            let can = elt.y + 1 < 4

            if (can) {
                this.tileArray.forEach(tile => {
                    if (tile.y === elt.y + 1 && tile.x === elt.x) can = false
                })
            }

            return can ? {x: 0, y: 1} : false
        },
    },
}
</script>

<style scoped>

</style>
