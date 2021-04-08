export let act1 = [
    {
        type: 'scene',
        content: {
            bg: 'images/game/bg/fond_vert_bank.jpeg',
            title: {
                dark: true,
                text: 'Banque'
            },
            currentAction: 0,
            actions: [
                {
                    type: 'info',
                    text: 'Vous arrivez à la Banque de Lannion Town, c\'est l\'endroit le plus sécurisé de la ville, du moins... ça l\'était... C\'est Trinita et Booker DeWitt qui en sont les trésoriers, ils gardent... plus grand-chose apparemment !'
                },
                {
                    type: 'dialog',
                    content: {
                        character: {
                            name: 'Trinita',
                            picture: 'images/game/characters/gaelle.png'
                        },
                        text: 'Que va-t-on faire désormais ?! Deux trésoriers sans trésor c\'est comme un cow-boy sans chapeau, un shérif sans étoile !'
                    }
                },
                {
                    type: 'dialog',
                    content: {
                        character: {
                            name: 'Trinita',
                            picture: 'images/game/characters/gaelle.png'
                        },
                        text: 'Oh tiens mais ne serais-tu pas le rookie dont le Marshall nous a parlé ? je t\'en prie retrouve notre trésor au plus vite je ressens comme un vide depuis qu\'il n\'est plus là et Booker a complètement perdu la tête...'
                    }
                },
                {
                    type: 'dialog',
                    content: {
                        character: {
                            name: 'Booker Dewitt',
                            picture: 'images/game/characters/dylan.png'
                        },
                        text: 'Le... Le précieux... Il me l\'a volé...'
                    }
                },
                {
                    type: 'dialog',
                    content: {
                        character: {
                            name: 'Trinita',
                            picture: 'images/game/characters/gaelle.png'
                        },
                        text: 'Vous voyez ?! Bref, malheureusement je crois que nous ne pouvons rien pour vous... Tout s\'est passé si vite, la peur m\'a envahit nous n\'avons rien pu faire et mes souvenirs ont été altéré par l\'adrénaline...'
                    }
                },
            ]
        }
    },
    {
        type: 'scene',
        content: {
            bg: null,
            title: {
                dark: true,
                text: 'Banque'
            },
            currentAction: 0,
            actions: [
                {
                    type: 'game',
                    content: {
                        text: 'La mémoire de Trinita et Booker est assez confuse, aidez les à retrouver leurs esprits en reformant l\'image ci-dessus, les pièces du puzzle ne se déplacent que dans l\'espace vide, bougez les successivement et intelligemment',
                        name: 'fifteen'
                    }
                },
            ]
        }
    },
    {
        type: 'scene',
        content: {
            bg: 'images/game/bg/fond_vert_bank.jpeg',
            title: {
                dark: true,
                text: 'Banque'
            },
            currentAction: 0,
            actions: [
                {
                    type: 'dialog',
                    content: {
                        character: {
                            name: 'Trinita',
                            picture: 'images/game/characters/gaelle.png'
                        },
                        text: 'Mais oui ! Je me souviens maintenant, ils étaient trois. Parmi eux il y avait Jesse James et Jack Daniels, de vraies crapules, ils n\'en sont pas à leur premier coup ça c\'est sûr... Quand au dernier je ne le connais pas.'
                    }
                },
                {
                    type: 'dialog',
                    content: {
                        character: {
                            name: 'Booker Dewitt',
                            picture: 'images/game/characters/dylan.png'
                        },
                        text: 'Ô Trinita ce n\'est pas le dernier mais la dernière et crois moi tu la connais enfin au moins de nom... tout le monde connaît son nom mais rare sont ceux qui ont pu voir son visage... elle se fait appeler Annie Oakley ça ne peut être qu\'elle, elle sait se camoufler à la perfection, peut être même que nous la cotoyons tous les jours sans nous en rendre compte...'
                    }
                },
                {
                    type: 'dialog',
                    content: {
                        character: {
                            name: 'Booker Dewitt',
                            picture: 'images/game/characters/dylan.png'
                        },
                        text: 'Vous cowboy maintenant que vous connaissez leurs identités allez rendre visite à Doc du côté de l\'imprimerie il est grand temps d\'afficher leur tête dans toute la ville. Il est aussi l\'un des seuls à connaître le visage de Annie, dépêchez-vous et ramenez moi mon précieux...enfin le trésor de la ville...'
                    }
                },
                {
                    type: 'map',
                    content: {
                        text: 'Vous avez désormais accès à l\'imprimerie !',
                        file: ['images/game/maps/banque.png', 'images/game/maps/imprimerie.png']
                    }
                }
            ]
        }
    },
    {
        type: 'scene',
        content: {
            bg: 'images/game/bg/lannion.png',
            title: {
                dark: true,
                text: 'Imprimerie'
            },
            currentAction: 0,
            actions: [
                {
                    type: 'info',
                    text: 'Ici c\'est l\'imprimerie de la ville, le repère de Doc ! Il est le rédacteur en chef du GossipWest le journal le plus suivi de la ville. Ses ressources vous seront précieuses pour créer les affiches des bandits et débuter les recherches.'
                },
                {
                    type: 'dialog',
                    content: {
                        character: {
                            name: 'Doc',
                            picture: 'images/game/characters/nathan.png'
                        },
                        text: 'Salut Cowboy ! Que puis je faire pour toi ?'
                    }
                },
                {
                    type: 'dialog',
                    content: {
                        character: {
                            name: 'Doc',
                            picture: 'images/game/characters/nathan.png'
                        },
                        text: 'Ca alors ! à peine quelques heures que tu es là et tu as déjà découvert leurs identités ! James, Oakley et Daniels de vraies canailles... J\'ai des portraits de chacun d\'entre eux, je dois dire que je suis pas peu fier de celle de Oakley. Aller suis moi on va lancer les impressions !'
                    }
                },
                {
                    type: 'dialog',
                    content: {
                        character: {
                            name: 'Doc',
                            picture: 'images/game/characters/nathan.png'
                        },
                        text: 'Malheureusement j\'ai dû la réparer récemment et j\'ai du mal à la rallumer depuis... Disons qu\'elle n\'en fait qu\'à sa tête ! Mais bon tu vas pouvoir m\'aider !'
                    }
                },
            ]
        }
    },
    {
        type: 'scene',
        content: {
            bg: null,
            title: {
                dark: true,
                text: 'Imprimerie'
            },
            currentAction: 0,
            actions: [
                {
                    type: 'guess',
                    content: {
                        text: 'La machine de Doc semble avoir du mal à démarrer aidez le en parvenant à allumer les 4 ampoules simultanément, comme évoqué elles n\'ont l\'air d\'en faire qu\'à leur tête...',
                        name: 'leds'
                    }
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
                text: 'Imprimerie'
            },
            currentAction: 0,
            actions: [
                {
                    type: 'dialog',
                    content: {
                        character: {
                            name: 'Doc',
                            picture: 'images/game/characters/nathan.png'
                        },
                        text: 'Tiens ! Voici leurs affiches. Pourrais tu aller les disposer dans la ville à ma place? Grâce à tes informations je vais écrire mon article dans le GossipWest ! Bon courage dans ton enquête et ramène moi des infos croustillantes si tu peux, ça va faire la une !'
                    }
                },
                {
                    type: 'map',
                    content: {
                        text: 'Vous allez poser des affiches dans une ruelle étroite.',
                        file: ['images/game/maps/banque.png', 'images/game/maps/imprimerie.png', 'images/game/maps/ruelle.png', ]
                    }
                },
            ]
        },
    },
    {
        type: 'scene',
        content: {
            bg: 'images/game/bg/ruelle.jpeg',
            title: {
                dark: true,
                text: 'Ruelle'
            },
            currentAction: 0,
            actions: [
                {
                    type: 'info',
                    text: 'La nuit est déjà tombée sur Lannion Town alors que vous vous activez avec ces affiches, dès demain toute la ville sera en mesure de reconnaître les trois bandits. Pour le moment, tout est calme, une nuit paisible où le silence règne...'
                },
                {
                    type: 'dialog',
                    content: {
                        character: {
                            name: 'Sir Hammerlock',
                            picture: 'images/game/characters/Julien.png'
                        },
                        text: '♫♪ Mon frère était vétérinaire il soufflait dans le derrière des chevaux... ♪♫'
                    }
                },
                {
                    type: 'dialog',
                    content: {
                        character: {
                            name: 'Pop\'s',
                            picture: 'images/game/characters/corentin.png'
                        },
                        text: '♪♫ ...avec un petit tube en... ♫♪'
                    }
                },
                {
                    type: 'dialog',
                    content: {
                        character: {
                            name: 'Sir Hammerlock',
                            picture: 'images/game/characters/Julien.png'
                        },
                        text: 'Eh là ! Pop\'s on le connaît po lui ! L\'est nouveau non ?'
                    }
                },
                {
                    type: 'dialog',
                    content: {
                        character: {
                            name: 'Pop\'s',
                            picture: 'images/game/characters/corentin.png'
                        },
                        text: 'C\'est clair qu\'il est pas d\'ici ! On l\'aurait vu au moins une fois au saloon !'
                    }
                },
                {
                    type: 'dialog',
                    content: {
                        character: {
                            name: 'Sir Hammerlock',
                            picture: 'images/game/characters/Julien.png'
                        },
                        text: 'Tant qu\'il vient payer son coup à boire ! Regarde le il pose des affiches c\'est peut être le stagiaire de ce bon vieux Doc !'
                    }
                },
                {
                    type: 'dialog',
                    content: {
                        character: {
                            name: 'Pop\'s',
                            picture: 'images/game/characters/corentin.png'
                        },
                        text: 'Ben ça alors je le reconnais celui là ! Je lui ai demandé si il voulait venir chanter avec nous ya même pas 2 mousses... euh 2 minutes je veux dire ! Il est dans la ruelle d\'à côté un peu plus haut je sais pas trop ce qu\'il attendait le saloon c\'est à l\'opposé... Y en a qui ont vraiment rien compris...'
                    }
                },
            ]
        },
    },
    {
        type: 'scene',
        content: {
            bg: 'images/game/bg/ruelle_etroite.jpeg',
            title: {
                dark: true,
                text: 'Ruelle Obscure'
            },
            currentAction: 0,
            actions: [
                {
                    type: 'info',
                    text: 'Vous êtes désormais dans cette ruelle obscure cela ne présage rien de bon... '
                },
                {
                    type: 'dialog',
                    content: {
                        character: {
                            name: 'Jesse James',
                            picture: 'images/game/characters/jules.png'
                        },
                        text: 'Eh bien ! Tu m\'as déjà retrouvé... je dois dire que je pensais pas me faire avoir aussi vite. M\'enfin t\'auras rien de moi tant que tu me donneras pas la réponse que j\'attends...'
                    }
                },
                {
                    type: 'guess',
                    content: {
                        text: 'Vous avez retrouvé un des bandits ! Répondez à son énigme pour continuer...',
                        name: 'nguess'
                    }
                },
                {
                    type: 'dialog',
                    content: {
                        character: {
                            name: 'Jesse James',
                            picture: 'images/game/characters/jules.png'
                        },
                        text: 'Mais c\'est qu\'il nous réserve des surprises l\'ami ! De toute façon j\'ai déjà été payé je leur dois plus rien aux collègues je te laisse ma partie du parchemin, elle m\'encombre plus qu\'autre chose.'
                    }
                },
                {
                    type: 'info',
                    text: 'Vous êtes désormais en possession d\'un morceau de parchemin'
                },
                {
                    type: 'info',
                    text: 'Vous observez Jesse James s\'en aller dans la pénombre et disparaître au milieu de la nuit... Le silence est de nouveau maître de Lannion Town alors que vous rentrez vous reposer...'
                },
                {
                    type: 'info',
                    text: 'C’est déjà le lendemain de votre découverte, il est vrai que nul n’avait atteint ce point de l’enquête mais ce n’est que le début, il manque encore quelques indices pour enfin découvrir où ont été cachés les lingots !'
                },
                {
                    type: 'info',
                    text: '! Cependant… c’est assez compliqué désormais… rien ne semble vous mettre sur une piste et puis hier soir n’était peut être qu’un coup de chance ? Il faut désormais rencontrer quelqu’un qui connaît du monde… Beaucoup de monde !'
                },
                {
                    type: 'map',
                    content: {
                        text: 'Vous avez désormais accès au Saloon !',
                        file: ['images/game/maps/banque.png', 'images/game/maps/imprimerie.png', 'images/game/maps/ruelle.png', 'images/game/maps/saloon.png', ]
                    }
                },
            ]
        },
    },
]
