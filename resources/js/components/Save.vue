<template>
    <div class="container-fluid h-100 scene-container" :style="this.setBg(this.bg)" :class="this.show? '' : 'd-none'">
        <div class="title-container" :class="this.$store.state.showHeader ? 'header-show' : ''">
            <h3 class="py-4 text-center western" :class="[this.setColorMode(), this.$store.state.darken ? 'text-white' : '']">{{ this.$store.getters.title.text }}</h3>

            <div class="main-menu-actions">
                <a @click="() => this.$parent.toggleHeader()" class="menu-show animate__animated animate__heartBeat" :class="[this.setColorMode(), this.$store.state.darken ? 'text-white' : '']">
                    <i class="far fa-lg" :class="this.$store.state.showHeader ? 'fa-eye-slash' : 'fa-eye'"></i>
                </a>
            </div>
        </div>

        <div class="login textInfo-container">
            <div class="login-card">
                <p><strong>Charger une sauvegarde :</strong></p>
                <div class="d-flex flex-column">
                    <a @click="this.loadGroup" class="btn btn-primary text-white mb-3" v-if="this.$store.state.user.party" style="border-radius: 0">Charger la sauvegarde de groupe</a>
                    <a @click="this.loadSolo" class="btn btn-info text-white" style="border-radius: 0">Charger la sauvegarde solo</a>
                </div>
                <hr>
                <p><strong>Nouvelle sauvegarde :</strong></p>
                <!-- <a @click="this.createGroup" class="link d-block mb-3" v-if="this.$store.getters.isLeader">Nouvelle sauvegarde de groupe</a> -->
                <a @click="this.rebaseSolo" class="link d-block mb-3" v-if="this.$store.state.user.party">Charger la sauvegarde de groupe en solo</a>
                <a @click="this.createSolo" class="link d-block">Nouvelle sauvegarde solo</a>
            </div>
        </div>

    </div>
</template>

<script>
import allMixins from "../mixins";

export default {
    name: 'Save',
    mixins: [...allMixins],
    props: ['actions', 'show'],
    data() {
        return {
            showHeader: true,
        }
    },
    computed: {
        currentAction: function () {
            return this.$store.getters.currentAction
        },
        bg() {
            return this.$store.state.currentScene.content.bg
        },
        user() {
            return this.$store.state.user
        },
    },
    methods: {
        loadGroup() {
            if (!this.$store.state.user.party.group_save) {
                this.createGroup()
            } else {
                axios.get('/game/save/group/load').then(response => {
                    this.$store.dispatch('showToast', {
                        title: 'Western Game',
                        content: 'Sauvegarde de groupe chargée'
                    })

                    this.$store.dispatch('saveMode', 'group')
                    this.$store.dispatch('loadSave', response.data.save);
                }).catch(error => {
                    console.log(error)
                    this.$store.dispatch('showToast', {
                        title: 'Erreur',
                        content: 'Une erreur est survenue, veuillez nous contacter'
                    })
                })
            }
        },
        loadSolo() {
            if (!this.$store.state.user.solo_save) {
                this.createSolo()
            } else {
                axios.get('/game/save/solo/load').then(response => {
                    this.$store.dispatch('showToast', {
                        title: 'Western Game',
                        content: 'Sauvegarde solo chargée'
                    })

                    this.$store.dispatch('saveMode', 'solo')
                    this.$store.dispatch('loadSave', response.data.save);
                }).catch(error => {
                    console.log(error)
                    this.$store.dispatch('showToast', {
                        title: 'Erreur',
                        content: 'Une erreur est survenue, veuillez nous contacter'
                    })
                })
            }
        },
        createGroup() {
            let createSave = true

            if (this.user.party.group_save) {
                createSave = window.confirm('Créér une nouvelle sauvegarde écrasera la sauvegarde actuelle, voulez-vous vraiment continuer ?')
            }

            if (createSave) {
                axios.get('/game/save/group/create').then(response => {
                    this.$store.dispatch('showToast', {
                        title: 'Western Game',
                        content: 'Nouvelle sauvegarde créée'
                    })

                    this.$store.dispatch('saveMode', 'group')
                    this.$store.dispatch('loadSave', response.data.save);
                }).catch(error => {
                    this.$store.dispatch('showToast', {
                        title: 'Erreur',
                        content: 'Une erreur est survenue, veuillez nous contacter'
                    })
                })
            }
        },
        createSolo() {
            let createSave = true

            if (this.$store.state.user.solo_save) {
                createSave = window.confirm('Créér une nouvelle sauvegarde écrasera la sauvegarde actuelle, voulez-vous vraiment continuer ?')
            }

            if (createSave) {
                axios.get('/game/save/solo/create').then(response => {
                    this.$store.dispatch('showToast', {
                        title: 'Western Game',
                        content: 'Nouvelle sauvegarde créée'
                    })

                    this.$store.dispatch('saveMode', 'solo')
                    this.$store.dispatch('loadSave', response.data.save);
                }).catch(error => {
                    this.$store.dispatch('showToast', {
                        title: 'Erreur',
                        content: 'Une erreur est survenue, veuillez nous contacter'
                    })
                })
            }
        },
        rebaseSolo() {
            let rebaseSave = window.confirm('Cette action va mettre au même niveau votre sauvegarde de groupe et votre sauvegarde solo, cette action va donc écraser votre sauvegarde actuelle, ' +
                'voulez-vous vraiment continuer ?')

            if (rebaseSave) {
                axios.get('/game/save/solo/rebase').then(response => {
                    if (response.data.save) {
                        this.$store.dispatch('showToast', {
                            title: 'Western Game',
                            content: 'Sauvegarde importée'
                        })

                        this.$store.dispatch('saveMode', 'solo')
                        this.$store.dispatch('loadSave', response.data.save);
                    }
                }).catch(error => {
                    this.$store.dispatch('showToast', {
                        title: 'Erreur',
                        content: 'Une erreur est survenue, veuillez nous contacter'
                    })
                })
            }
        }
    }
}
</script>

<style scoped>

</style>
