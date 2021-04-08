export let prologue = [
    {
        type: 'scene',
        content: {
            bg: null,
            title: {
                dark: true,
                text: 'Prologue'
            },
            currentAction: 0,
            actions: [
                {
                    type: 'info',
                    text: 'Nous vous conseillons de regarder le trailer de la liste avant d\'aller plus loin dans le jeu. Il intervient comme le prologue de l\'histoire qui va suivre.'
                },
            ]
        }
    },
    {
        type: 'scene',
        content: {
            bg: 'images/game/bg/coffre_vide.png',
            title: {
                dark: true,
                text: 'Prologue'
            },
            currentAction: 0,
            actions: [
                {
                    type: 'info',
                    text: 'Depuis le braquage, nul n\'a été en mesure de retrouver le butin. Marshall Karo épaulée par Myra Starr et Walker ont tentés de suivre la trace des bandits mais le trésor de leur région reste introuvable. Même le célèbre Unlucky Luke s\'y est risqué sans succès... cela a du sens...'
                },
            ]
        }
    },
    {
        type: 'scene',
        content: {
            bg: 'images/game/bg/lonesome-cowboy.jpeg',
            title: {
                dark: true,
                text: 'Prologue'
            },
            currentAction: 0,
            actions: [
                {
                    type: 'info',
                    text: 'Alors que tout espoir semblait perdu, un rookie vient de s\'installer dans la contrée et apparaît comme une lueur dans la tempête... ce rookie... c\'est vous ! C\'est désormais votre tour de rejoindre la célèbre ville de Lannion Town pour mener l\'enquête, pister les bandits et enfin découvrir où se cachent les lingots. C\'est le Phare Ouest tout entier qui place son avenir entre vos mains, ne le décevez pas !'
                },
            ]
        }
    },
    {
        type: 'scene',
        content: {
            bg: 'images/game/bg/lannion.png',
            title: {
                dark: true,
                text: 'Prologue'
            },
            currentAction: 0,
            actions: [
                {
                    type: 'info',
                    text: 'Vous arrivez dans la petite ville de Lannion Town, désormais connue dans tout le Phare Ouest suite au braquage. Dans le journal on parle de \"L\'affaire des lingots salés\", sacré titre n\'est-ce-pas ?'
                },
                {
                    type: 'info',
                    text: 'Ce mérite revient à l\'imprimeur local, on l\'appelle Doc ! Il enregistre votre progression dans son journal [Sauvegardes automatiques]. Mais le temps presse, vous aurez tout le temps de découvrir la ville une fois cette enquête résolue, d\'ailleurs ne serait-ce pas Marshall Karo qui vient à votre rencontre ?'
                },
                {
                    type: 'dialog',
                    content: {
                        character: {
                            name: 'Marshall Karo',
                            picture: 'images/game/characters/karole.png'
                        },
                        text: 'Hey gamin ! Merci d\'avoir répondu présent à mon invitation, c\'est pas que je commençais à perdre le moral mais les temps sont durs et beaucoup baissent les bras... M\'enfin d\'après ce qu\'on dit sur vous je peux continuer d\'y croire encore un peu. Désolé, très peu motivant comme discours pour un marshall pas vrai ?'
                    }
                },
                {
                    type: 'dialog',
                    content: {
                        character: {
                            name: 'Marshall Karo',
                            picture: 'images/game/characters/karole.png'
                        },
                        text: 'Je crois en vous cowboy ! le Phare Ouest tout entier croit en vous, faites honneur à votre réputation et ramenez moi le trésor de ma contrée. Voici la carte de la ville elle vous servira tout le long de l\'enquête après tout vous venez d\'arriver.'
                    }
                },
                {
                    type: 'dialog',
                    content: {
                        character: {
                            name: 'Marshall Karo',
                            picture: 'images/game/characters/karole.png'
                        },
                        text: 'Les lieux les plus importants de la ville y sont répertoriés c\'est sûrement là que vous trouverez des indices. Allez voir les banquiers, c\'est quand même eux qui étaient aux premières loges lorsque ces bandits ont débarqués, ils vous détailleront les faits bien mieux que moi. J\'compte sur vous cowboy !'
                    }
                },
                {
                    type: 'map',
                    content: {
                        text: 'Vous avez désormais accès à la Banque !',
                        file: ['images/game/maps/banque.png']
                    }
                }
            ]
        }
    },
]
