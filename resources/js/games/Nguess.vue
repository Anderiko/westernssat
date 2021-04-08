<template>
    <div class="login d-flex justify-content-center align-items-center">
        <GuessTemplate
            v-bind:question="question"
            v-bind:hint="hint"
            v-bind:accepted="accepted"
            v-bind:goodAnswer="goodAnswer"></GuessTemplate>
    </div>
</template>

<script>
import GuessTemplate from "./GuessTemplate"

export default {
    name: "Nguess",
    components: {GuessTemplate},
    data() {
        return {
            question: 'Je suis dans l\'étang et au fond du jardin. Je commence la nuit et finis le matin, pourtant j\'apparais deux fois dans l\'année. Qui suis-je ?',
            hint: 'Je suis seul parmi 26.',
            accepted: [
                'n',
                'lettre n',
                'la lettre n'
            ],
            goodAnswer: 'La lettre N !'
        }
    },
    methods: {
        gameFinished() {
            this.$parent.gameFinished()
        },
        hintUsed() {
            axios.post('/game/hint', {
                game: 'nguess'
            }).then(response => {
                console.log('Hint used !')
            })
        }
    }
}
</script>

<style scoped>

</style>
