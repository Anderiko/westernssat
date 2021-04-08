<template>
    <div class="container-fluid h-100 scene-container" :style="this.setBg(this.bg)" :class="this.show? '' : 'd-none'">
        <div class="title-container" :class="this.$store.state.showHeader ? 'header-show' : ''">
            <h3 class="py-4 text-center western" :class="[this.setColorMode(), this.$store.state.darken ? 'text-white' : '']">{{ this.$store.getters.title.text }}</h3>

            <div class="main-menu-actions">
                <a @click="() => this.$parent.toggleHeader()" class="menu-show" :class="[this.setColorMode(), this.$store.state.darken ? 'text-white' : '']">
                    <i class="far fa-lg" :class="this.$store.state.showHeader ? 'fa-eye-slash' : 'fa-eye'"></i>
                </a>
            </div>
        </div>

        <Game
            v-for="(elt, index) in this.actions"
            :key="index"
            v-if="elt.type === 'game' || elt.type === 'guess'"
            v-bind:index="index"
            v-bind:name="elt.content.name"
            v-bind:text="elt.content.text">

        </Game>

        <Map
            v-for="(elt, index) in this.actions"
            :key="index"
            v-if="elt.type === 'map'"
            v-bind:index="index"
            v-bind:text="elt.content.text"
            v-bind:file="elt.content.file">

        </Map>

        <div class="scene">
            <div class="textInfo-container">
                <TextInfo
                    v-for="(elt, index) in this.actions"
                    :key="index"
                    v-if="elt.type === 'info'"
                    v-bind:index="index"
                    v-bind:text="elt.text">
                </TextInfo>
            </div>

            <div class="dialog-container">
                <Dialog
                    v-for="(elt, index) in this.actions"
                    :key="index"
                    v-if="elt.type === 'dialog'"
                    v-bind:index="index"
                    v-bind:imgUrl="elt.content.character.picture"
                    v-bind:name="elt.content.character.name"
                    v-bind:dialog="elt.content.text">
                </Dialog>
            </div>
        </div>
    </div>
</template>

<script>
import TextInfo from "./TextInfo";
import Dialog from "./Dialog";
import allMixins from "../mixins";
import Map from "./Map";
import Game from "./Game";

export default {
    name: 'Scene',
    components: {Map, TextInfo, Dialog, Game},
    mixins: [...allMixins],
    props: ['actions', 'show', 'index'],
    data() {
        return {
            showHeader: true,
        }
    },
    computed: {
        currentAction() {
            return this.$store.getters.currentAction
        },
        bg() {
            return this.$store.state.currentScene.content.bg
        },
        showed() {
            return this.$store.state.sceneIndex >= this.index
        }
    }
}
</script>

<style scoped>

</style>
