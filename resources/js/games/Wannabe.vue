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
    name: 'Wannabe',
    components: {GuessTemplate},
    data() {
        return {
            question: 'Si tu veux mon futur, oublie mon passé <br> ' +
                'Si tu veux sortir avec moi, mieux vaut faire vite <br> ' +
                'Maintenant ne gâche pas mon précieux temps <br> ' +
                'Ressaisis toi on pourrait juste bien s’entendre. <br>',
            hint: 'Yo, je te dirai ce que je veux, ce que je veux vraiment, vraiment <br>' +
                'Donc dis moi ce que tu veux, ce que tu veux vraiment, vraiment. ',
            accepted: [
                'wanna be',
                'wannabe',
            ],
            goodAnswer: 'Wannabe !'
        }
    },
    methods: {
        gameFinished() {
            this.$parent.gameFinished()
        },
        hintUsed() {
            axios.post('/game/hint', {
                game: 'wannabe'
            }).then(response => {
                console.log('Hint used !')
            })
        }
    }
}
</script>

<style scoped>

</style>
