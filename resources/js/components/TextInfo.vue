<template>
    <div class="textInfo animate__animated animate__faster container" :class="!this.showing ? 'animate__zoomIn' : 'animate__zoomOut'" :style="this.display? '' : 'display: none'">
        <p class="text-white m-0 fst-italic">
            <span :class="this.show ? 'consoleTyper' : ''">{{ this.text }}</span>
        </p>
        <!-- <a @click="this.toggleShowing" class="text-white arrow" :class="this.showArrow ? '' : 'd-none'">NEXT {{ this.showArrow }}</a> -->
        <Arrow></Arrow>
    </div>
</template>

<script>
import {consoleTyper, sceneManagement} from "../mixins";
import Arrow from "./Arrow";

export default {
    name: 'TextInfo',
    components: {Arrow},
    props: ['index', 'text'],
    mixins: [consoleTyper, sceneManagement],
}
</script>

<style scoped>

</style>
