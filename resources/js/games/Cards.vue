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
    name: "Cards",
    components: {GuessTemplate},
    data() {
        return {
            question: 'On me met sur la table, on me coupe, pourtant on ne me mange pas. De plus on me bat par plaisir. Qui suis-je ?',
            hint: 'Je peux être de 4 couleurs : rouge ou noir',
            accepted: [
                'cartes',
                'carte',
                'des cartes',
                'les cartes',
                'jeu de carte',
                'jeu de cartes',
                'un jeu de carte',
                'un jeu de cartes',
            ],
            goodAnswer: 'Un jeu de cartes !'
        }
    },
    methods: {
        gameFinished() {
            this.$parent.gameFinished()
        },
        hintUsed() {
            axios.post('/game/hint', {
                game: 'cards'
            }).then(response => {
                console.log('Hint used !')
            })
        }
    }
}
</script>

<style scoped>

</style>
