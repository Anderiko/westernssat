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
    name: 'Smooth',
    components: {GuessTemplate},
    data() {
        return {
            question: 'Annie, est ce que ça va ? <br> ' +
                'Alors, Annie, est ce que ça va ? Est-ce que ça va Annie ? <br> ' +
                'Annie, est ce que ça va ? <br> ' +
                'Alors, Annie, est ce que ça va ? Est-ce que ça va Annie ? <br>' +
                'Annie, est ce que ça va ? <br>' +
                'Vas-tu nous dire que ça va <br>',
            hint: 'Michael Jackson',
            accepted: [
                'smooth criminal',
            ],
            goodAnswer: 'Smooth Criminal !'
        }
    },
    methods: {
        gameFinished() {
            this.$parent.gameFinished()
        },
        hintUsed() {
            axios.post('/game/hint', {
                game: 'smoothcriminal'
            }).then(response => {
                console.log('Hint used !')
            })
        }
    }
}
</script>

<style scoped>

</style>
