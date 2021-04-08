import Vue from 'vue'
import Vuex from 'vuex'
import config from "../bootstrap"

import {game} from './save'

Vue.use(Vuex)

const store = new Vuex.Store({
    state: {
        user: null,
        base: config.url,
        darken: true,
        showHeader: true,
        game: game,
        currentScene: game[0],
        sceneIndex: 0,
        gameEnded: false,
        restricted: ['game', 'click', 'save'],
        toast: {
            title: null,
            content: null
        },
        saving: 'solo'
    },
    mutations: {
        saveMode(state, mode) {
            state.saving = mode
        },
        loadSave(state, save) {
            state.sceneIndex = save.sceneIndex
            state.currentScene = state.game[state.sceneIndex]
            state.currentScene.content.currentAction = save.actionIndex
        },
        saveUser(state, user) {
            state.user = user
        },
        nextStep(state) {
            state.currentScene.content.currentAction++

            state.darken = !state.restricted.includes(state.currentScene.content.actions[state.currentScene.content.currentAction].type)
        },
        nextScene(state) {
            state.sceneIndex++
            state.currentScene = state.game[state.sceneIndex]
        },
        endGame(state) {
            state.gameEnded = true
        },
        showHeader(state, value) {
            state.showHeader = value
        },
        darken(state, value) {
            state.darken = value
        },
        showToast(state, toast) {
            state.toast = toast
        },
        dismissToast(state) {
            state.toast = {
                title: null,
                content: null
            }
        }
    },
    actions: {
        saveMode({commit}, mode) {
            commit('saveMode', mode)
        },
        loadSave({commit, state}, save) {
            commit('loadSave', save)

            let elt = document.getElementById('app') || null
            if (elt) elt.dispatchEvent(new Event('saveLoaded'))
        },
        saveUser({commit}, user) {
            commit('saveUser', user)
        },
        nextStep({commit, state}) {
            let event = new Event('nextStep')

            if (state.currentScene.content.actions.length - 1 < state.currentScene.content.currentAction + 1) {

                if (state.game.length - 1 < state.sceneIndex + 1) {
                    console.log('end game')
                    commit('endGame')
                } else {
                    event = new Event('nextScene')
                    commit('nextScene')
                }

            } else {
                commit('nextStep')
            }

            document.getElementById('app').dispatchEvent(event)

            axios.get('/game/token').then(response => {

                if (state.gameEnded) {
                    axios.post('/game/end/' + state.saving, {
                        api_token: response.data.token
                    }).then(response => {
                        console.log("Game ended !")
                    })
                } else {
                    axios.post('/game/save/' + state.saving, {
                        sceneIndex: state.sceneIndex,
                        actionIndex: state.currentScene.content.currentAction,
                        api_token: response.data.token
                    }).then(response => {
                        console.log("Progress saved !")
                    })
                }

            })
        },
        showHeader({commit}, value) {
            commit('showHeader', value)
        },
        toggleHeader({commit, state}) {
            commit('showHeader', !state.showHeader)
        },
        darken({commit}, value) {
            commit('darken', value)
        },
        showToast({commit}, toast) {
            commit('showToast', toast)
            document.getElementById('app').dispatchEvent(new Event('showToast'))
        },
        dismissToast({commit}) {
            commit('dismissToast')
        },
    },
    getters: {
        title: state => {
            return state.currentScene.content.title
        },
        actions: state => {
            return state.currentScene.content.actions
        },
        currentAction: state => {
            return state.currentScene.content.currentAction
        },
        isLeader: state => {
            if (state.user.party) {
                return state.user.party.user_id === state.user.id
            } else {
                return false
            }
        }
    }
})

export default store
