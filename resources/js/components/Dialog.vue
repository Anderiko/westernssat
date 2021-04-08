<template>
    <div class="dialog w-100" :style="this.display? '' : 'display: none'">
        <div class="character container p-0 animate__animated animate__faster" :class="[!this.showing? this.animationIn : this.animationOut, this.index % 2 !== 0 ? 'right' : '']">
            <img :src="this.url(this.imgUrl)" alt="">
        </div>

        <div class="text-wrapper container w-100 animate__animated animate__faster" :class="!this.showing? 'animate__fadeInUp' : 'animate__fadeOutDown'">
            <div class="text w-100">
                <div class="name">
                    <p>{{ name }}</p>
                </div>

                <div class="content">
                    <p :class="this.show ? 'consoleTyper' : ''" class="m-0">{{ dialog }}</p>
                </div>
            </div>
            <Arrow></Arrow>
        </div>
    </div>
</template>

<script>
import {baseURL, consoleTyper, sceneManagement} from '../mixins';
import Arrow from "./Arrow";

export default {
    name: 'Dialog',
    components: {Arrow},
    mixins: [baseURL, consoleTyper, sceneManagement],
    props: ['index', 'imgUrl', 'name', 'dialog'],
    data() {
        return {
            animationIn: '',
            animationOut: ''
        }
    },
    mounted() {
        if (this.index % 2 !== 0) {
            this.animationIn = 'animate__fadeInRight'
            this.animationOut = 'animate__fadeOutRight'
        } else {
            this.animationIn = 'animate__fadeInLeft'
            this.animationOut = 'animate__fadeOutLeft'
        }
    }
}
</script>

<style scoped>

</style>
