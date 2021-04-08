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
    name: 'Everytime',
    components: {GuessTemplate},
    data() {
        return {
            question:   'J’entends encore ta voix quand tu dors à côté de moi <br>' +
                        'Je sens encore ton touché dans mes rêves <br>' +
                        'Pardonne-moi ma faiblesse mais je ne sais pas pourquoi <br>' +
                        'Sans toi c’est difficile de survivre <br>',
            hint:   'Car à chaque fois qu’on se touche <br> ' +
                    'J’ai ce sentiment <br> ' +
                    'A chaque fois qu’on s’embrasse <br> ' +
                    'Je jure pouvoir voler <br>' +
                    'Ne peux tu pas sentir mon cœur battre rapidement  <br>' +
                    'Je veux que ça s’arrête <br>' +
                    'Besoin de toi à mes côtés',
            accepted: [
                'every time we touch',
                'everytime we touch',
                'cause every time we touch',
                'cause everytime we touch',
                'because every time we touch',
                'because everytime we touch',
            ],
            goodAnswer: 'Every Time We Touch !'
        }
    },
    methods: {
        gameFinished() {
            this.$parent.gameFinished()
        },
        hintUsed() {
            axios.post('/game/hint', {
                game: 'everytimewetouch'
            }).then(response => {
                console.log('Hint used !')
            })
        }
    }
}
</script>

<style scoped>

</style>
