export let epilogue = [
    {
        type: 'scene',
        content: {
            bg: 'images/backgrounds/bg_welcome.jpeg',
            title: {
                dark: false,
                text: 'Phare'
            },
            currentAction: 0,
            actions: [
                {
                    type: 'info',
                    text: 'Vous arrivez au phare, c’est là que la carte mène. Le phare servait au bateau pour les guider à travers les rochers et la nuit, il représentait une lueur d’espoir, cette lueur c’est vous.'
                },
                {
                    type: 'dialog',
                    content: {
                        character: {
                            name: 'Marshall Karo',
                            picture: 'images/game/characters/karole.png'
                        },
                        text: 'Quelle ironie de terminer au phare, c’était devant nous tout ce temps ? Je n’en peux plus d’attendre, où est il ?'
                    }
                },
                {
                    type: 'info',
                    text: 'Vous descendez les escaliers du phare'
                },
                {
                    type: 'info',
                    text: 'Vous trouvez une caverne cachée'
                },
                {
                    type: 'info',
                    text: 'Vous découvrez un énorme sace de lingots de beurre salé'
                },
                {
                    type: 'dialog',
                    content: {
                        character: {
                            name: 'Marshall Karo',
                            picture: 'images/game/characters/karole.png'
                        },
                        text: 'Le voilà enfin ! Après tout ce temps ma contrée est sauvée, il me tarde de l’annoncer à Myra et Walker ainsi qu’au reste de la ville.'
                    }
                },
                {
                    type: 'dialog',
                    content: {
                        character: {
                            name: 'Marshall Karo',
                            picture: 'images/game/characters/karole.png'
                        },
                        text: 'Bien entendu tout ceci est grâce à vous, vous avez résolu l’enquête ! Je ne peux que vous remercier infiniment.'
                    }
                },
                {
                    type: 'dialog',
                    content: {
                        character: {
                            name: 'Marshall Karo',
                            picture: 'images/game/characters/karole.png'
                        },
                        text: 'Finalement, vous avez pu découvrir la ville au cours de cette énigme, vous y avez rencontré tous ses habitants et peut être vous êtes vous attachés à certains d’entre eux. Au-delà de cette aventure, ils pourraient partager votre quotidien et vous aider chacun à leur manière de pleinement profiter de Lannion Town. '
                    }
                },
                {
                    type: 'dialog',
                    content: {
                        character: {
                            name: 'Marshall Karo',
                            picture: 'images/game/characters/karole.png'
                        },
                        text:
                        'Choisirez vous de vous installer au Phare ouest ? C’est peut être le casse-tête le plus important de cette aventure et pourtant la solution est la plus simple… '
                    }
                },
                {
                    type: 'info',
                    text: 'Votez Western\'ssat'
                },
            ]
        }
    },
]
