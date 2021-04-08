<template>
    <div class="arrow-container" :class="this.$parent.showArrow ? '' : 'd-none'" @click="this.next">
        <div class="arrow">
            <canvas class="timer" height="40" width="40" id="timer">
            </canvas>

            <i class="fas fa-lg fa-arrow-alt-right arrow text-white"></i>
        </div>
    </div>


</template>

<script>
export default {
    name: 'Arrow',
    data() {
        return {
            progress: 0,
            canvas: null,
            size: 400,
            ctx: null,
            timer: null
        }
    },
    mounted() {
        this.canvas = this.$el.querySelector('#timer')
        this.canvas.width = this.canvas.height = this.size
        this.ctx = this.canvas.getContext('2d')
        this.ctx.translate(this.size / 2, this.size / 2);
        this.ctx.rotate((-1 / 2) * Math.PI);

        this.draw()

        this.$el.addEventListener('showArrow', event => {
            this.timer = setInterval(() => this.draw(), 10)
        })
    },
    methods: {
        next() {
            clearInterval(this.timer)
            this.$parent.toggleShowing()
        },
        cancel() {
            clearInterval(this.timer)
        },
        draw() {
            if (this.progress >= 100) {
                this.next()
            }

            this.drawCircle('#fff', 10, this.progress / 100);

            this.progress += .1
        },
        drawCircle(color, lineWidth, percent) {
            percent = Math.min(Math.max(0, percent), 1)
            let radius = (this.size - lineWidth) / 2;

            this.ctx.beginPath()
            this.ctx.arc(0, 0, radius, 0, Math.PI * 2 * percent, false)
            this.ctx.strokeStyle = color
            this.ctx.lineCap = 'round'
            this.ctx.lineWidth = lineWidth
            this.ctx.stroke()
        }
    }
}
</script>

<style scoped>

</style>
