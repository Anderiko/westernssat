<template>
    <div id="knights" class="game-canvas knights d-flex justify-content-center align-items-center">
        <i class="fad fa-spinner-third fa-3x fa-spin text-white" v-if="!this.loaded"></i>
        <i class="fas fa-sync-alt fa-3x text-white resetBtn" @click="() => {this.reset()}" v-if="this.playable"></i>
    </div>
</template>

<script>
export default {
    name: 'Knights',
    data() {
        return {
            loaded: false,
            playable: false,
            board: null,
            size: null,
            knights: null,
            tiles: null,
            success: false,
            turn: 'white',
            states: [
                'images/game/chess/whiteKnight.png',
                'images/game/chess/blackKnight.png',
            ],
            knightMoves: [
                [-1, 2],
                [1, 2],
                [-1, -2],
                [1, -2],
                [2, -1],
                [2, 1],
                [-2, -1],
                [-2, 1]
            ]
        }
    },
    mounted() {
        this.board = document.querySelector('#knights')

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
            this.knights = []

            for (let i = 0; i < 3; i++) {
                for (let j = 0; j < 3; j++) {
                    this.tiles.push(this.createTile(j, i))

                    if (i === 0) {
                        if (j === 0) {
                            this.knights.push(this.createKnight(i, j, 'dark'))
                        } else if (j === 2) {
                            this.knights.push(this.createKnight(i, j, 'white'))
                        }
                    } else if (i === 2) {
                        if (j === 0) {
                            this.knights.push(this.createKnight(i, j, 'dark'))
                        } else if (j === 2) {
                            this.knights.push(this.createKnight(i, j, 'white'))
                        }
                    }
                }
            }

            this.knights.forEach(knight => {
                knight.knight.addEventListener('click', event => {
                    if (this.playable) {
                        if (knight.color === this.turn) {
                            if (!knight.selected) {
                                this.unselectAll()

                                knight.selected = true
                                knight.knight.classList.add('selected')

                                this.highlightTile()
                            } else {
                                this.unselectAll()
                            }

                        } else {
                            this.$store.dispatch('showToast', {
                                title: 'Western Game',
                                content: `C'est aux ${this.turn === 'white' ? 'blancs' : 'noirs'} de jouer`
                            })
                        }
                    }
                })
            })

            this.tiles.forEach(tile => {
                tile.tile.addEventListener('click', event => {

                    if (this.playable) {

                        if (tile.move) {
                            this.move(this.selectedKnight(), tile)

                            this.finished()
                        } else {
                            this.unselectAll()
                        }

                    }

                })
            })
        },
        reset() {
            this.turn = 'white'
            this.unselectAll()

            this.knights.forEach(knight => {
                knight.x = knight.start.x
                knight.y = knight.start.y

                knight.knight.style.left = this.size / 3 * knight.start.x + 'px'
                knight.knight.style.top = this.size / 3 * knight.start.y + 'px'
            })
        },
        createTile(x, y) {
            let tile = document.createElement('div')
            let val = x + y * 3

            tile.className = 'tile'
            tile.setAttribute('style', `height: ${this.size / 3}px;width: ${this.size / 3}px;`)

            tile.style.left = this.size / 3 * x + 'px'
            tile.style.top = this.size / 3 * y + 'px'

            tile.classList.add(val % 2 === 0 ? 'dark' : 'white')

            this.board.appendChild(tile)

            return {
                tile,
                x,
                y,
                move: false
            }
        },
        createKnight(x, y, color) {
            let knight = document.createElement('div')
            let start = {
                x,
                y
            }

            knight.className = 'knight'
            knight.setAttribute('style', `height: ${this.size / 3}px;width: ${this.size / 3}px;`)

            knight.style.left = this.size / 3 * x + 'px'
            knight.style.top = this.size / 3 * y + 'px'

            knight.style.backgroundImage = `url("${color === 'white' ? this.states[0] : this.states[1]}")`

            this.board.appendChild(knight)

            return {
                knight,
                x,
                y,
                start,
                selected: false,
                color
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

            this.knights.forEach(knight => {
                if (knight.color === 'white') {
                    if (!(knight.x === 0 && knight.y === 0) && !(knight.x === 2 && knight.y === 0)) {
                        finished = false
                    }
                } else {
                    if (!(knight.x === 0 && knight.y === 2) && !(knight.x === 2 && knight.y === 2)) {
                        finished = false
                    }
                }
            })

            return finished
        },
        move(knight, tile) {
            knight.x = tile.x
            knight.y = tile.y

            knight.knight.style.left = this.size / 3 * tile.x + 'px'
            knight.knight.style.top = this.size / 3 * tile.y + 'px'

            this.unselectAll()

            this.turn = this.turn === 'white' ? 'dark' : 'white'
        },
        highlightTile() {
            this.checkMove().forEach(tile => {
                let can = true

                this.knights.forEach(knight => {
                    if (knight.x === tile.x && knight.y === tile.y) can = false
                })

                if (can) {
                    tile.tile.classList.add('move')
                    tile.move = true
                }
            })
        },
        checkMove() {
            let tiles = []

            this.knightMoves.forEach(move => {
                let tile = this.getTile(move[0] + this.selectedKnight().x, move[1] + this.selectedKnight().y)

                if (tile) {
                    let can = true

                    this.knights.forEach(knight => {
                        if (knight.x === tile.x && knight.y === tile.y) can = false
                    })

                    if (can) {
                        tiles.push(tile)
                    }
                }
            })

            return tiles
        },
        getTile(x, y) {
            let tile = null

            this.tiles.forEach(t => {
                if (t.x === x && t.y === y) tile = t
            })

            return tile
        },
        unselectAll() {
            this.knights.forEach(knight => {
                knight.selected = false
                knight.knight.classList.remove('selected')
            })
            this.tiles.forEach(tile => {
                tile.move = false
                tile.tile.classList.remove('move')
            })
        },
        selectedKnight() {
            let knight = null

            this.knights.forEach(k => {
                if (k.selected) knight = k
            })

            return knight
        }
    },
}
</script>

<style scoped>

</style>
