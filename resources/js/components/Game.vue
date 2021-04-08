<template>
    <div class="map container" :style="this.display? '' : 'display: none'">

        <div class="textInfo-container map-container animate__animated animate__faster" :class="!this.showing ? 'animate__zoomIn' : 'animate__zoomOut'">
            <Fifteen v-if="this.name === 'fifteen' && this.show"></Fifteen>
            <Leds v-if="this.name === 'leds' && this.show"></Leds>
            <Nguess v-if="this.name === 'nguess' && this.show"></Nguess>
            <Passcode v-if="this.name === 'passcode' && this.show"></Passcode>
            <Cards v-if="this.name === 'cards' && this.show"></Cards>
            <Cesar v-if="this.name === 'cesar' && this.show"></Cesar>
            <Knights v-if="this.name === 'knights' && this.show"></Knights>
            <Saloon v-if="this.name === 'saloon' && this.show" v-bind:show="this.show"></Saloon>
            <Signals v-if="this.name === 'signals' && this.show"></Signals>
            <Wannabe v-if="this.name === 'wannabe' && this.show"></Wannabe>
            <Smooth v-if="this.name === 'smooth' && this.show"></Smooth>
            <Everytime v-if="this.name === 'everytime' && this.show"></Everytime>
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
import {baseURL, consoleTyper, sceneManagement} from '../mixins';
import Fifteen from "../games/Fifteen";
import Arrow from "./Arrow";
import Leds from "../games/Leds";
import Nguess from "../games/Nguess";
import Passcode from "../games/Passcode";
import Cards from "../games/Cards";
import Cesar from "../games/Cesar";
import Knights from "../games/Knights";
import Saloon from "../games/Saloon";
import Signals from "../games/Signals";
import Smooth from "../games/Smooth";
import Wannabe from "../games/Wannabe";
import Everytime from "../games/Everytime";

export default {
    name: 'Game',
    components: {Wannabe, Everytime, Smooth, Signals, Saloon, Knights, Cesar, Cards, Passcode, Nguess, Fifteen, Arrow, Leds},
    props: ['name', 'text', 'index'],
    mixins: [sceneManagement, baseURL, consoleTyper],
    methods: {
        toTyper() {
            let elt = this.$el.querySelectorAll('.consoleTyper')[0]

            if (elt) {
                this.consoleTyper(elt, elt.innerHTML)
            }
        },
        gameFinished() {
            this.showArrow = true
            let arrow = this.$el.querySelectorAll('.arrow-container')[0]
            if (arrow) arrow.dispatchEvent(new Event('showArrow'))
        }
    }
}
</script>

<style scoped>

</style>
