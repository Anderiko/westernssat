import {prologue} from './prologue'
import {act1} from './act1'
import {act2} from './act2'
import {act3} from './act3'
import {epilogue} from './epilogue'
import {credits} from './credits'

export let game = [
    {
        type: 'save',
        content: {
            bg: 'images/backgrounds/bg_welcome.jpeg',
            title: {
                dark: false,
                text: 'Sauvegardes'
            },
            currentAction: 0,
            actions: [
                {
                    type: 'save'
                },
            ]
        }
    },
    ...prologue,
    ...act1,
    ...act2,
    ...act3,
    ...epilogue,
    ...credits
]
