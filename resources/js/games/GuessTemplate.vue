<template>
    <div class="login-card p-md-4">
        <p class="text-center" v-html="this.question"></p>

        <p v-if="this.showResume"> {{ this.resume }}</p>
        <a @click="() => {this.showResume = true}" class="mb-3 link d-block" v-if="this.resume && !this.showResume">Résumé de la conversation</a>

        <form method="post" @submit="this.finished" v-if="!this.success">
            <div class="mb-3">
                <label for="answer" class="form-label">Réponse :</label>
                <input type="text" class="form-control" id="answer" v-model="answer" :class="this.error ? 'is-invalid' : ''" required autofocus>

                <small class="text-danger" v-if="this.error">Mauvaise réponse !</small>
            </div>

            <div class="d-flex justify-content-center align-items-center">
                <a @click="doShowHint()" class="me-4 link" v-if="this.hint">Indice</a>
                <button type="submit" class="btn btn-orange text-white">Valider</button>
                <a :href="this.notice" class="ms-4 link" target="_blank" v-if="this.notice">Notice <i class="fas fa-external-link-alt"></i></a>
            </div>
            <hr v-if="this.showHint">
            <p v-if="this.showHint" v-html="'Indice : <br>' + this.hint"></p>
        </form>

        <p class="text-center text-success" v-if="this.success">{{ this.goodAnswer }} <br> Bonne réponse !</p>
    </div>
</template>

<script>
export default {
    name: 'GuessTemplate',
    props: ['question', 'hint', 'accepted', 'goodAnswer', 'notice', 'resume'],
    data() {
        return {
            answer: '',
            success: false,
            showHint: false,
            error: false,
            showResume: false,
        }
    },
    methods: {
        finished(event) {
            event.preventDefault()

            if (this.isFinished()) {
                this.success = true

                setTimeout(() => {
                    this.$parent.gameFinished()
                }, 1000)
            } else {
                this.error = true
            }
        },
        isFinished() {
            return this.accepted.includes(this.answer.toLowerCase())
        },
        doShowHint() {
            if (window.confirm('Afficher l\'indice entrainera un malus sur votre score final, continuer ?')) {
                this.$parent.hintUsed()
                this.showHint = true
            }
        }
    }
}
</script>

<style scoped>

</style>
