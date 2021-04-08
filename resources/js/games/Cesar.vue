<template>
    <div class="login d-flex justify-content-center align-items-center">
        <GuessTemplate
            v-bind:question="question"
            v-bind:hint="hint"
            v-bind:accepted="accepted"
            v-bind:goodAnswer="goodAnswer"
            v-bind:notice="notice"></GuessTemplate>
    </div>
</template>

<script>
import GuessTemplate from "./GuessTemplate"

export default {
    name: "Cesar",
    components: {GuessTemplate},
    data() {
        return {
            question: 'Déchiffrez le code de l\'informateur : WUMJAWK',
            hint: null,
            accepted: [
                'ecuries',
                'écuries',
            ],
            goodAnswer: 'ECURIES !',
            notice: 'images/game/cours.svg'
        }
    },
    methods: {
        gameFinished() {
            this.$parent.gameFinished()
        },
        hintUsed() {
            axios.post('/game/hint', {
                game: 'cesar'
            }).then(response => {
                console.log('Hint used !')
            })
        }
    }
}
</script>

<style scoped>

</style>
