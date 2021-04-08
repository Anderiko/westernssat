<template>
    <div class="login d-flex justify-content-center align-items-center">
        <GuessTemplate
            v-bind:question="question"
            v-bind:hint="hint"
            v-bind:accepted="accepted"
            v-bind:goodAnswer="goodAnswer"
            v-bind:resume="resume"></GuessTemplate>
    </div>
</template>

<script>
import GuessTemplate from "./GuessTemplate"

export default {
    name: "Passcode",
    components: {GuessTemplate},
    data() {
        return {
            question: 'Sept ? Que devez vous lui répondre ?',
            hint: null,
            accepted: [
                '4',
                'quatre',
            ],
            goodAnswer: 'Quatre !',
            resume: '- Trois ? Cinq.    - Six ? Trois.'
        }
    },
    methods: {
        gameFinished() {
            this.$parent.gameFinished()
        },
        hintUsed() {
            axios.post('/game/hint', {
                game: 'passcode'
            }).then(response => {
                console.log('Hint used !')
            })
        }
    }
}
</script>

<style scoped>

</style>
