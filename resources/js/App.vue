<template>
    <div class="app" :class="this.$store.state.darken ? 'show' : ''" id="app" v-if="this.$store.state.user">
        <Scene
            v-for="(scene, index) in this.$store.state.game"
            :key="index"
            v-if="scene.type === 'scene'"
            v-bind:index="index"
            v-bind:actions="scene.content.actions"
            v-bind:show="index === sceneIndex"
            v-bind:showed="index < sceneIndex">
        </Scene>

        <Save
            v-for="(save, index) in this.$store.state.game"
            :key="index"
            v-if="save.type === 'save'"
            v-bind:actions="save.content.actions"
            v-bind:show="index === sceneIndex"
            v-bind:showed="index < sceneIndex">
        </Save>

        <Toast v-if="this.$store.state.toast.title"></Toast>
    </div>
</template>

<script>
import Scene from "./components/Scene";
import Save from "./components/Save";
import Toast from "./components/Toast";
import allMixins, {animateCSS} from './mixins'
import 'animate.css/animate.min.css'

export default {
    name: 'App',
    mixins: [...allMixins, animateCSS],
    components: {Scene, Save, Toast},
    data() {
        return {
            changing: false,
        }
    },
    methods: {
        toggleHeader() {
            let header = $('header')

            if (this.$store.state.showHeader) {
                header.hide('fast')
            } else {
                header.show('fast')
            }

            this.$store.dispatch('toggleHeader')
        }
    },
    computed: {
        sceneIndex() {
            return this.$store.state.sceneIndex
        },
    },
}
</script>

<style scoped>

</style>
