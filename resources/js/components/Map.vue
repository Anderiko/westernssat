<template>
    <div class="map container" :style="this.display? '' : 'display: none'">

        <div class="textInfo-container map-container animate__animated animate__faster" :class="!this.showing ? 'animate__zoomIn' : 'animate__zoomOut'">
            <img :src="this.url('images/game/maps/map.jpeg')" alt="" class="maps">
            <img
                v-for="(filename, index) in this.file"
                :key="index"
                :src="url(filename)" alt="" class="destination maps">
        </div>

        <div class="dialog-container">
            <div class="dialog w-100">
                <div class="text-wrapper container w-100 animate__animated animate__faster" :class="!this.showing? 'animate__fadeInUp' : 'animate__fadeOutDown'">
                    <div class="text w-100">
                        <div class="content">
                            <p :class="this.show ? 'consoleTyper' : ''" class="m-0">{{ this.text }}</p>
                        </div>
                    </div>
                    <Arrow></Arrow>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import {baseURL, consoleTyper, sceneManagement} from "../mixins";
import Arrow from "./Arrow";

export default {
    name: 'Map',
    props: ['file', 'text', 'index'],
    mixins: [sceneManagement, baseURL, consoleTyper],
    components: {Arrow}
}
</script>

<style scoped>

</style>
